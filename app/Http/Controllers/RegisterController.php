<?php

namespace App\Http\Controllers;

use App\Models\EducationProgram;
use App\Models\Major;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Services\FonnteService;
use App\Models\Setting;
use App\Models\AcademicYear;
use App\Models\Batch;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        $programs = EducationProgram::all();
        $academicYears = AcademicYear::where('is_active', true)->orderBy('name', 'desc')->get();
        $feeSetting = Setting::where('key', 'registration_fee')->first();
        $registrationFee = $feeSetting ? (int) $feeSetting->value : 150000;
        
        $testingModeSetting = Setting::where('key', 'testing_mode')->first();
        $testingMode = $testingModeSetting ? (int) $testingModeSetting->value : 0;

        return view('register', compact('programs', 'registrationFee', 'academicYears', 'testingMode'));
    }

    public function getMajorsByProgram($programId)
    {
        $majors = Major::where('education_program_id', $programId)->get();
        return response()->json($majors);
    }

    public function getBatchesByAcademicYear($academicYearId)
    {
        $batches = Batch::where('academic_year_id', $academicYearId)->where('is_active', true)->get();
        return response()->json($batches);
    }

    public function initiatePayment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp' => 'required|string|max:20',
        ]);

        // Clean and format phone number
        $cleanPhone = function($val) {
            $cleaned = preg_replace('/\D/', '', $val);
            if (str_starts_with($cleaned, '0')) {
                $cleaned = substr($cleaned, 1);
            } elseif (str_starts_with($cleaned, '62')) {
                $cleaned = substr($cleaned, 2);
            }
            return '+62' . $cleaned;
        };

        $whatsapp = $cleanPhone($request->whatsapp);

        // Check if there is already a paid registration for this whatsapp/email
        $existingPaid = Registration::where('payment_status', 'paid')
            ->where(function($q) use ($request, $whatsapp) {
                $q->where('whatsapp', $whatsapp)
                  ->orWhere('email', $request->email);
            })->first();

        if ($existingPaid) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor WhatsApp atau Email ini sudah terdaftar dan lunas. Silakan lakukan pencarian status untuk melanjutkan ke pengisian formulir.'
            ], 422);
        }

        $testingModeSetting = Setting::where('key', 'testing_mode')->first();
        $isTestingMode = $testingModeSetting ? (int) $testingModeSetting->value === 1 : false;

        // Create initial registration record
        $registration = Registration::create([
            'name' => $request->name,
            'email' => $request->email,
            'whatsapp' => $whatsapp,
            'status' => 'administrasi',
            'payment_status' => $isTestingMode ? 'paid' : 'pending',
            // Foreign keys must be set temporary (e.g. first program/major, will be updated later)
            // But wait, the migrations define constrained education_program_id and major_id as NOT NULL!
            // Let's check if education_programs and majors have default seeds so we can assign the first one temporary.
            'education_program_id' => EducationProgram::first()->id ?? 1,
            'major_id' => Major::first()->id ?? 1,
        ]);

        // Generate Midtrans Snap Token
        $snapToken = null;
        if (!$isTestingMode) {
            try {
                $snapToken = $this->generateMidtransSnapToken($registration);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Gagal membuat token Midtrans: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengintegrasikan pembayaran Midtrans. Silakan coba beberapa saat lagi.'
                ], 500);
            }
        }

        // Send Initial WhatsApp notification (Pending/Paid Payment)
        try {
            $feeSetting = Setting::where('key', 'registration_fee')->first();
            $amount = $feeSetting ? (int) $feeSetting->value : 150000;
            $amountFormatted = number_format($amount, 0, ',', '.');
            
            if ($isTestingMode) {
                $waMessage = "Halo *" . $registration->name . "*,\n\nPembayaran biaya pendaftaran sebesar *Rp " . $amountFormatted . "* sukses terverifikasi (Mode Testing). Silakan isi formulir pendaftaran Anda untuk melengkapi berkas.\n\nTerima kasih.";
            } else {
                $waMessage = "Halo *" . $registration->name . "*,\n\nPendaftaran Anda di Pondok IT berhasil disimpan dengan status *Menunggu Pembayaran*.\n\nSilakan selesaikan pembayaran biaya pendaftaran sebesar *Rp " . $amountFormatted . "* untuk memproses berkas pendaftaran Anda.\n\nID Transaksi (Order ID): *" . $registration->midtrans_order_id . "*\n\nTerima kasih.";
            }
            FonnteService::sendWhatsApp($registration->whatsapp, $waMessage);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mengirim WhatsApp registrasi awal: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => $isTestingMode ? 'Bypass pembayaran testing mode aktif.' : 'Token pembayaran berhasil dibuat.',
            'snap_token' => $snapToken,
            'payment_status' => $isTestingMode ? 'paid' : 'pending',
            'order_id' => $registration->midtrans_order_id,
            'registration' => $registration
        ]);
    }

    public function checkPayment(Request $request)
    {
        $request->validate([
            'query' => 'required|string',
        ]);

        $query = trim($request->input('query'));

        // Normalize phone query if it is a phone number
        $cleanQuery = preg_replace('/\D/', '', $query);
        if (str_starts_with($cleanQuery, '0')) {
            $cleanQuery = '+62' . substr($cleanQuery, 1);
        } elseif (str_starts_with($cleanQuery, '62')) {
            $cleanQuery = '+62' . substr($cleanQuery, 2);
        } elseif (!empty($cleanQuery)) {
            $cleanQuery = '+62' . $cleanQuery;
        }

        // Search in database
        $registration = Registration::where('midtrans_order_id', $query)
            ->orWhere('whatsapp', $query)
            ->orWhere('whatsapp', $cleanQuery)
            ->orWhere('email', $query)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$registration) {
            return response()->json([
                'success' => false,
                'message' => 'Data transaksi pembayaran tidak ditemukan. Silakan periksa kembali Order ID atau nomor WhatsApp Anda.'
            ], 404);
        }

        // If pending, check status directly via Midtrans API to bypass webhook lag
        if ($registration->payment_status === 'pending' && $registration->midtrans_order_id) {
            try {
                \Midtrans\Config::$serverKey = config('midtrans.server_key');
                \Midtrans\Config::$isProduction = config('midtrans.is_production');
                
                $status = \Midtrans\Transaction::status($registration->midtrans_order_id);
                $transactionStatus = $status->transaction_status;
                
                if (in_array($transactionStatus, ['settlement', 'capture'])) {
                    $registration->payment_status = 'paid';
                    $registration->save();
 
                    // Send success WA notification
                    $feeSetting = Setting::where('key', 'registration_fee')->first();
                    $amount = $feeSetting ? (int) $feeSetting->value : 150000;
                    $amountFormatted = number_format($amount, 0, ',', '.');
                    $message = "Halo *" . $registration->name . "*,\n\nPembayaran biaya pendaftaran sebesar *Rp " . $amountFormatted . "* sukses terverifikasi. Silakan isi formulir pendaftaran Anda untuk melengkapi berkas.\n\nTerima kasih.";
                    FonnteService::sendWhatsApp($registration->whatsapp, $message);
                } elseif (in_array($transactionStatus, ['expire', 'cancel', 'deny'])) {
                    // Transaction expired or failed, automatically generate a new Snap Token
                    $registration->snap_token = $this->generateMidtransSnapToken($registration);

                    // Send WA notification about regenerated order ID
                    try {
                        $feeSetting = Setting::where('key', 'registration_fee')->first();
                        $amount = $feeSetting ? (int) $feeSetting->value : 150000;
                        $amountFormatted = number_format($amount, 0, ',', '.');
                        $waMsg = "Halo *" . $registration->name . "*,\n\nKode pembayaran sebelumnya telah kedaluwarsa. Kami telah memperbarui kode pembayaran baru Anda.\n\nID Transaksi Baru (Order ID): *" . $registration->midtrans_order_id . "*\nNominal: *Rp " . $amountFormatted . "*\n\nSilakan selesaikan pembayaran. Terima kasih.";
                        FonnteService::sendWhatsApp($registration->whatsapp, $waMsg);
                    } catch (\Exception $waEx) {
                        \Illuminate\Support\Facades\Log::error('Gagal mengirim WA pembaruan transaksi: ' . $waEx->getMessage());
                    }
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Gagal mengecek status Midtrans secara langsung: ' . $e->getMessage());
                // If transaction is not found (e.g. sandbox cleared or expired), regenerate a fresh token
                if (str_contains(strtolower($e->getMessage()), '404') || str_contains(strtolower($e->getMessage()), 'not found')) {
                    try {
                        $registration->snap_token = $this->generateMidtransSnapToken($registration);

                        // Send WA notification about regenerated order ID
                        $feeSetting = Setting::where('key', 'registration_fee')->first();
                        $amount = $feeSetting ? (int) $feeSetting->value : 150000;
                        $amountFormatted = number_format($amount, 0, ',', '.');
                        $waMsg = "Halo *" . $registration->name . "*,\n\nKode pembayaran sebelumnya telah kedaluwarsa. Kami telah memperbarui kode pembayaran baru Anda.\n\nID Transaksi Baru (Order ID): *" . $registration->midtrans_order_id . "*\nNominal: *Rp " . $amountFormatted . "*\n\nSilakan selesaikan pembayaran. Terima kasih.";
                        FonnteService::sendWhatsApp($registration->whatsapp, $waMsg);
                    } catch (\Exception $subEx) {
                        \Illuminate\Support\Facades\Log::error('Gagal membuat ulang token Midtrans: ' . $subEx->getMessage());
                    }
                }
            }
        }

        if ($registration->payment_status === 'paid') {
            if ($registration->birthplace !== null) {
                return response()->json([
                    'success' => true,
                    'payment_status' => 'paid',
                    'is_completed' => true,
                    'name' => $registration->name,
                    'message' => 'Pendaftaran Anda sudah lengkap! Berkas Anda sedang dalam proses verifikasi administrasi oleh tim seleksi Pondok IT.'
                ]);
            }

            return response()->json([
                'success' => true,
                'payment_status' => 'paid',
                'is_completed' => false,
                'message' => 'Pembayaran terverifikasi! Anda dapat melanjutkan pengisian formulir.',
                'registration' => [
                    'id' => $registration->id,
                    'name' => $registration->name,
                    'email' => $registration->email,
                    'whatsapp' => $registration->whatsapp,
                ]
            ]);
        }

        return response()->json([
            'success' => true,
            'payment_status' => 'pending',
            'message' => 'Pembayaran belum lunas atau masih pending.',
            'snap_token' => $registration->snap_token,
            'order_id' => $registration->midtrans_order_id,
        ]);
    }

    public function completeRegistration(Request $request)
    {
        $data = $request->validate([
            'registration_id' => 'nullable|exists:registrations,id',
            'name' => 'required_without:registration_id|string|max:255',
            'email' => 'required_without:registration_id|email|max:255',
            'whatsapp' => 'required_without:registration_id|string|max:20',
            'birthplace' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'gender' => 'required|string|in:Laki-laki,Perempuan',
            'age' => 'required|integer|min:5|max:60',
            'region' => 'required|string|max:255',
            'address' => 'required|string',
            'last_education' => 'required|string|max:100',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            
            // New fields
            'goals' => 'required|string|max:255',
            'hobbies' => 'required|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'organization_experience' => 'nullable|string',
            'school_name' => 'required|string|max:255',
            'school_major' => 'required|string|max:255',
            'achievements' => 'nullable|string',
            'parents_condition' => 'required|string|in:Lengkap,Yatim,Piatu,Yatim Piatu,Cerai Hidup',
            'parent_income' => 'required|string',
            'sibling_count' => 'required|integer|min:0',
            'has_laptop' => 'required|string|in:Punya,Belum,Sedang Saya Usahakan',
            'quran_memorization' => 'required|string|max:255',
            'favorite_ustadz' => 'required|string|max:255',
            'has_relationship' => 'required|string|max:255',
            'source_info' => 'required|string',
            'has_bpjs' => 'required|string|max:255',
            'idol' => 'required|string|max:255',
            'is_smoking' => 'required|string|max:255',
            'learned_before' => 'required|string|max:255',
            'it_skills' => 'nullable|string',
            'favorite_subjects' => 'required|string|max:255',

            // Guardian
            'guardian_name' => 'required|string|max:255',
            'guardian_relationship' => 'required|string|max:100',
            'guardian_whatsapp' => 'required|string|max:20',
            'guardian_occupation' => 'required|string|max:255',

            'education_program_id' => 'required|exists:education_programs,id',
            'major_id' => 'required|exists:majors,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'batch_id' => 'required|exists:batches,id',
        ]);

        $registrationId = $request->input('registration_id');

        if (!$registrationId) {
            $cleanPhone = function($val) {
                $cleaned = preg_replace('/\D/', '', $val);
                if (str_starts_with($cleaned, '0')) {
                    $cleaned = substr($cleaned, 1);
                } elseif (str_starts_with($cleaned, '62')) {
                    $cleaned = substr($cleaned, 2);
                }
                return '+62' . $cleaned;
            };

            $whatsapp = $cleanPhone($request->whatsapp);

            $registration = Registration::create([
                'name' => $request->name,
                'email' => $request->email,
                'whatsapp' => $whatsapp,
                'status' => 'administrasi',
                'payment_status' => 'paid',
                'education_program_id' => $request->education_program_id,
                'major_id' => $request->major_id,
            ]);
        } else {
            $registration = Registration::findOrFail($registrationId);
            if ($registration->payment_status !== 'paid') {
                return response()->json([
                    'success' => false,
                    'message' => 'Maaf, Anda belum melunasi biaya pendaftaran. Silakan selesaikan pembayaran terlebih dahulu.'
                ], 422);
            }
        }

        // Clean and format guardian phone
        $cleanPhone = function($val) {
            $cleaned = preg_replace('/\D/', '', $val);
            if (str_starts_with($cleaned, '0')) {
                $cleaned = substr($cleaned, 1);
            } elseif (str_starts_with($cleaned, '62')) {
                $cleaned = substr($cleaned, 2);
            }
            return '+62' . $cleaned;
        };

        $data['guardian_whatsapp'] = $cleanPhone($request->guardian_whatsapp);

        // Upload and crop photo 4x6
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = uniqid() . '.jpg';
            $destinationPath = storage_path('app/public/photos');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $targetFile = $destinationPath . '/' . $filename;
            $imageInfo = @getimagesize($file->getRealPath());
            
            if ($imageInfo) {
                $mime = $imageInfo['mime'];
                $image = null;
                
                if ($mime === 'image/jpeg' || $mime === 'image/jpg') {
                    $image = @imagecreatefromjpeg($file->getRealPath());
                } elseif ($mime === 'image/png') {
                    $image = @imagecreatefrompng($file->getRealPath());
                }
                
                if ($image) {
                    $newWidth = 300;
                    $newHeight = 450;
                    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
                    
                    $white = imagecolorallocate($resizedImage, 255, 255, 255);
                    imagefill($resizedImage, 0, 0, $white);
                    
                    imagecopyresampled(
                        $resizedImage, $image, 
                        0, 0, 0, 0, 
                        $newWidth, $newHeight, 
                        imagesx($image), imagesy($image)
                    );
                    
                    imagejpeg($resizedImage, $targetFile, 75);
                    
                    imagedestroy($image);
                    imagedestroy($resizedImage);
                    
                    $data['photo'] = 'photos/' . $filename;
                } else {
                    $data['photo'] = $file->store('photos', 'public');
                }
            } else {
                $data['photo'] = $file->store('photos', 'public');
            }
        }

        // Update registration details
        $registration->update($data);

        // Send Final Success WA Notification
        try {
            $waMessage = "Halo *" . $registration->name . "*,\n\nFormulir pendaftaran Anda telah *LENGKAP* dan berhasil dikirim!\n\nBerkas Anda sedang dalam proses verifikasi administrasi oleh tim seleksi Pondok IT. Silakan tunggu informasi kelulusan tahap berikutnya.\n\nTerima kasih.";
            FonnteService::sendWhatsApp($registration->whatsapp, $waMessage);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mengirim WhatsApp kelengkapan form: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran Anda berhasil dikirim! Silakan tunggu konfirmasi melalui WhatsApp',
            'registration' => $registration
        ]);
    }

    private function generateMidtransSnapToken(Registration $registration): string
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        $orderId = 'APT-' . $registration->id . '-' . rand(1000, 9999);
        
        $feeSetting = Setting::where('key', 'registration_fee')->first();
        $amount = $feeSetting ? (int) $feeSetting->value : 150000;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $amount,
            ],
            'item_details' => [
                [
                    'id' => 'REG-' . $registration->id,
                    'price' => $amount,
                    'quantity' => 1,
                    'name' => 'Biaya Pendaftaran Santri - SIAPIT',
                ]
            ],
            'customer_details' => [
                'first_name' => $registration->name,
                'email' => $registration->email,
                'phone' => $registration->whatsapp,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        
        $registration->snap_token = $snapToken;
        $registration->midtrans_order_id = $orderId;
        $registration->save();

        return $snapToken;
    }

    public function handlePaymentCallback(Request $request)
    {
        $payload = $request->all();
        \Illuminate\Support\Facades\Log::info('Midtrans Webhook Callback Received:', $payload);

        $serverKey = config('midtrans.server_key');
        $orderId = $payload['order_id'] ?? '';
        $statusCode = $payload['status_code'] ?? '';
        $grossAmount = $payload['gross_amount'] ?? '';
        $signatureKey = $payload['signature_key'] ?? '';

        // 1. Verify Midtrans signature key
        $localSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
        if ($localSignature !== $signatureKey) {
            \Illuminate\Support\Facades\Log::warning('Midtrans Webhook Signature Verification Failed for Order: ' . $orderId);
            return response()->json(['message' => 'Invalid signature key'], 403);
        }

        // 2. Parse registration ID (format: APT-regId-rand)
        $parts = explode('-', $orderId);
        if (count($parts) < 2) {
            \Illuminate\Support\Facades\Log::warning('Midtrans Webhook Invalid Order ID Format: ' . $orderId);
            return response()->json(['message' => 'Invalid order ID format'], 400);
        }
        $registrationId = intval($parts[1]);

        $registration = Registration::find($registrationId);
        if (!$registration) {
            \Illuminate\Support\Facades\Log::warning('Registration not found for ID: ' . $registrationId);
            return response()->json(['message' => 'Registration not found'], 404);
        }

        $transactionStatus = $payload['transaction_status'] ?? '';
        
        // 3. Process status
        if (in_array($transactionStatus, ['settlement', 'capture'])) {
            $registration->payment_status = 'paid';
            $registration->save();

            // Send WhatsApp confirmation to Santri
            $feeSetting = Setting::where('key', 'registration_fee')->first();
            $amount = $feeSetting ? (int) $feeSetting->value : 150000;
            $amountFormatted = number_format($amount, 0, ',', '.');
            $message = "Halo *" . $registration->name . "*,\n\nPembayaran biaya pendaftaran sebesar *Rp " . $amountFormatted . "* sukses terverifikasi. Silakan isi formulir pendaftaran Anda untuk melengkapi berkas.\n\nTerima kasih.";
            FonnteService::sendWhatsApp($registration->whatsapp, $message);

            \Illuminate\Support\Facades\Log::info('Registration ID ' . $registration->id . ' marked as paid via Midtrans webhook callback.');
        } elseif (in_array($transactionStatus, ['expire', 'cancel', 'deny'])) {
            $registration->payment_status = 'failed';
            $registration->save();
            
            \Illuminate\Support\Facades\Log::info('Registration ID ' . $registration->id . ' payment failed/expired.');
        }

        return response()->json(['message' => 'Callback processed successfully']);
    }
}

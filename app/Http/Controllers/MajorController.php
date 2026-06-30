<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\EducationProgram;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::with('educationProgram')->get();
        $programs = EducationProgram::all();
        $user = auth()->user();
        return view('super-admin.jurusan', compact('majors', 'programs', 'user'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'education_program_id' => 'required|exists:education_programs,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $major = Major::create($data);
        $major->load('educationProgram');

        return response()->json([
            'success' => true,
            'message' => 'Jurusan berhasil ditambahkan.',
            'major' => $major
        ]);
    }

    public function update(Request $request, $id)
    {
        $major = Major::findOrFail($id);

        $data = $request->validate([
            'education_program_id' => 'required|exists:education_programs,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $major->update($data);
        $major->load('educationProgram');

        return response()->json([
            'success' => true,
            'message' => 'Jurusan berhasil diperbarui.',
            'major' => $major
        ]);
    }

    public function destroy($id)
    {
        $major = Major::findOrFail($id);
        $major->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jurusan berhasil dihapus.'
        ]);
    }
}

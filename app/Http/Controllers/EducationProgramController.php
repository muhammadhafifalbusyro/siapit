<?php

namespace App\Http\Controllers;

use App\Models\EducationProgram;
use Illuminate\Http\Request;

class EducationProgramController extends Controller
{
    public function index()
    {
        $programs = EducationProgram::all();
        $user = auth()->user();
        return view('super-admin.program-pendidikan', compact('programs', 'user'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_years' => 'required|integer|min:1|max:10',
        ]);

        $program = EducationProgram::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Program pendidikan berhasil ditambahkan.',
            'program' => $program
        ]);
    }

    public function update(Request $request, $id)
    {
        $program = EducationProgram::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_years' => 'required|integer|min:1|max:10',
        ]);

        $program->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Program pendidikan berhasil diperbarui.',
            'program' => $program
        ]);
    }

    public function destroy($id)
    {
        $program = EducationProgram::findOrFail($id);
        $program->delete();

        return response()->json([
            'success' => true,
            'message' => 'Program pendidikan berhasil dihapus.'
        ]);
    }
}

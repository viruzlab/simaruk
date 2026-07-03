<?php

namespace App\Http\Controllers;

use App\Models\StudyProgram;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:study_programs',
        ]);

        StudyProgram::create($validated);

        return redirect()->route('profile.edit', ['#study-programs'])->with('status', 'study-program-created');
    }

    public function destroy(StudyProgram $studyProgram)
    {
        $studyProgram->delete();

        return redirect()->route('profile.edit', ['#study-programs'])->with('status', 'study-program-deleted');
    }
}

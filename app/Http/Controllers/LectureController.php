<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\Courses;
use Illuminate\Support\Facades\DB;

class LectureController extends Controller
{
    //
   
    public function create()
    {
        $id_author = auth()->id();
        $allcourses = DB::table('courses')->where('id_author', $id_author)->get();

        return view('createlecture', [
            'allcourses' => $allcourses
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'text_lectures' => 'required',
            'courses' => 'required',
           ]);

        $lecture = new Lecture;
        $lecture->name = $request->name;
        $lecture->description = $request->description;
        $lecture->text_lectures = $request->text_lectures;
        $lecture->id_course = $request->courses;

        $lecture->save();

        return redirect()->route('lectures.show', ['lecture' => $lecture->id])->with('success', 'Успешно добавлено');   
    }
    public function show($id)
    {
        $lectures = Lecture::findOrFail($id);
        $tests = DB::table('tests')->where('id_lessons', $id)->get();
        return view('lectures')->with('lectures', $lectures)
        ->with('tests', $tests);
    }
    public function destroy($id)
    {
        $lecture = Lecture::find($id);
        if ($lecture) {
            $lecture->delete();
            return redirect()->route('home')->with('success', 'Lecture deleted successfully.');
        } else {
            return redirect()->route('home')->with('error', 'Lecture not found.');
        }
    }

    public function edit(Lecture $lecture)
    {
        return view('editlecture', compact('lecture'));
    }

    public function update(Request $request, Lecture $lecture)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'text_lectures' => 'required|string',
        ]);

        $lecture->update($validatedData);

        return redirect()->route('lectures.edit', $lecture->id)->with('success', 'Lecture updated successfully.');
    }
    
    
}
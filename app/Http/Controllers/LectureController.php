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
    
    public function back($id)
    {
      var_dump($id);
      return 0;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'text_lectures' => 'required',
            'courses' => 'required',
            'file_document' => 'mimes:pdf,doc,docx',
           ]);

        $file = $request->file('file_document');
      
        if (!empty($file)) {
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName);
        
        } else {
            $filePath = null;
           
        }

        $lecture = new Lecture;
        $lecture->name = $request->name;
        $lecture->description = $request->description;
        $lecture->text_lectures = $request->text_lectures;
        $lecture->id_course = $request->courses;
        $lecture->file_document = $filePath;
     

        $lecture->save();

        return redirect()->route('lectures.show', ['lecture' => $lecture->id])->with('success', 'Успешно добавлено');   
    }
    public function show($id)
    {
        $lectures = Lecture::findOrFail($id);
        return view('lectures')->with('lectures', $lectures);

    }
    public function destroy($id)
    {
        $lecture = Lecture::find($id);
        $idCourse = DB::table('lectures')
        ->where('id', $id)
        ->value('id_course');

      
        if ($lecture) {
            $lecture->delete();
            return redirect('/courses/' . $idCourse)->with('success', 'Лекция успешно удалена.');
        } else {
            return redirect('/courses/' . $idCourse)->with('error', 'Лекция не найдена.');
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

        return redirect()->route('lectures.edit', $lecture->id)->with('success', 'Лекция успешно обновлена.');
    }
    public function download($id)
    {
        $record = Lecture::find($id);
        if ($record) {
            $filePath = storage_path('app/' . $record->file_document);
            if (file_exists($filePath)) {
                $headers = [
                    'Content-Type' => 'application/octet-stream',
                    'Content-Disposition' => 'attachment; filename="' . basename($filePath) . '"',
                ];
                return response()->file($filePath, $headers);
            }
        }
        abort(404);
    }
}
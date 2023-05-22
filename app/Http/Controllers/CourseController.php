<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function create()
    {
        return view('createcourse');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'code_course' => 'required',
           ]);
        $course = new Courses;
        $course->name = $request->name;
        $course->description = $request->description;
        $course->duration = $request->duration;
        $course->code_course = $request->code_course;
        $course->id_author = auth()->id();
        $course->save();
        
        return redirect()->route('courses.show', ['cours' => $course->id])->with('success', 'Успешно добавлено');   
    }
    public function course()
    {
        $user = Auth::user();
        if($user->id_status=="1")
        {
            $id_author = auth()->id();
            // $courses = DB::table('courses')->where('id_author', $id_author)->get();
            $courses = Courses::select("courses.id","courses.name","courses.description","courses.duration","users.name as author_name")->leftJoin("users", "courses.id_author", "=", "users.id")->where('id_author', $id_author)->get();
        }
        else if($user->id_status=="2")
        {
            $id_author = auth()->id();
            // $courses = DB::table('courses')->where('id_author', $id_author)->get();
            // $courses = CourseAuthor::select('courses.id as courses_id', 'courses.name as courses_name', 'courses.description as courses_description')->leftJoin('courses', 'CourseAuthors.id_course', '=', 'courses.id')->where('id_author', $id_author)->get();

            $courses =   DB::table('CourseAuthors')
            ->leftJoin('courses', 'CourseAuthors.id_course', '=', 'courses.id')
            ->select('courses.id as courses_id', 'courses.name as courses_name', 'courses.description as courses_description', 'courses.duration as courses_duration')
            ->where('CourseAuthors.id_author', '=', $id_author)
            ->get();
        }
        return view('course')->with('courses', $courses);
    }
    public function show($id)
    {
        $courses = DB::table('courses')->where('id', $id)->first();
        $id_user = $courses->id_author;
        $user = DB::table('users')->where('id', $id_user)->first();
        $user_name = $user->name;
        $tests = DB::table('tests')->get();
        // $lectures = DB::table('lectures')->where('id_course', $courses->id)->first();
        $lectures = DB::table('lectures')->where('id_course', $courses->id)->get();
        return view('courses')->with('course', $courses)
        ->with('user_name', $user_name)
        ->with('tests', $tests)
        ->with('lectures', $lectures);
    }
    public function members($id)
    {
        $user = User::join('CourseAuthors', 'CourseAuthors.id_author', '=', 'users.id')
             ->where('CourseAuthors.id_course', $id)
             ->select('users.name', 'users.email')
             ->get();
            
             return view('users')->with('users', $user);
    }
    public function destroy($id)
    {
        $courses = Courses::find($id);
        if ($courses) {
            $courses->delete();
            return redirect()->route('home')->with('success', 'Курс успешно удален');
        } else {
            return redirect()->route('home')->with('error', 'Курс не найден');
        }
    }
    public function deleteUsers($id)
    {
        $user = CourseAuthors::find($id);
        
        if ($user) {
            $user->delete();
        } else {
            // Пользователь не найден
        }
      
    }

    
}

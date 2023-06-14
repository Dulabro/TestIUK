<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Test;
use App\Models\CourseAuthor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $courseIds = Courses::pluck('id')->toArray();
        $id_author = auth()->id();
        if($user->id_status=="1")
        {
            $courses = DB::table('courses')
            ->join('users', 'courses.id_author', '=', 'users.id')
            ->leftJoin('lectures', 'courses.id', '=', 'lectures.id_course')
            ->leftJoin('tests', 'courses.id', '=', 'tests.id_course')
            ->select('courses.id','courses.name', 'courses.description', 'courses.duration', 'users.name as author_name', DB::raw('COUNT(DISTINCT lectures.id) as lecture_count'), DB::raw('COUNT(DISTINCT tests.id) as test_count'))
            ->whereIn('courses.id', $courseIds)
            ->where('courses.id_author', $id_author)
            ->groupBy('courses.id', 'courses.name', 'courses.description', 'courses.duration', 'users.name')
            ->get();
        }
        else if($user->id_status=="2")
        {
            $courses = DB::table('CourseAuthors')
            ->leftJoin('courses', 'CourseAuthors.id_course', '=', 'courses.id')
            ->join('users', 'courses.id_author', '=', 'users.id')
            ->leftJoin('lectures', 'courses.id', '=', 'lectures.id_course')
            ->leftJoin('tests', 'courses.id', '=', 'tests.id_course')
            ->select('courses.id', 'courses.name', 'courses.description', 'courses.duration', 'users.name as author_name', DB::raw('COUNT(DISTINCT lectures.id) as lecture_count'), DB::raw('COUNT(DISTINCT tests.id) as test_count'))
            ->whereIn('courses.id', $courseIds)
            ->where('CourseAuthors.id_author', $id_author)
            ->groupBy('courses.id','courses.name', 'courses.description', 'courses.duration', 'users.name')
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
        $tests =  DB::table('tests')->where('id_course', $courses->id)->get();
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
        $deletedRows = DB::table('CourseAuthors')
                    ->where('id', $id)
                    ->delete();
                    if ($deletedRows > 0) {
                        Session::flash('success', 'Пользователь удален');
                    } else {
                        Session::flash('error', 'Пользователь не найден');
                    }
                    return back();
    }

    
}

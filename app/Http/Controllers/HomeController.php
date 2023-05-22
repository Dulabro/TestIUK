<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Lecture;
use App\Models\Courses;
use App\Models\CourseAuthor;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();
        $courseIds = Courses::pluck('id')->toArray();
        // $lessonCount = Lecture::whereIn('course_id', $courseIds)->count();
        // $lessonCount = DB::table('lectures')
        //     ->whereIn('course_id', $courseIds)
        //     ->count()->get();
        // var_dump($lessonCount);
        // return 0;
       
       
       
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
            // ->leftJoin('users', 'courses.id_author', '=', 'users.id')
            ->select('courses.id as courses_id', 'courses.name as courses_name', 'courses.description as courses_description')
            ->where('CourseAuthors.id_author', '=', $id_author)
            ->get();
        }
        
        
        return view('home')->with('courses', $courses)->with('user', $user);
    }
    public function store(Request $request)
    {
        $courseAuthor = new CourseAuthor;
        $user = Auth::user();
        $id = $user->id;
        
        $request->validate([
            'code_course' => 'required',
           ]);
           $code_course = $request->code_course;
           $courses = DB::table('courses')->where('code_course', $code_course)->first();
           $exists = CourseAuthor::where('id_course', $courses->id)->where('id_author',$id )->exists();
            if ($exists) {
                // User with email "john@example.com" already exists
            } else {
                $courseAuthor->id_course = $courses->id;
                $courseAuthor->id_author = $id;
                $courseAuthor->save();
            }
           return redirect()->back()->with('success', 'Курс открыт.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('The current password is incorrect.');
                }
            }],
            'password' => ['required', 'confirmed', Rules\Password::min(8)],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Your password has been updated.');
    }
    
}

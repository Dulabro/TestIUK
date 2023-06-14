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
                    $fail('Текущий пароль неверен.');
                }
            }],
            'password' => ['required', 'confirmed', Rules\Password::min(8)],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Ваш пароль был обновлен.');
    }
    
}

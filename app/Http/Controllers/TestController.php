<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Courses;
use App\Models\TestResult;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    //
    public function create()
    {
        $id_author = auth()->id();
      
        $courses = Courses::where('id_author', $id_author)->get();
   
        return view('createtest', compact('courses'));
    }

    public function store(Request $request)
    {
        
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'id_course' => 'required|max:255',
            'questions.*.question' => 'required|max:255',
            'questions.*.answers.*.answer' => 'required|max:255',
            'questions.*.answers.*.valid' => 'nullable|boolean',
        ]);
    

        // Create the test
        $test = new Test();
        $test->name = $validatedData['name'];
        $test->id_course = $validatedData['id_course'];
        $test->save();

        // Loop through the questions and create them for the test
        foreach ($validatedData['questions'] as $questionData) {
            $question = Question::create([
                'question' => $questionData['question'],
                'test_id' => $test->id,
            ]);

            // Loop through the answers and create them for the question
            foreach ($questionData['answers'] as $answerData) {
                $answer = Answer::create([
                    'answer' => $answerData['answer'],
                    'valid' => !empty($answerData['valid']),
                    'question_id' => $question->id,
                ]);
            }
        }
        return redirect()->route('courses.show', ['cours' => $test->id_course])->with('success', 'Тест успешно создан');   
    }

    public function index()
    {
        $tests = Test::with('questions.answers')->get();

        return view('tests', compact('tests'));
    }

    public function show($id)
    {
        $tests = Test::findOrFail($id);
        $questions = Question::where('test_id', $id)->get();
          
        return view('test')->with('tests', $tests)
        ->with('questions', $questions);
    }
    public function calculateValue(Request $request, $id)
    {
        $test = Test::find($id);
      
        $checkboxes = $request->input('answers');
        $totalValue = 0;
        foreach ($checkboxes as $checkbox) {
            $totalValue += intval($checkbox);
        }
      
       
     
        
        $testResult = new TestResult;
        $testResult->id_test = $test->id;
        $testResult->id_user = Auth::id();
        $testResult->total_value = $totalValue;
        $testResult->save();
        
        $user = User::find($testResult->id_user);
        $test = Test::find($testResult->id_test);
     
    // Do something with the totalValue
    // return redirect()->back()->with('success', 'Количество правильных ответов: ' . $totalValue);
    return view('testresult', compact('testResult','user','test'));
    }

    public function edit(Test $test)
    {
        $courses = Courses::all();
        return view('edittest', compact('test', 'courses'));
    }


    public function update(Request $request, $id)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'id_course' => 'required|max:255',
        'questions.*.question' => 'required|max:255',
        'questions.*.answers.*.answer' => 'required|max:255',
        'questions.*.answers.*.valid' => 'nullable|boolean',
    ]);

    // Find the test to update
    $test = Test::findOrFail($id);
    
    // Update the test attributes
    $test->name = $validatedData['name'];
    $test->id_course = $validatedData['id_course'];
    $test->save();

    // Delete the existing questions and answers associated with the test
    $test->questions()->delete();

    // Loop through the questions and create/update them for the test
    foreach ($validatedData['questions'] as $questionData) {
        $question = Question::create([
            'question' => $questionData['question'],
            'test_id' => $test->id,
        ]);

        // Loop through the answers and create/update them for the question
        foreach ($questionData['answers'] as $answerData) {
            $answer = Answer::create([
                'answer' => $answerData['answer'],
                'valid' => !empty($answerData['valid']),
                'question_id' => $question->id,
            ]);
        }
    }

    return redirect()->route('courses.show', ['cours' => $test->id_course])->with('success', 'Тест успешно обновлен');
}


    
}
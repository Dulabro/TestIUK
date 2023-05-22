<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Lecture;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    //
    public function create()
    {
        $lessons = Lecture::all();
        return view('createtest', compact('lessons'));
    }

    public function store(Request $request)
    {
        
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'id_lessons' => 'required|max:255',
            'questions.*.question' => 'required|max:255',
            'questions.*.answers.*.answer' => 'required|max:255',
            'questions.*.answers.*.valid' => 'nullable|boolean',
        ]);
    

        // Create the test
        $test = Test::create([
            'name' => $validatedData['name'],
            'id_lessons' => $validatedData['id_lessons'],
        ]);

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

        

        return redirect()->route('tests.index')->with('success', 'Тест успешно создан.');
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
        
      
        
    // Do something with the totalValue
    return redirect()->back()->with('success', 'Количество правильных ответов: ' . $totalValue);
}
    
}
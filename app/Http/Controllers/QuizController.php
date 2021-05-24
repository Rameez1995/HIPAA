<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\Quiz;

class QuizController extends Controller
{
    
    public function index(Request $request)
    {
    	  
        $training_id=$request->training_id;

        $quizes=Quiz::where('training_id',$training_id)->get();

        $last_question_number = Quiz::orderBy('id', 'DESC')->value('question_number');

        if($last_question_number!=null)
        {
           //Triming last category_id 
           $last_question_number_trim=substr($last_question_number,1,2);

           //Increementing last category_id
           $increemented_question_number=$last_question_number_trim + 1;

           $question_number="Q".$increemented_question_number;

        }
        else{
            $question_number="Q1";
        }

    	return view('quizes.index',compact('training_id','question_number','quizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question'     => 'required',
            'option1'     => 'required',
            'option2'     => 'required',
            'option3'     => 'required',
            'option4'     => 'required',
        ]);

        if($request->radio_group=="1"){
           $correct_answer=$request->option1;
        }
        else if ($request->radio_group=="2"){
           $correct_answer=$request->option2;
        }
        else if ($request->radio_group=="3"){
           $correct_answer=$request->option3;
        }
        else{
           $correct_answer=$request->option4;
        }

        $last_question_number = Quiz::orderBy('id', 'DESC')->value('question_number');

        if($last_question_number!=null)
        {
           //Triming last category_id 
           $last_question_number_trim=substr($last_question_number,1,2);

           //Increementing last category_id
           $increemented_question_number=$last_question_number_trim + 1;

           $question_number="Q".$increemented_question_number;

        }
        else{
            $question_number="Q1";
        }


        $quiz_image = $request->file('image');
        $image = rand() . '.' . $quiz_image->getClientOriginalExtension();
        $quiz_image->move(public_path('app-assets/images/quizes'), $image);

        $trainings = Training::find($request->training_id);
        
        $quizes = new Quiz();
        $quizes->question_number=$question_number;
        $quizes->question=$request->question;
        $quizes->image=$image;
        $quizes->option1=$request->option1;
        $quizes->option2=$request->option2;
        $quizes->option3=$request->option3;
        $quizes->option4=$request->option4;
        $quizes->correct_answer=$correct_answer;

        $trainings->quizes()->save($quizes);

        return redirect('admin/quiz')->with('categoryaddesuccess','Category Added Successfully');

    }

}

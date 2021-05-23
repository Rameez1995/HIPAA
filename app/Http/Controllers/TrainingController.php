<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\Category;
use App\Models\Resource;

class TrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $trainings = Training::with('categories')->get();
        return View('trainings.index',compact('trainings')); 
    }

    public function create()
    {
         //Getiing last training_id in form of collection
         $last_training_id = Training::orderBy('id', 'DESC')->value('training_id');

         if($last_training_id!=null)
         {
            //Triming last training_id 
            $last_training_id_trim=substr($last_training_id,2,6);
 
            //Increementing last training_id
            $increemented_training_id=$last_training_id_trim + 1;

            $training_id="TL".$increemented_training_id;
 
         }
         else{
            $training_id="TL10001";
         }

        $categories=Category::all();
        
        return view('trainings.create',compact('training_id','categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'training_id'     => 'required',
            'training_name'     => 'required',
            'pass_percentage'     => 'required',
            'description'     => 'required',
        ]);

        $training_image = $request->file('image');
        $image = rand() . '.' . $training_image->getClientOriginalExtension();
        $training_image->move(public_path('app-assets/images/trainings'), $image);

        $categories = Category::find($request->category_id);
        
        $training = new Training();
        $training->training_id=$request->training_id;
        $training->training_name=$request->training_name;
        $training->pass_percentage=$request->pass_percentage;
        $training->description=$request->description;
        $training->image=$image;
        $training->status="1";

        $categories->trainings()->save($training);

        return redirect('trainings')->with('categoryaddesuccess','Category Added Successfully');

    }

    public function display($id)
    {
      $trainings = Training::with('categories')->where('id',$id)->first();
      $resources = Resource::where('training_id',$id)->get();
      return view('trainings.details',compact('trainings','resources'));
    }

    public function edit($id)
    {
      $trainings = Training::with('categories')->where('id',$id)->first();
      $categories=Category::all();
      $resources = Resource::where('training_id',$id)->get();
      return view('trainings.edit',compact('trainings','categories','resources'));
    }

    public function update(Request $request){

        if(isset($request->radio_group))
        {
            $status="1";
        }
        else{
            $status="0";
        }

        $image = $request->training_hidden_image;


        $training_image = $request->file('image');
        
        if($training_image != '')
        {
            $request->validate([
                'training_name'     => 'required',
                'pass_percentage'     => 'required',
                'description'     => 'required',
            ]);

            $image = rand() . '.' . $training_image->getClientOriginalExtension();
            $training_image->move(public_path('app-assets/images/trainings'), $image);
        }
        else
        {
            $request->validate([
                'training_name'     => 'required',
                'pass_percentage'     => 'required',
                'description'     => 'required',
            ]);
        }



        $training = Training::find($request->id);
        $training->training_name=$request->training_name;
        $training->pass_percentage=$request->pass_percentage;
        $training->description=$request->description;
        $training->image=$image;
        $training->status=$status;
        $training->category_id=$request->category_id;
        $training->update();
        
        return redirect('trainings')->with('producteditsuccess','Product Updated Successfully');
    }
}

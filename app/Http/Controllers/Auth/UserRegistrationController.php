<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\Company;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Response;


class UserRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:vendor');
    }

    public function index()
    {
        $categories=Category::all();
        $trainings=Training::all();
        $companies=Company::all();

        $vendors=Vendor::with('companies')->with('trainings')->get();
      
        return view('userregistrations.index',compact('categories','trainings','vendors','companies'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'firstname'     => 'required',
            'lastname'     => 'required',
            'email'     => 'required',
            'password'     => 'required',
            'category_id'     => 'required',
            'training_id'     => 'required'
        ]);

        //Getiing last category_id in form of collection
        $last_user_id = Vendor::orderBy('id', 'DESC')->value('user_id');

        if($last_user_id!=null)
        {
           //Triming last category_id 
           $last_user_id_trim=substr($last_user_id,2,6);

           //Increementing last category_id
           $increemented_user_id=$last_user_id_trim + 1;

           $user_id="UL".$increemented_user_id;

        }
        else{
            $user_id="UL10001";
        }
            
         /** Converting password to hash */
        $request['password'] = Hash::make($request->password);

        /** Saving Record in Vendors **/
        $vendor = new Vendor();
        $vendor->user_id=$user_id;
        $vendor->firstname=$request->firstname;
        $vendor->lastname=$request->lastname;
        $vendor->email=$request->email;
        $vendor->password=$request['password'];
        $vendor->status="1";
        $vendor->category_id = $request->category_id;
        $vendor->training_id = $request->training_id;
        $vendor->company_id = $request->company_id;
        $vendor->amount = $request->amount;
        $vendor->save();

        return redirect()->intended(route('userregistration.index'));
    }

    public function update(Request $request)
    {
         $request->validate([
            'firstname'     => 'required',
            'lastname'     => 'required',
            'email'     => 'required',
            'category_id'     => 'required',
            'training_id'     => 'required'
        ]);
            
         /** Converting password to hash */
        if($request->password!="null"){
        $request['password'] = Hash::make($request->password);
        }


        /** Saving Record in Vendors **/
        $vendor = Vendor::find($request->id);


        if($request->password!="null"){
        $vendor->firstname=$request->firstname;
        $vendor->lastname=$request->lastname;
        $vendor->email=$request->email;
        $vendor->password=$request['password'];
        $vendor->status="1";
        $vendor->category_id = $request->category_id;
        $vendor->training_id = $request->training_id;
        $vendor->company_id = $request->company_id;
        $vendor->amount = $request->amount;
        $vendor->update();
        }
        else{
        $vendor->firstname=$request->firstname;
        $vendor->lastname=$request->lastname;
        $vendor->email=$request->email;
        $vendor->status="1";
        $vendor->category_id = $request->category_id;
        $vendor->training_id = $request->training_id;
        $vendor->company_id = $request->company_id;
        $vendor->amount = $request->amount;
        dd($vendor->update());
        }


        return redirect()->intended(route('userregistration.index'));
    }

    public function display($id)
    {
      $vendors = Vendor::with('categories')
                  ->with('trainings')
                  ->with('companies')
                  ->where('id',$id)
                  ->first();

      return view('userregistrations.details',compact('vendors'));
    }

    public function statusupdateactive(Request $request)
    {  
        $vendors = Vendor::find($request->id);
        $vendors->status=$request->status;
        $vendors->update();

        return redirect()->intended(route('userregistration.index'));

    }

    public function statusupdateinactive(Request $request)
    {  
        $vendors = Vendor::find($request->id);
        $vendors->status=$request->status;
        $vendors->update();

        return redirect()->intended(route('userregistration.index'));

    }
    public function edit($id)
	{
		$where = array('id' => $id);
		$vendors = Vendor::where($where)->first();


		return Response::json($vendors);
	}

    public function getcategories($id)
    {
         $vendor_category_id = Vendor::where('id', $id)->value('category_id');

        $vendor_categories=Category::select('category_name','id')->where('id',$vendor_category_id)->get();


        $categories=Category::select('category_name','id')->where('id','!=',$vendor_category_id)->get();


        $new_vendor_categories = collect($vendor_categories);
        $new_categories = collect($categories);

        $merged_categories = $new_vendor_categories->merge($new_categories);

        return Response::json($merged_categories);

    }

    public function getcompanies($id)
    {
        $vendor_company_id= Vendor::where('id', $id)->value('company_id');

        $vendor_companies=Company::select('company_name','id')->where('id',$vendor_company_id)->get();


        $companies=Company::select('company_name','id')->where('id','!=',$vendor_company_id)->get();


        $new_vendor_companies = collect($vendor_companies);
        $new_companies = collect($companies);
        
        $merged_companies = $new_vendor_companies->merge($new_companies);

        return Response::json($merged_companies);

    }

    public function gettrainings($id)
    {
         $vendor_training_id = Vendor::where('id', $id)->value('training_id');

        $vendor_trainings=Training::select('training_name','id')->where('id',$vendor_training_id)->get();


        $trainings=Training::select('training_name','id')->where('id','!=',$vendor_training_id)->get();


        $new_vendor_trainings = collect($vendor_trainings);
        $new_trainings = collect($trainings);
        
        $merged_trainings = $new_vendor_trainings->merge($new_trainings);

        return Response::json($merged_trainings);

    }

}
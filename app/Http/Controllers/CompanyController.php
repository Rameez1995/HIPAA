<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index(){

    }

    public function store(Request $request){
         
        $request->validate([
            'company_name'     => 'required'
        ]);
        
        $company = new Company();
        $company->company_name=$request->company_name;
        $company->save();

        return redirect('admin/userregistration')->with('categoryaddesuccess','Category Added Successfully');
        
    }
}

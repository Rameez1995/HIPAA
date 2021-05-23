<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\Category;
use App\Models\Resource;

class ResourceController extends Controller
{
    public function store(Request $request)
    {
    	
        $request->validate([
            'resource_name'     => 'required',
            'description'     => 'required',
        ]);

        $resource_image = $request->file('image');
        $image = rand() . '.' . $resource_image->getClientOriginalExtension();
        $resource_image->move(public_path('app-assets/images/resources'), $image);

        $trainings = Training::find($request->id);
        
        $resource = new Resource();
        $resource->resource_name=$request->resource_name;
        $resource->description=$request->description;
        $resource->image=$image;

        $trainings->resources()->save($resource);

        return redirect('quiz')->with('categoryaddesuccess','Category Added Successfully');

    }
}

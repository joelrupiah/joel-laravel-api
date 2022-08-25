<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
   
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'client_id' => 'required',
            'imageOne' => 'required',
            'imageTwo' => 'required',
            'github' => 'required',
            'date' => 'required',
            'website' => 'required',
            'description' => 'required'

        ], 
        [
            'category_id.required' => 'The category field is required',
            'client_id.required' => 'The client field is required',
        ]);



    }


    public function show(Project $project)
    {
        //
    }

    public function edit(Project $project)
    {
        //
    }

    public function update(Request $request, Project $project)
    {
        //
    }

    public function destroy(Project $project)
    {
        //
    }
}

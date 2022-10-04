<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Image;

class ProjectController extends Controller
{
   
    public function index()
    {
        $projects = Project::with('category', 'client')->get();

        return response()->json([
            'projects' => $projects
        ], 200);
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

        $slug = slugify($request->title);

        $fileOne = explode(';', $request->imageOne);
        $fileOne = explode('/', $fileOne[0]);
        $file_one_ex = end($fileOne);

        $file_one_name = \Str::random(10) . '.' . $file_one_ex;

        $fileTwo = explode(';', $request->imageTwo);
        $fileTwo = explode('/', $fileTwo[0]);
        $file_two_ex = end($fileTwo);

        $file_two_name = \Str::random(10) . '.' . $file_two_ex;

        Project::create([
            'title' => $request->title,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'client_id' => $request->client_id,
            'github' => $request->github,
            'website' => $request->website,
            'description' => $request->description,
            'date' => $request->date,
            'imageOne' => $file_one_name,
            'imageTwo' => $file_two_name
        ]);

        Image::make($request->imageOne)->save(public_path('/uploads/images/projects/'). $file_one_name);
        Image::make($request->imageTwo)->save(public_path('/uploads/images/projects/'). $file_two_name);

        return response()->json('success', 200);
    }


    public function show(Project $project, $id)
    {
        $project = Project::where('id', $id)
                ->with('category', 'client')
                ->first();
        return response()->json([
            'project' => $project
        ], 200);
    }

    public function edit(Project $project)
    {
        //
    }

    public function update(Request $request, Project $project)
    {
        $project = Project::find($request->id);

        $mainImageOne = $project->imageOne;
        $mainImageTwo = $project->imageTwo;

        $project->title = $request->title;
        $project->category_id = $request->category_id;
        $project->client_id = $request->client_id;
        $project->website = $request->website;
        $project->github = $request->github;
        $project->date = $request->date;
        $project->description = $request->description;

        $imageOnePath = public_path('/uploads/images/projects/').$mainImageOne;
        if (file_exists($imageOnePath)) {
            unlink($imageOnePath);
        }

        $imageTwoPath = public_path('/uploads/images/projects/').$mainImageTwo;
        if (file_exists($imageTwoPath)) {
            unlink($imageTwoPath);
        }

        if ($request->imageOne != $project->imageOne) {
            $fileOne = explode(';', $request->imageOne);
            $fileOne = explode('/', $fileOne[0]);
            $file_one_ex = end($fileOne);
            $file_one_name = \Str::random(10) . '.' . $file_one_ex;
            $project->imageOne = $file_one_name;
            Image::make($request->imageOne)->save(public_path('/uploads/images/projects/').$file_one_name);
        }

        if ($request->imageTwo != $project->imageTwo) {
            $fileTwo = explode(';', $request->imageTwo);
            $fileTwo = explode('/', $fileTwo[0]);
            $file_two_ex = end($fileTwo);
            $file_two_name = \Str::random(10) . '.' . $file_two_ex;
            $project->imageTwo = $file_two_name;
            Image::make($request->imageTwo)->save(public_path('/uploads/images/projects/').$file_two_name);
        }

        $project->save();

        return response()->json('success', 200);
    }

    public function destroy(Project $project, $id)
    {
        $project = Project::find($id);

        $imageOne = $project->imageOne;
        $imageTwo = $project->imageTwo;

        $imageOnePath = public_path('/uploads/images/projects/').$imageOne;
        $imageTwoPath = public_path('/uploads/images/projects/').$imageTwo;

        if (file_exists($imageOnePath)) {
            unlink($imageOnePath);
        }elseif(file_exists($imageTwoPath)){
            unlink($imageTwoPath);
        }

        $project->delete();
    }
}

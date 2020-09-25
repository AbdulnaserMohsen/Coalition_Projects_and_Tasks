<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;
use Cache;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
	function index(Request $request)
	{
		$projects = Project::all();
		if(!$projects->isEmpty())
		{
			$intial_project = $projects->first(); //intial_project
			$tasks = Task::where('project_id',$intial_project->id)->orderBy('priority')->get();
			return view('index',compact('projects','tasks','intial_project'));
		}
		return view('index',compact('projects'));
		
	}

	function get_project(Request $request, $id)
	{
		$projects = Project::all();
		if(!$projects->isEmpty())
		{
			$intial_project = Project::where('id',$id)->first(); //intial_project
			$tasks = Task::where('project_id',$intial_project->id)->orderBy('priority')->get();
			return view('index',compact('projects','tasks','intial_project'));
		}
		return view('index',compact('projects'));
		
	}
	

	protected function validator(array $data)
    {
       return Validator::make($data, [
            'name' => ['required', 'string', 'max:255' , 'regex:/^[a-zA-Z1-9 ]+$/u'],
            'proj_id' => ['required', 'exists:projects,id'],
        ]);

    }

	function add_task(Request $request)
	{
		$this->validator($request->all())->validate();
		
		$task =Task::where('project_id',$request->get('proj_id'))->latest()->first();
		$priority = 0;
		if(isset($task))
		{
			$priority = $task->priority;
		}
		
    	$task = new Task();
        $task->name = $request->get('name');
        $task->project_id = $request->get('proj_id');
        $task->priority = ++$priority;
        $task->save();
		return response()->json(['success'=>'Added Successfully']);
		
	}

	public function edit_task(Request $request, $id)
    {
    	$this->validator($request->all())->validate();

        $task= Task::find($id);
        $task->name=$request->get('name');
        $task->save();
        return response()->json(['success'=>'Updated Successfully']);
    	 
    }

    public function delete_task($id)
    {
    	$task = Task::find($id);
        $task->delete();
        return response()->json(['success'=>'Deleted Successfully']);
    }

    public function set_priority(Request $request, $numbers)
    {
    	//dd($numbers);
    	$numbers = json_decode($numbers);
    	foreach ($numbers as $key => $number) 
    	{
    		$task = Task::find($number->id);
    		$priority = $key+1;
    		$task->priority = $priority;
    		$task->save();
    	}
    	return response()->json(['success'=>'Priority Updated Successfully']);
    }

	
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Traits\HttpRespones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    use HttpRespones;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
                           // Eloquent Provide Collection , but For API we need json
                           // {Collection} method will convert it json
        return TaskResource::collection
        (
           Task::where('user_id' , Auth::user()->id)->get()
         );

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return TaskResource
     */
    public function store(StoreTaskRequest $request)   // Take the Request under the Rules that comes from "StoreTaskRequest"
    {
        $request->validated(request()->all());

        $task = Task::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name ,
            'body' => $request->body ,
            'priority' => $request->priority
        ]);

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task )
    {
        return $this->notAllowed($task) ? $this->notAllowed($task) : new TaskResource($task);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {

        if (Auth::user()->id !== $task->user_id)
        {
            return $this->error("" , "You Are not allowed" , 403);
        }

        $task->update($request->all());

        return new TaskResource($task);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        return $this->notAllowed($task) ? $this->notAllowed($task) : $task->delete();
    }

    private function notAllowed($task)
    {
        if (Auth::user()->id !== $task->user_id)
        {
            return $this->error("" , "You Are not allowed" , 403);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Model\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //筛选条件
        $search=$request->input('search');
        $status=$request->input('status');
        $start=$request->input('start');
        $end=$request->input('end');
        $end= date('Y-m-d H:i:s',strtotime( '+1 day',strtotime($end)));



        $list=Task::with(['postUser','getUser'])
            ->when($search,function ($query,$search){
                return $query->where('title','like',"%$search%");
            })
            ->when($status,function ($query,$status){
                return $query->where('status',$status);
            })
            ->when($start,function ($query,$start){
                return $query->where('created_at','>',$start);
            })
            ->when($end,function ($query,$end){
                return $query->where('created_at','<',$end);
            })
            ->paginate(15);

        return TaskResource::collection($list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'bail|required|unique:tasks|max:255',
            'content' => 'required',
        ]);
        $taskRequest=$request->all();
        $taskRequest['post_user']=Auth::id();
        $task=Task::create($taskRequest);

       return new TaskResource(['code'=>200,'data'=>$task]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //$task=Task::find($id);
        $status=$request->input('status');
        $price=$request->input('price');

        //状态为1
        if($status=='1'){
            $task->status=$status;

            $task->get_user=Auth::id();
        }

        if($status=='2'){
            $task->status=$status;
            $task->success_time=date('Y-m-d H:i:s');
        }

        if($price){
            $task->price=$price;
        }

        $task->save();

        return new TaskResource(['code'=>200,'data'=>$task]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

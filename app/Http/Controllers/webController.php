<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Model\Admin;
 
class webController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     //$this->middleware('auth');
    // }


    public function index(){
    	// $data = Carbon::parse(date("Y-m-d H:i:s"))->timezone('Europe/Paris')->toDateTimeString();
        // print_r($data);exit;
        $current_time_zone = date_default_timezone_get();
        date_default_timezone_set($current_time_zone);

       // $current_time = Carbon::parse(date("Y-m-d H:i:s"))->timezone($current_time_zone)->toDateTimeString();
        
        $data = Admin::getAllTask();
        $returnData = [];
        foreach ($data as $key => $value) {
            $deadline = $value->deadline;
            $deadline_time = Carbon::parse($deadline)->timezone($current_time_zone)->toDateTimeString();
            $time = date("h:i A \, jS F", strtotime($deadline_time));
            $returnData[] = [
                'task_name' => $value->task_name,
                'deadline' => $time
            ];
        }

        

        return view('toDoList')->with('returnData', $returnData);
        // $current_date_time=Carbon::now();
        //
        //echo 
        // $current_date_time=Carbon::now();
        // echo $data;
    }

    public function addTask(Request $req){
        $task_name = $req->input('task_name');
        $deadline = strtotime($req->input('deadline'));
        $deadline_time = date('Y-m-d H:i:s', $deadline);

        $data = [
            'task_name' => $task_name,
            'deadline' => $deadline_time
        ];

        $id = Admin::addTask($data);
        return Response::json(array('success' => true), 200);

    }

//    $old_date = date('l, F d y h:i:s');              // returns Saturday, January 30 10 02:06:34
// $old_date_timestamp = strtotime($old_date);
// $new_date = date('Y-m-d H:i:s', $old_date_timestamp);   

}

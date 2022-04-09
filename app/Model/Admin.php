<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DataTables;

class Admin extends Model {

    

    public static function addTask($data)
    {
        return DB::table('tbl_todo')->insertGetId($data);
    }

    public static function getAllTask()
    {
        return DB::table('tbl_todo')->select('*')->orderBy('id','DESC')->get();
    }

    
}

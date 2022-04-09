<?php

use Twilio\Rest\Client;

/*
  |--------------------------------------------------------------------------
  | predefined global functions
  |--------------------------------------------------------------------------
  |
  |
 */

/**
 * encode html tags
 */
function Encode($str) {
    return trim(htmlentities($str, ENT_QUOTES));
}

/**
 * decode html tags
 */
function Decode($str) {
    return stripslashes(html_entity_decode($str));
}

/**
 * get users from db
 */
function users($role_id = null) {
    $query = DB::table('portal_users as au')
            ->join('app_roles as ar', 'au.role_id', '=','ar.role_id')
            ->select('au.*')
            ->where('au.is_active', '=', '1');
    if(!empty($role_id)){
        $query->where('au.role_id','=',$role_id);
    }
    return $query->get();
}

/**
 * get roles from db
 */
function roles() {
    $query = DB::table('app_roles')
            ->where('is_active', '=', '1')
            ->orderBy('role_id', 'asc');
    $query->where('role_id', '!=', 1);
    return $query->get();
}

/**
 * get modules from db
 */
function modules() {
    return DB::table('app_modules as m')
                    ->join('app_pages as p', 'm.module_id', '=', 'p.module_id')
                    ->select('m.*', 'p.*')
                    ->where('m.is_active', '=', '1')
                    ->where('p.is_active', '=', '1')
                    // ->groupBy('m.module_id')
                    ->orderBy('m.module_order', 'asc')
                    ->orderBy('p.page_order', 'asc')
                    ->get();
}

/**
 * get pages from db
 */
function pages($id) {
    return DB::table('app_modules as m')
                    ->join('app_pages as p', 'm.module_id', '=', 'p.module_id')
                    ->select('m.*', 'p.*')
                    ->where('m.is_active', '=', '1')
                    ->where('p.is_active', '=', '1')
                    ->where('m.module_id', '=', $id)
                    ->orderBy('p.page_order', 'asc')
                    ->get();
}

/**
 * get access pages from db
 */
function accessPages($id) {
    return DB::table('app_modules as m')
                    ->join('app_pages as p', 'm.module_id', '=', 'p.module_id')
                    ->join('app_access as a', 'p.page_id', '=', 'a.page_id')
                    ->select('m.*', 'p.*')
                    ->where('m.is_active', '=', '1')
                    ->where('p.is_active', '=', '1')
                    ->where('a.id', '=', $id)
                    ->orderBy('m.module_order', 'asc')
                    ->orderBy('p.page_order', 'asc')
                    ->get();
}


function time_ago($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }


    if (!$full)
        $string = array_slice($string, 0, 1);

    $string = $string ? implode(' ago, ', $string) : 'just now';
    return explode(', ', $string)[0];
}
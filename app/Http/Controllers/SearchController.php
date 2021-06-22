<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class SearchController extends Controller
{
    
  function search(Request $r){

        try{
          if($r->ajax())
          {
           $output = '';
           $query = $r->get('search');
           if($query != '')
           {
              if (Auth::user()->role_id == 1) {
                $data = DB::table('search_links')
                ->where('name', 'like', '%'.$query.'%')
                ->where('route', '!=', '')
                ->orderBy('id', 'desc')
                ->get();
                return response()->json($data, 200);
              }
              else {
                $data = DB::table('search_links')
                ->join('role_permission', 'search_links.id', '=', 'role_permission.permission_id')
                ->select('search_links.id','search_links.name as name','search_links.route', 'role_permission.role_id as role_id')
                ->where('name', 'like', '%'.$query.'%')
                ->where('route', '!=', '')
                ->where('role_id', @Auth::user()->role_id)
                ->orderBy('id', 'desc')
                ->get();
                return response()->json($data, 200);
              }
          }
          else {
              return response()->json(['not found'=>'Not Foound'], 404);

            }

          }
        }catch (\Exception $e) {
           Toastr::error('Operation Failed', 'Failed');
           return redirect()->back();
        }
    }

}

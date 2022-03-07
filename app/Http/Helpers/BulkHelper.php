<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\ShortCut;
use App\Models\Wall;
use App\Models\Question;
use App\DataTables\PageArchiveDataTable;

trait BulkHelper{


    public function bulkAction(Request $request)
    {  
    	//return response()->json($request->action);
    	switch ($request->type) {
    		case 'page':
    			return $this->pages($request->ids,$request->action);
    			break;
    		case 'question':
    			return $this->questions($request->ids);
    			break;
    		case 'wall':
    			return $this->shortCuts($request->ids);
    			break;
    		case 'shortcut':
    			return $this->walls($request->ids);
    			break;
    		
    		default:
    			return response()->json(['data'=>'faild']);
    			break;
    	}

    }   


    public function pages($data,$action)
    {
      if($action =='trash')
      { 
         if (!isset(auth()->user()->role->permission->permissions['pages']['can-delete']))
         {
           return  abort(403);
        }
          if(is_array($data))
          {
          	if(Page::whereIn('id',$data)->delete())
            {
            	return response()->json(['data'=>'done']);
            }
            else
            {
         	    return response()->json(['data'=>'faild']);
            }
          }
          else
          {
          	return (Page::findOrFail($data)->delete())?response()->json(['data'=>'done']):response()->json(['data'=>'faild']);
          }
          


      }
      if($action == 'delete')
      {
         if (!isset(auth()->user()->role->permission->permissions['pages']['can-delete']))
         {
            return abort(403);
        }

         if(is_array($data))
          {
          	if(Page::whereIn('id',$data)->forceDelete())
            {
            	return response()->json(['data'=>'done']);
            }
            else
            {
         	    return response()->json(['data'=>'faild']);
            }
          }
          else
          {
          	return (Page::findOrFail($data)->forceDelete())?response()->json(['data'=>'done']):response()->json(['data'=>'faild']);
          }

      }

    }

    public function questions($data)
    {

    }

    public function shortCuts($data)
    {

    }

    public function walls($data)
    {

    }

}
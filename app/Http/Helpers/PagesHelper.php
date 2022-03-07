<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Category;
use App\DataTables\PageArchiveDataTable;

trait PagesHelper{
   

    public function pageView($slug)
    {
        $page = Page::with('category')->where('slug',$slug)->where('published',1)->where('is_history',0)->get();

        if(count($page) <= 0)
        {
            return abort(404, 'Page not found.');
        }

         return view('page_view',compact('page'));         
    }

    public function pageSearch(Request $request)
    {
         $request->validate(['keyword'=>'string']);

         $keyword = $request->keyword;
      
         $page_titles = DB::table('pages')->select('title','id','slug')->where('title', 'LIKE',"%{$keyword}%")->where('published',1)->where('is_history',0)->whereNull('deleted_at')->get();

         return response()->json($page_titles);
    }

    public function pageStatus(Request $request,Page $page)
    {    

        $request->validate(['id'=>'required|integer','published'=>'required|integer']);
       
         $id        = $request->id;
         $published = ($request->published == 0)?1:0; 
         $page      = Page::findOrFail($id);
         $publisher = ($published && $page->published != 1)?auth()->user()->id:$page->publisher_id;

          if ($request->user()->cannot('publish',$page)) {
            abort(403);
        }
          
        $page->update(['published'=>$published,'publisher_id'=>$publisher]);         

        return response()->json(['status'=>$published]);
                        

    }

    public function pageArchive(Request $request,PageArchiveDataTable $table,Page $page)
    {   
        if ($request->user()->cannot('delete',$page)) {
            abort(403);
        }
         return $table->render('admin.pages.archive');
    }

    public function restoreArchiveData(Request $request,Page $page)
    {
        
         if ($request->user()->cannot('restore',$page)) {
            abort(403);
        }
             Page::withTrashed()->where('id',$request->id)->restore();
             
           return redirect()->route('page_archive')->with('msg','Page Restored');
        

    }

    public function deleteArchive(Request $request,Page $page)
    {   

       if ($request->user()->cannot('forceDelete',$page)) {
            abort(403);
        }

        $page = Page::withTrashed()->where('id',$request->id)->get();

        $history = Page::where('refer_to',$page[0]->refer_to)->where('id','!=',$request->id)->where('is_history',1)->get();
        if(count($history) > 0 )
        {
            foreach($history as $update)
            {
               Page::where('id',$update->id)->forceDelete();
            }
        }
          
          Page::withTrashed()->where('id',$request->id)->forceDelete();
           return redirect()->route('page_archive')->with('msg','Page Deleted');
        
    }

    public function PageHistory($id,Request $request,Page $page)
    {   
        if ($request->user()->cannot('update',$page)) {
            abort(403);
        }

        $parentPage = Page::whereNotNull('refer_to')->where('id',$id)->get();
         
        if( count($parentPage) )
        {
           $history = Page::where('refer_to',$parentPage[0]->refer_to)->where('id','!=',$id)->where('is_history',1)->get();
           $parent_page = $id;
            //return dd($history);
         
           if(count($history))
           {
             return view('admin.pages.history',compact('history','parent_page')); 
           }
           else{
            return abort(404, 'Page not found.');
           }

        }
        else
        {
            return abort(404, 'Page not found.');

        }

        
    }

    public function countPageHistory($page)
    {
       return Page::where('refer_to',$page->refer_to)->where('id','!=',$page->id)->where('is_history',1)->count();
    }

    public function deletePageHistory(Request $request,Page $page)
    {
        if ($request->user()->cannot('forceDelete',$page)) {
            abort(403);
        }

        Page::withTrashed()->where('id',$request->id)->forceDelete();


      return redirect()->route('page.edit',$request->parent_id)->with('msg','History Deleted');


    }

    public function toggleNumber( $num ) {
             return $num ^= 1;
      }


}
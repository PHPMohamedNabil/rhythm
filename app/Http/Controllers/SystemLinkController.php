<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemLink;
use App\DataTables\SystemLinkDataTable;


class SystemLinkController extends Controller
{


    public function __construct()
    {
      $this->authorizeResource(SystemLink::class,'systemlink');
           //     dd($this->getMiddleware());


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.systemlink.index',['links'=>Systemlink::all()]);

    }

    public function getLinksView(SystemLinkDataTable $table)
    {
         return $table->render('system_links');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.systemlink.index',['links'=>Systemlink::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateReq($request);

         Systemlink::create($request->all());

         return redirect()->route('systemlink.index')->with('msg','created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('systemlink');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SystemLink $systemlink)
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
    public function update(Request $request,Systemlink $systemlink)
    {
          $this->validateReq($request);

         $systemlink->update([
                'link_name'=>$request->link_name,
                'url'      =>$request->url,
             ]);

         return redirect()->route('systemlink.index')->with('msg','updated successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Systemlink $systemlink)
    {
      
        $name = $systemlink->link_name;
        $systemlink->delete();

        return redirect()->route('systemlink.index')->with('del', $name);
    }

    public function validateReq($request)
    {
       return  $this->validate($request,[
                    'link_name'=>'min:3|max:50|required|string',
                    'url'=>'required|url',
             ]);
    }
}

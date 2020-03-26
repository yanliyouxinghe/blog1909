<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shopping;
class PlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rest =  Shopping::get();
        return view('plot.list',['rest'=>$rest]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plot.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->except('_token');
        $shopping = new Shopping();

        if($request->hasFile('plot_img')){
            $post['plot_img'] = $this->uploads('plot_img');
       }


       $res =  $shopping->insert($post);
        if($res){
            return redirect('plot/index');
        }


    }


     public function  uploads($img)
     {  
         if(request()->file($img)->isValid()){
            $file = request()->$img;
            $store_result = $file->store('uploads');
            return $store_result;;
         }
         exit('出现错误');
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
    public function update(Request $request, $id)
    {
        //
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

<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Category;
use App\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // Redis::flushall();
        $news_name = request()->news_name;
        $where = [];
        if($news_name){
            $where[]=['news_name','like',"%$news_name%"];
        }
        $pageSize = config('app.pageSize');
        $news = Redis::get('news');
        if(!$news){
             echo 'Redis';
        $news = News::where($where)->paginate($pageSize);
        $news = serialize($news);
        $news = Redis::setex('news',60*60*24,$news); 
        if(request()->ajax()){
            return view('news.ajaxpage',['news'=>$news,'news_name'=>$news_name]);
    
        }
    }
    $news = unserialize($news);
  
        return view('news.index',['news'=>$news,'news_name'=>$news_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = request()->validate([
            'news_name' => 'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,30}$/u',
            'news_men' => 'required',
        ],[
            'news_name.required'=>'新闻标题不能为空！',
            'news_name.regex'=>'新闻名称可以包括中文，数字，字母，下划线，长度2~30位',
            'news_men.required'=>'新闻作者不能为空！',
        ]);
        $post = $request->except('_token');
        $post['news_time']=time();
        $res = News::insert($post);
        if($res){
            return redirect('/news/index',);
        }
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Writes;
use App\Write;
use Validator;
class WriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //展示视图
        $writename=request()->write_name;
        $where=[];
        if($writename){
            $where[]=['write_name','like',"%$writename%"];
        }
        $pid=request()->pid;
        if($pid){
            $where[]=['write.p_id',$pid];
        }

        $page=config('app.pageSize');
        $writeInfo=Write::join('writes','write.p_id','=','writes.p_id')->where($where)->paginate($page);
        $res=Writes::all();
        return view('admin.write.write',['writeInfo'=>$writeInfo,'res'=>$res,'writename'=>$writename]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加视图
        $res=Writes::all();
        return view('admin.write.create',['res'=>$res]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //添加执行
        $data=request()->except('_token');
        //验证
        $validator=Validator::make($data,[
            'write_name'=>'required|unique:write|regex:/^[\x{4e00-\x{9fa5}}\w]{1,}$/u',
            'p_id'=>'required',
            'write_zyx'=>'required',
            'is_show'=>'required',
        ],[
            'write_name.required'=>"文章标题不能为空",
            'write_name.unique'=>"文章标题重复",
            'write_name.regex'=>"文章标题由中文、字母、数字和下划线组成",
            'p_id.required'=>"文章分类不能为空",
            'write_zyx.required'=>"重要性不能为空",
            'is_show.required'=>"是否显示不能为空",
        ]);
        if($validator->fails()){
            return redirect('write/create')->withErrors($validator)->withInput();
        }

        //上传文件
        if(request()->hasFile('write_img')){
            $data['write_img']=$this->upload('write_img');
        }
        $data['write_time']=time();
        $res=Write::insert($data);
        if($res){
            return redirect('/write');
        }
    }
    //上传文件
    public function upload($filename){
        if(request()->file($filename)->isValid()){
            $file=request()->$filename;
            $path=$file->store('uploads');
            return $path;
        }
        exit('文件上传出错！');
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
        //修改视图
        $res1=Writes::all();
        $res2=Write::find($id);
        return view('admin.write.edit',['res1'=>$res1,'res2'=>$res2]);
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
        //修改执行
        $data=request()->except('_token');
        if(request()->hasFile('write_img')){
            $data['write_img']=$this->upload('write_img');
        }
        $data['write_time']=time();
        $res=Write::where('write_id',$id)->update($data);
        if($res!==false){
            return redirect('/write');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除执行
        $res=Write::destroy($id);
        if($res){
            return redirect('/write');
        }

    }
}

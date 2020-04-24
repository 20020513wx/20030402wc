
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"> 
  <title>Bootstrap 2020年中国最大电商城--分类管理</title>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">文海</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="{{url('/write')}}">文章管理</a></li>
      </ul>
    </div>
  </div>
</nav>
<center><h2>文章修改<a style="float:right;" href="{{url('/write')}}" class="btn btn-success">列表</a></hr></h2><hr/></center>

<form action="{{url('/write/update/'.$res2->write_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
@csrf
<!-- {{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}"> -->
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">文章标题</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="{{$res2->write_name}}" name="write_name" id="firstname" 
           placeholder="请输入文章标题">
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">文章分类</label>
    <div class="col-sm-10">
      <select class="form-control" name="p_id">
        <option value="0">请选择...</option>
        @foreach($res1 as $v)
        <option value="{{$v->p_id}}">{{$v->name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">文章重要性</label>
    <div class="col-sm-10">
      <input type="radio" name="write_zyx" value="1" {{$res2->write_zyx==1?'checked':''}}>普通
      <input type="radio" name="write_zyx" value="2" {{$res2->write_zyx==2?'checked':''}}>置顶
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">是否显示</label>
    <div class="col-sm-10">
      <input type="radio" name="is_show" value="1" {{$res2->is_show==1?'checked':''}}>显示
      <input type="radio" name="is_show" value="2" {{$res2->is_show==2?'checked':''}}>不显示
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">文章作者</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="write_man" value="{{$res2->write_man}}" id="firstname" 
           placeholder="请输入文章作者">
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">作者email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="write_email" value="{{$res2->write_email}}" id="firstname" 
           placeholder="请输入作者邮箱">
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">关键字</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="write_gjz" id="firstname" 
           placeholder="请输入关键字" value="{{$res2->write_gjz}}">
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">网页描述</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="write_desc" placeholder="请输入网页描述"> {{$res2->write_desc}}</textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">上传文件</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" name="write_img" id="firstname" >
      @if($res2->write_img)<img width="100" src="{{env('UPLOADS_URL')}}{{$res2->write_img}}">@endif
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">提交</button>
    </div>
  </div>
</form>

</body>
</html>

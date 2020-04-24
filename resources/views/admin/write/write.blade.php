
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 一个简单的网页</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	

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
<center><h2>文章管理 <a style="float:right;" href="{{url('/write/create')}}" class="btn btn-success">添加</a></hr></h2></center>
<form>
	搜索标题<input type="text" name="write_name" value="{{$writename}}">
	搜索分类<select name="pid">
		<option value="">请选择...</option>
		@foreach($res as $v)
		<option value="{{$v->p_id}}">{{$v->name}}</option>
		@endforeach
	</select>
	<input type="submit" value="搜索">
</form>
<table class="table table-striped">
	<caption></caption>
	<thead>
		<tr>
			<th>文章ID</th>
			<th>文章标题</th>
			<th>文章分类</th>
			<th>文章重要性</th>
			<th>是否显示</th>
			<th>文章作者</th>
			<th>作者email</th>
			<th>关键字</th>
			<th>网页描述</th>
			<th>上传文件</th>
			<td>操作</td>
		</tr>
	</thead>
	@foreach($writeInfo as $v)
	<tbody>
		<tr>
			<td>{{$v->write_id}}</td>
			<td>{{$v->write_name}}</td>
			<td>{{$v->name}}</td>
			<td>{{$v->write_zyx==1?'普通':'置顶'}}</td>
			<td>{{$v->is_show==1?'显示':'不显示'}}</td>
			<td>{{$v->write_man}}</td>
			<td>{{$v->write_email}}</td>
			<td>{{$v->write_gjz}}</td>
			<td>{{$v->write_desc}}</td>
			<td>{{date('Y-m-d H:i:s',$v->write_time)}}</td>
			<td>@if($v->write_img)<img width="100" src="{{env('UPLOADS_URL')}}{{$v->write_img}}">@endif</td>
			<td><a href="{{url('/write/edit/'.$v->write_id)}}" class="btn btn-success">
			编辑</a> | <a  href="{{url('/write/destroy/'.$v->write_id)}}" class="btn btn-danger del">
			删除</a></td>
		</tr>
	</tbody>
	@endforeach
	<tr>
		<td colspan="8" align="center">{{$writeInfo->appends(['write_name'=>$writename])->links()}}</td>
	</tr>
</table>

</body>
</html>
<script>
	$(document).on('click','.del',function(){
		var _this=$(this)
		var url=_this.attr('href');
		if(window.confirm("确认删除？")){
			$.get(url,function(res){
				_this.parents("tr").remove();
			});
		}
		return false;
	})
</script>
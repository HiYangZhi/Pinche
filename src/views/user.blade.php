@extends('pinche::layouts.app')

@section('content')
    <div class="row">
		<div class="col-md-12">
	        <div class="box" style="margin-top: 20px;">
	        <div class="box-header">
	          <h3 class="box-title">用户信息列表</h3>
	        </div><!-- /.box-header -->
	        <div class="box-body no-padding">
	          	<table class="table table-condensed">
		            <tbody><tr>
		              <th style="width: 10px">#</th>
		              <th>openid</th>
		              <th>用户昵称</th>
		              <th>性别</th>
		              <th>省份</th>
		              <th>城市</th>
		              <th>联系方式</th>
		              <th>创建时间</th>
		            </tr>
		            
		            	@foreach ($users as $element)
		            	<tr>
		            		<td>{{$element->id}}</td>
		            		<td>{{$element->openid}}</td>
		            		<td>{{$element->nickname}}</td>
		            		<td>{{$element->sex}}</td>
		            		<td>{{$element->province}}</td>
		            		<td>{{$element->city}}</td>
		            		<td>{{$element->contact}}</td>
		            		<td>{{$element->created_at}}</td>
			            </tr>
		            	@endforeach
		            </tbody>
	            </table>
	        </div><!-- /.box-body -->
	      </div><!-- /.box -->
	    </div>
	</div>
@endsection

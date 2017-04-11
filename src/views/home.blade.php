@extends('pinche::layouts.app')

@section('content')
    <div class="row">
		<div class="col-md-12">
	        <div class="box" style="margin-top: 20px;">
	        <div class="box-header">
	          <h3 class="box-title">拼车信息列表</h3>
	        </div><!-- /.box-header -->
	        <div class="box-body no-padding">
	          <table class="table table-condensed">
	            <tbody><tr>
	              <th style="width: 10px">#</th>
	              <th>类型</th>
	              <th>出发地</th>
	              <th>目的地</th>
	              <th>时间</th>
	              <th>价格</th>
	              <th>座位</th>
	              <th>已占座位</th>
	              <th>联系方式</th>
	              <th>附加信息</th>
	              <th> </th>
	            </tr>
	            
	            	@foreach ($infoes as $element)
	            	<tr>
	            		<td>{{$element->id}}</td>
	            		<td>@if ($element->type == 0)
	            			车找人
	            		@else
	            			人找车
	            		@endif           </td>
	            		<td>{{$element->departure}}</td>
	            		<td>{{$element->destination}}</td>
	            		<td>{{$element->time}}</td>
	            		<td>@if ($element->price == 0)
	            			面议
	            			@elseif($element->price < 0)
	            			免费
		            		@else
		            			{{$element->price}}元/人
		            		@endif           
		            	</td>
		            	<td>{{$element->seat}}</td>
		            	<td>{{$element->seat_taken}}</td>
		            	<td>{{$element->contact}}</td>
		            	<td width="360">{{$element->info}}</td>
		            	<td>
			            	{!! Form::open(['route' => ['deleteinfo', $element->id], 'method' => 'delete']) !!}
			                <div class='btn-group'>
			                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除?')"]) !!}
			                </div>
			                {!! Form::close() !!}
		                </td>
		            	
		            	</tr>
	            	@endforeach
	            
	            
	          </tbody></table>
	        </div><!-- /.box-body -->
	      </div><!-- /.box -->
	    </div>

</div>
@endsection

@extends('common.base')


@section('title','学生列表')

@section('content')
	<table border="1" cellpadding="2" width="100%">
		
		<thead><th>ID</th><th>学号</th><th>姓名</th><th>课程</th><th>分数</th></thead>
		<tbody>
			@foreach($list as $key => $value)
			<tr>
				<td>{{$value->id}}</td>
				<td>{{$value->stu_no}}</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{{$list->links()}}
@endsection
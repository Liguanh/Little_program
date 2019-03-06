@extends('common.base')

@section('title','第一个laravel视图')

@section('sidebar')
            <font style="font-size: 50px;">这是主布局的侧边栏。</font>
 @endsection

@section('content')
	@if($message == 1) 
		{{$message}}
	@else 
		<div>内容没有找到</div>
	@endif

	@for($i=1;$i<10;$i++)
		{{$i}}
	@endfor

	@foreach($bp_user as $key => $user)

		<li>{{$user->id}}</li>
	@endforeach

	<form action="" method="post">

		
		
		<input type="text" name="">

		<input type="submit">
	</form>

	{{$bp_user->links()}}

@endsection
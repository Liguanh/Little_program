<!DOCTYPE html>
<html>
<head>
	<title>足球竞猜添加页面</title>
</head>
<body style="width: 100%;">

	<div style="margin: 0px auto;">
		<form method="post" action="/study/guess/doGuess">
			{{csrf_field()}}
			<input type="hidden" value="{{$user_id}}" name="user_id">
			<input type="hidden" value="{{$info['id']}}" name="team_id">
			<table style="width: 100%; border: #d4d4d4 1px solid">
			<tr><td style="width: 300px;text-align: center;font-weight: bold;">我要竞猜</td></tr>
			<tr><td style="width: 300px;text-align: center;">{{$info['team_a']}} VS {{$info['team_b']}} </td></tr>
			<tr><td style="width: 300px;text-align: center;">
				<input type="radio" name="g_result" value="1">胜
				<input type="radio" name="g_result" value="3">负
				<input type="radio" name="g_result" value="2">平
			</td></tr>
			<tr><td style="width: 300px;text-align: center;"><input type="submit" value="竞猜"></td></tr>
		</table>
		</form>
		
	</div>

</body>
</html>
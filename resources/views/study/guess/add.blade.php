<!DOCTYPE html>
<html>
<head>
	<title>足球竞猜添加页面</title>
</head>
<body style="width: 100%;">

	<div style="margin: 0px auto;">
		<form method="post" action="/study/guess/doAdd">
			{{csrf_field()}}
			<table style="width: 100%; border: #d4d4d4 1px solid">
			<tr><td style="width: 300px;text-align: center;font-weight: bold;">添加竞猜球队</td></tr>
			<tr><td style="width: 300px;text-align: center;"><input type="text" name="team_a"> VS <input type="text" name="team_b"></td></tr>
			<tr><td style="width: 300px;text-align: center;">竞猜结束时间 <input type="text" name="end_at"></td></tr>
			<tr><td style="width: 300px;text-align: center;"><input type="submit" value="添加"></td></tr>
		</table>
		</form>
		
	</div>

</body>
</html>
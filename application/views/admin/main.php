<html>
<head>
	<title>Admin</title>
	<link href="/shared/css/bootstrap.css" rel="stylesheet">
	<script src="/shared/js/libs/jquery-1.8.1.min.js"></script>
	<script src="/shared/js/libs/bootstrap.min.js"></script>
	<script src="/shared/js/libs/jquery.json.js"></script>

	<script src="/shared/js/admin.js"></script>
	<style>
		input[type="text"]{
			height:30px;
		}
		input[type="password"]{
			height:30px;
		}
	
	</style>
</head>
<body>

<div class="container-fluid" style="margin-top:5px;">
	<?=$menu?>
	<div class="row-fluid">
		<?=$content?>
	</div>
</div>
</body>
</html>
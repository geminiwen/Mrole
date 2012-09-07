<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<script type="text/javascript" src="resources/js/jquery-min.js"></script>
</script>
<body>
<?
	$a = array('username' => 'test', 'age' => 10);
	$c = array('username' => 'test2' );
	$b = array( $a,$c );
	echo count($a);
	foreach( $b as $arr )
	{
		var_dump($arr);
	}
	?>
</body>
</html>

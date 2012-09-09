<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to mrole</title>
</head>
<body>
<img src = "/mrole/upload/<?php echo $img;?>" />
<form action="/mrole/index.php/pic_control/up" method="post" enctype="multipart/form-data">
<input type="file" name="upfile">
<input type="submit" name="submit" value="现在上传" />
</form>
</body>
</html>
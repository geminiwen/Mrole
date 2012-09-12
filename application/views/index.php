<!DOCTYPE html>
<html lang="zh-CN">
	<head>
	<meta charset="utf-8" />
	<META http-equiv="X-UA-Compatible" content="IE=9" >
	<link rel="stylesheet" type="text/css" href="resources/css/index.css" >
	<script type="text/javascript" src="resources/js/jquery-min.js"></script>
	<script type="text/javascript" src="resources/js/jquery.poshytip.min.js"></script>
	<script type="text/javascript" src="resources/js/jquery.ui.core.js"></script>
	<script type="text/javascript" src="resources/js/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="resources/js/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="resources/js/jquery.ui.datepicker-zh-CN.js"></script>
	<script type="text/javascript" src="resources/js/index.js"></script>
	
	
	<link rel="stylesheet" href="resources/css/tip-green/tip-green.css" type="text/css" />
	<link rel="stylesheet" href="resources/css/le-frog/jquery.ui.all.css" type="text/css" />
	<title>脉络</title>
	</head>
	<body>
		<div id="content">
			<img class="title" src="resources/img/title_mrole.png"  />
			<div id="titleText" >脉络 ,Easy,Amazing,Convenient.</div>
			<div class="bodyBox">
				<div id="bodyBoxCtn" style="display: none">
				<input type="text" id="searchBox" >
				<input type="submit" id="searchBtn" placeholder="搜索" class="indextext" value="搜索" style="padding-left:10px;" >
				
				<p class="indextext" id="regBtn"  >注册账号</p>
				<p class="indextext" id="loginBtn">马上登陆</p>
				</div>
			</div>
			<div class="animateBox">
				<ul class="slideBox regBox">
				<form action="register" method="post" id="regform" >
					<li id="li_first_page">
					<div class="data_input" style="margin-top:25px"><label for="reg_username">学号：</label><input type="text" name="username" class="inputText" id="reg_username" /></div>
					<div class="data_input"><label for="reg_realname">姓名：</label><input type="text" name="realname" class="inputText" id="reg_realname" readonly /></div>
					<div class="data_input" style="margin-top:30px"><div id="reg_next_btn" class="nextBtn" ><img width="52" height="44" src="resources/img/right_arrow_disabled.png" id="img_next_btn_1" /></div></div>
					</li>
					<li id="li_second_page" class="hidden">
					<div class="data_input"  style="margin-top:25px"  ><div class="prevSpace prevBtn" ><img width="52" height="44" src="resources/img/left_arrow.png"  /></div>
                    <label for="reg_password" style="float:left;">密码：</label><input type="password" name="password" class="inputText detailInfo" id="reg_password"/><div class="clear" ></div></div>
					<div class="data_input"><div class="prevSpace">&nbsp;</div>
                    <label for="reg_job" style="float:left;">职务：</label><input type="text" name="job" class="inputText detailInfo" id="reg_job" title="请输入你的在校职务用,分割（如班长,XX社团社长）" /><div class="clear"></div></div>
					<div class="data_input"><div class="prevSpace">&nbsp;</div>
                    <label for="reg_birthday" style="float:left;">生日：</label><input type="text" name="brithday" class="inputText detailInfo" id="reg_birthday" title="请输入你的出生年/月/日" /><div class="clear" ></div></div>
					<div class="data_input"><div class="prevSpace">&nbsp;</div>
                    <label for="reg_email" style="float:left;">邮箱：</label><input type="text" name="email" class="inputText detailInfo" id="reg_email" title="请输入你的Email地址" /><div class="clear" ></div></div>
					<div class="data_input" ><div class="prevSpace" id="reg_submit_btn"><img width="52" height="44" src="resources/img/right_arrow_disabled.png" id="img_next_btn_2"  /></div><input type="text" name="captcha" class="inputText detailInfo" id="reg_captcha" /> <img alt="test" style="float:left" width="76" height="48" src="captcha?i=<?= rand(); ?>" id="captcha" /><div class="clear" ></div></div>
					</li>
				</form>
				</ul>
				<ul class="slideBox loginBox">
					<li>
					<div>
						<form action="login" method="post" id="loginform" >
							<div class="data_input"><label for="login_username">学号：</label><input type="text" name="username" class="inputText" id="login_username"  /></div>
							<div class="data_input"><label for="login_password">密码：</label><input type="text" name="password" class="inputText" id="login_password"   /></div>
							<div class="data_input" style="display:inline"><input type="button" value="马上登陆" class="loginBtn" id="login_btn" /></div>
						</form>
					</div>
					</li>
				</ul>
				
			</div>
				
		</div>
	</body>
</html> 
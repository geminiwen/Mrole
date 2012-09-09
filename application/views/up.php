<html>
<meta charset="utf-8">
<script language="javascript">            
            function checkpassword(){
                var div = document.getElementById("div1");
                div.innerHTML = "";
                var password = document.form1.password.value;
                if (password == "") {
                    div.innerHTML = "密码不能为空！";
                    document.form1.password.focus();
                    return false;
                }
                if (password.length < 8 || password.length > 16) {
                    div.innerHTML = "密码长度8-16位";
                    document.form1.password.select();
                    return false;
                }
                return true;
            }
			 function checkemail(){
                var div = document.getElementById("div2");
                div.innerHTML = "";
                var e_mail = document.form1.e_mail.value;
                var sw = e_mail.indexOf("@", 0);
                var sw1 = e_mail.indexOf(".", 0);
                var tt = sw1 - sw;
                if (e_mail.length == 0) {
                    div.innerHTML = "邮箱地址不能为空";
                    document.form1.e_mail.focus();
                    return false;
                }
                if (e_mail.indexOf("@", 0) == -1) {
                    div.innerHTML = "邮箱格式不正确，必须包含@符号！";
                    document.form1.e_mail.select();
                    return false;
                }
                if (e_mail.indexOf(".", 0) == -1) {
                    div.innerHTML = "电子邮件格式不正确，必须包含.符号！";
                    document.form1.e_mail.select();
                    return false;
                }
                if (tt == 1) {
                    div.innerHTML = "邮件格式不对@和.不可以挨着！";
                    document.form1.e_mail.select();
                    return false;
                }
                if (sw > sw1) {
                    div.innerHTML = "电子邮件格式不正确，@符号必须在.之前";
                    document.form1.e_mail.select();
                    return false;
                }
                    return true;
				}        
            function check(){
                if ( checkpassword() && checkemail()  ) {
                    return true;
                }
                else {
                    return false;
                }
			}
 </script>
<body onLoad="init()">





<form action="/mrole/index.php/upload/up_inf" method="post" enctype="multipart/form-data" onSubmit="return check()" name="form1">
<table width="200" cellpadding="0" cellspacing="0">
  <tr>
    <td>姓名</td>
    <td><input name="username" type="text" value="<?php echo $username;?>"></td>
  </tr>
  <tr>
    <td>密码</td>
    <td><input name="password" value="<?php echo $password;?>" onBlur="check()"/><div id="div1" style="display:inline"></div></td>
  </tr>
  <tr>
    <td>性别</td>
    <td><input type="radio" name="sex" value='男'  <?php if($sex=='男') echo("checked");?>>男<input type="radio" id="sex" name="sex" value='女'  <?php if($sex=='女') echo("checked");?>>女</td>
  </tr>
  <tr>
    <td>性向</td>
    <td><input type="radio" name="sex_2" value='男'  <?php if($sex_2=='男') echo("checked");?>>男<input type="radio" id="sex" name="sex_2" value='女'  <?php if($sex_2=='女') echo("checked");?>>女</td>
  </tr>
  <tr>
    <td>生日</td>
    <td><input name="birthday" type="text" value="<?php echo $birthday;?>"></td>
  </tr>
  <tr>
    <td>星座</td>
    <td><select name="constellation" onBlur="check()">
       <option selected="selected">请选择您的星座
       <option value="魔羯座">魔羯座 
       <option value="射手座">射手座
       <option value="天蝎座">天蝎座
       <option value="天秤座">天秤座
       <option value="处女座">处女座 
       <option value="狮子座">狮子座
       <option value="巨蟹座">巨蟹座
       <option value="双子座">双子座
       <option value="金牛座">金牛座 
       <option value="双鱼座">双鱼座
       <option value="白羊座">白羊座
       <option value="水瓶座">水瓶座
       </select></td>
  </tr>
  <tr>
    <td>学校</td>
    <td><input name="college" type="text" value="<?php echo $college;?>"></td>
  </tr>
  <tr>
    <td>学院</td>
    <td><input name="major" type="text" value="<?php echo $major;?>"></td>
  </tr>
  <tr>
    <td>班级</td>
    <td><input name="grade" type="text" value="<?php echo $grade;?>"></td>
  </tr>
  <tr>
    <td>职位</td>
    <td><input name="position" type="text" value="<?php echo $position;?>"></td>
  </tr>
  <tr>
    <td>邮箱</div></td>
    <td><input name="e_mail" value="<?php echo $e_mail;?>" onBlur="check()"/><div id="div2" style="display:inline"></div></td>
  </tr>
  <tr>
    <td>手机</td>
    <td><input name="tel" type="text" value="<?php echo $tel;?>"></td>
  </tr>
  <tr>
    <td>密保问题</td>
    <td><select name="question" onBlur="check()">
       <option selected="selected"><?php if($question == ''){echo '请选择密保问题';}else{ echo $question;}?>
       <option value="你父亲的名字">你父亲的名字？ 
       <option value="你母亲的名字">你母亲的名字？
       <option value="你的生日">你的生日？
       </select></td>
  </tr>
  <tr>
    <td>密保问题答案</td>
    <td><input name="answer" type="text" value="<?php echo $answer;?>"></td>
  </tr>
  <tr align="center">
    <td><input value="确定" type="submit" name="submit"></td>
  </tr>
</table>
</form>



<form action="/mrole/index.php/upload/search" method="post" enctype="multipart/form-data">
<input onBlur="this.style.color='#999';
if(this.value=='') this.value='搜索人/信息';"   
onkeyup="if(event.keyCode==13){doSearch();}" onFocus="this.style.color='#000';
if(this.value=='搜索人/信息') this.value='';" value="搜索人/信息"  maxLength=60 size=12 name="S_ID" style="width:200px;height:30px;color:#999">
<input type="submit" name="submit" value="搜索" />
</form>
</body>
</html>
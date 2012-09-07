<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to mrole</title>
</head>
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
<form name="form1" action="/mrole/index.php/welcome/register_update?S_ID=<?PHP echo $S_ID;?>"  method="post" enctype="multipart/form-data" onsubmit="return check()">
		<table width="544" id="tab">
        <tr>
            <td  class="style5" align="center" valign="middle"><div align="center">密码</div></td>
            <td colspan="2" valign="middle"><input name="password"  onblur="check()"/><div id="div1" style="display:inline"></div></td>
        </tr>
        <tr>
            <td  class="style5" align="center" valign="middle"><div align="center">职务</div></td>
            <td colspan="2" valign="middle"><input name="position"  />(如文艺部部长/班长)</td>
         </tr>
         <tr>
            <td  class="style5" align="center" valign="middle"><div align="center">生日</div></td>
            <td colspan="2" valign="middle"><input name="birthday" />(如1991-1-1)</td>
         </tr>
         <tr>
            <td  class="style5" align="center"><div align="center">用户邮箱</div></td>
            <td colspan="4"><input name="e_mail" onblur="check()"/><div id="div2" style="display:inline"></div></td>
         </tr>
        <tr>
            <td  class="style5" align="center"><div align="center">手机</div></td>
            <td colspan="4"><input name="tel"/></td>
         </tr>
         <tr>
            <td colspan="2" valign="middle">
              <input  type="submit" name="submit" value="确定" /> </td>
            <td valign="middle">
              <input  type="reset" name="reset" value="取消" /></td>
        </tr>
        </table>				
</form>
</body>
</html>

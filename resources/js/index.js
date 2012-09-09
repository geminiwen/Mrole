var check_input = function( type, content )
{
	switch( type )
	{
		case 'password':
		{
			if( content.length < 3 || content.length > 15 )
			{
				return "密码长度必须大于3位小于15位";
			}
			break;
		}
		case 'email':
		{
			var e_re = /\w@\w*\.\w/;
			if( ! e_re.test(content) )
			{
				return "请输入正确的Email地址";
			}
			break;
		}
		case 'birthday':
		{
			break;
		}
		default :
		{
			if( content == "" )
			{
				return "不能为空";
			}
		}
	}
	return 'OK';
}

$(document).ready(function()
{
	var height = document.documentElement.clientHeight;
	
	$('#content').css({'height':height});

	$('body').bind('resize', function() {
		height = document.documentElement.clientHeight;
		$('#content').css({'height':height});
	});
	
	$('#content .title').fadeIn(2000,function()
	{
		$('#titleText').fadeIn(2000,function()
		{
			$('#bodyBoxCtn').slideDown('slow');
		});
	});
	
	$('#regBtn').click(function()
	{
		$(this).siblings().removeClass('clickedBtn');
		$('.regBox').siblings().hide();
		if( ! $(this).hasClass('clickedBtn') )
		{
			$('.regBox').css({"margin-left":"0"});
			$('.regBox').fadeIn();
			$(this).addClass('clickedBtn');
		}
		else
		{
			$('.regBox').fadeOut();
			$(this).removeClass('clickedBtn');
		}
	});
	
	$('#loginBtn').click(function()
	{
		$(this).siblings().removeClass('clickedBtn');
		$('.loginBox').siblings().hide();
		if( ! $(this).hasClass('clickedBtn') )
		{
			$('.loginBox').fadeIn();
			$(this).addClass('clickedBtn');
		}
		else
		{
			$('.loginBox').fadeOut();
			$(this).removeClass('clickedBtn');
		}
	});
	
	var index = 0;
	
	var nextBtnClick = function()
	{
		var size	= $('.regBox').find('li').length;
		var prevObj = $('.regBox').find('li').eq( index );
		
		index ++;
		if( index >= size )
		{
			index = 0;
		}
		prevObj.fadeOut(function()
		{
			
			$('.regBox').find('li').eq( index ).fadeIn();
			
		});
		
		
	};
	
	var prevBtnClick = function()
	{
		var size	= $('.regBox').find('li').length;
		var prevObj = $('.regBox').find('li').eq( index );
		index --;
		if( index < 0 )
		{
			index = size - 1;
		}
		prevObj.fadeOut();
		$('.regBox').find('li').eq( index ).fadeIn();
		
	};
	
	var regSubmitBtnClick = function()
	{
		var data =
		{
			'username': $('#reg_username').val(),
			'password': $('#reg_password').val(),
			'realname': $('#reg_realname').val(),
			'email': $('#reg_email').val(),
			'birthday': $('#reg_birthday').val() || '',
			'job': $('#reg_job').val(),
			'captcha': $('#reg_captcha').val()
		}
		
		$.ajax({
			url: 'user/request_register',
			dataType:'json',
			data: data,
			type: 'POST',
			success: function( data )
					{
						var result = data['result'];
						if( result )
						{
							alert('注册成功');
						}
						else
						{
							alert(data['message']);
						}
					},
			error: function(jqXHR, textStatus, errorThrown)
				{
					alert(textStatus);
				}
		});
	};
	
	var loginSubmitBtnClick = function()
	{
		var username = $('#login_username').val();
		var password = $('#login_password').val();
		
	}
	
	
	$('.prevBtn').click(prevBtnClick);
	
	var tip_pro_auto = {
		className: 'tip-green',
		showOn: 'none',
		alignTo: 'target',
		alignX: 'right',
		alignY: 'center',
		timeOnScreen: 2000,
		offsetX: 15,
		allowTipHover: false
	};
	
	$("#reg_job").poshytip(tip_pro_auto).data('datatype','job');
	
	$('#reg_birthday').data('datatype','birthday');
	
	$('#reg_email').poshytip(tip_pro_auto).data('datatype','email');
	
	$('#reg_password').poshytip(tip_pro_auto).data('datatype','password');
	
	$.datepicker.setDefaults( $.datepicker.regional[ "zh-CN" ] );
	
	$('#reg_birthday').datepicker( {
		changeMonth: true,
		changeYear: true,
		constrainInput: true,
		yearRange: "1952:2009"
	});
	
	$('#reg_realname').poshytip({
		className: 'tip-green',
		alignTo: 'target',
		showOn: 'none',
		alignX: 'right',
		alignY: 'center',
		offsetX: 15,
		timeOnScreen: 2000,
		allowTipHover: true,
		content: function(callback)
		{
			var wait_process = $('<img/>').attr('src','resources/img/wait.png');
			return $('<div/>').append( wait_process ).css({ 'width': '34px','height':'31px'});
		}
	});
	
	$('#reg_username').click(function(){
		$('#reg_realname').poshytip('hide');
		$('.nextBtn').unbind('click',nextBtnClick);
	}).blur(function()
	{
		var _thisvalue = $('#reg_username').val();
		if( _thisvalue == '' )
		{
			return ;
		}
		
		$('#reg_realname').poshytip('show');
		
		var ajax_request = {
			url: "user/check_stunum",
			data: {
				"username": _thisvalue
			},
			dataType: "json",
			type: "post",
			success: function(data)
				{
					var result = data['result'];
					if(result)
					{
						$('#reg_realname')
							.poshytip('update','Yes');
						$('#reg_realname').val(data['real_name']);
						$('.nextBtn').click(nextBtnClick);
						$('.nextBtn').css({'cursor':'pointer'});
						$('#img_next_btn_1').attr('src','resources/img/right_arrow.png');
					}
					else
					{
						$('#reg_realname')
							.poshytip('update','您输入的学号在数据库中不存在，不能进行注册，对不起');
						$('#reg_realname').val('查无此人');
						
						$('.nextBtn').css({'cursor':'default'});
						$('#img_next_btn_1')
							.attr('src','resources/img/right_arrow_disabled.png');
					}
				},
			error: function()
				{
					alert('服务器连接失败');
				}
		}
		
		$.ajax(ajax_request);
		
	});
	
	$('.detailInfo').focus(function()
	{
		$(this).poshytip('none');
		$('#reg_submit_btn').unbind('click',regSubmitBtnClick);
	}).blur(function()
	{
		var datatype = $(this).data('datatype');
		var datavalue = $(this).val();
		var check_val = check_input(datatype,datavalue);
		$(this).poshytip('update',check_val);
		$(this).poshytip('show');
		
		var result = 1;
		$('.detailInfo').each(function(index,elem)
			{
				var data_type = $(elem).data('datatype');
				var data_value = $(elem).val();
				var check = check_input(data_type,data_value);
				result &= (check == 'OK');
			});
		if( result == 1 )
		{
			$('#reg_submit_btn').click(regSubmitBtnClick);
			$('#reg_submit_btn').css({'cursor':'pointer'});
			$('#img_next_btn_2')
				.attr('src','resources/img/right_arrow.png');
		}
		else
		{
			$('#reg_submit_btn').unbind('click',regSubmitBtnClick);
			$('#reg_submit_btn').css({'cursor':'default'});
			$('#img_next_btn_2')
				.attr('src','resources/img/right_arrow_disabled.png');
		}
	});
	
	
	$('#captcha').click(function()
	{
		$(this).attr('src','');
		$(this).attr('src','captcha?i='+Math.random());
	});
	
});


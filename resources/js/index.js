var printWords = 
{
	data: ['脉','络',' ','E','a','s','y',',','A','m','a','z','i','n','g',',','C','o','n','v','e','n','i','e','n','t','.'],
	index: 0,
	width: 0,
	height: 0,
	init: function ( width,height,callback )
	{
		var self = this;
		var canvas = document.getElementById('titleText');
		this.canvasContext = canvas.getContext('2d');
		this.canvasContext.font="20px 微软雅黑";
		this.canvasContext.textBaseline  = "top"
		this.canvasContext.fillStyle = "#ffffff"
		this.width = width;
		this.height = height;
		this.timer  = setInterval( function() { self.work( self);}, 50);
		this.callback = callback;
	},
	work:function ( self )
	{
		if( self.index >= self.data.length )
		{
			clearInterval(self.timer);
			if( self.callback )
			{
				self.callback();
			}
		}
		else
		{
			self.canvasContext.fillText(self.data[self.index],self.width,self.height);
			var dim = self.canvasContext.measureText(self.data[self.index]);
			self.width +=  dim.width + 1;
		}
		self.index ++;
	}
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
	
	$('#loginform .inputText').focus(function()
	{
		$(this).val('');
		
		if( $(this).attr('name') == 'password' )
		{
			document.getElementById('login_password').type = 'password';
		}
		
		$(this).css({'text-align':'left','color':'#000'});
		
	});
	
	$('#loginform .inputText').blur(function()
	{
		if( $(this).attr('name') == 'password' )
		{
			if( $(this).val() != '' )
			{
				return;
			}
			document.getElementById('login_password').type = 'text';
			$(this).val('请输入密码');
		}
		else
		{
			if( $(this).val() != '' )
			{
				return;
			}
			$(this).val('请输入学号');
		}
		$(this).css({'text-align':'center','color':'#777777'});
	});
	
	$('#regform .inputText').focus(function()
	{
		$(this).val('');
		if( $(this).attr('name') == 'password' )
		{
			document.getElementById('reg_password').type = 'password';
		}
		$(this).css({'text-align':'left','color':'#000'});
	});
	
	$('#regform .inputText').blur(function()
	{
		if( $(this).val() != '' )
		{
			return;
		}
		$(this).css({'text-align':'center','color':'#777777'});
		if( $(this).attr('name') == 'password' )
		{
			document.getElementById('reg_password').type = 'text';
			$(this).val('请输入密码');
		}
		else
		{
			
			var id = $(this).attr('id');
			switch(id)
			{
			case 'reg_username': $(this).val('请输入学号');break;
			case 'reg_realname': $(this).val('请输入姓名');break;
			case 'reg_email':$(this).val('E-mail');break;
			case 'reg_job':$(this).val('请输入在校职务');break;
			case 'reg_birthday':$(this).val('请选择出生年月日');break;
			case 'reg_captcha':$(this).val('验证码');break;
			}
		}
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
	
	$('.nextBtn').click(function()
	{
		var width = $('.regBox').find('li').width() + 20;
		var size = $('.regBox').find('li').length;
		index ++;
		if( index >= size )
		{
			index = 0;
		}
		width = -1 * index * width;
		$('.regBox').animate({'margin-left':width},{queue:false,duration:500});
		
	});
	
	$('.prevBtn').click(function()
	{
		var width = $('.regBox').find('li').width() + 20;
		var size = $('.regBox').find('li').length;
		index --;
		if( index < 0 )
		{
			index = size - 1;
		}
		width = -1 * index * width;
		$('.regBox').animate({'margin-left':width},{queue:false,duration:500});
		
	});
	
	var tip_pro = {
		className: 'tip-green',
		showOn: 'focus',
		alignTo: 'target',
		alignX: 'right',
		alignY: 'center',
		offsetX: 15,
		allowTipHover: false
	};
	
	$("#reg_job").poshytip(tip_pro);
	
	$('#reg_birthday').poshytip(tip_pro);
	
	$('#reg_email').poshytip(tip_pro);
	
	$.datepicker.setDefaults( $.datepicker.regional[ "zh-CN" ] );
	$('#reg_birthday').datepicker( {
		changeMonth: true,
		changeYear: true,
		constrainInput: true,
		yearRange: "c-40:c-10"
	});
	
});


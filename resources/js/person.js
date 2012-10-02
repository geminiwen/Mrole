// JavaScript Document
(function( window,undefined )
{
	var PersonPage = function ()
	{
		this.init(this);
	};
	
	PersonPage.prototype = {
		startLoadStatus: function ( self )	// 开始加载status数据
				{
					$.ajax({
						url: '/state/state_self_public_time_line',
						type: 'get',
						dataType:'json',
						success: function( data )
							{
								var result = data['result'];
								if( !result )
								{
									alert(data['message']);
									return;
								}
								self.onFinishLoadStatus( self, data['data']);
							}
					});
				},
		onFinishLoadStatus: function( self, data )	//数据加载完成时调用
				{
					
				},
		self: this,
		init: function ( self )  //初始化函数
				{
					$(".statusInfoBox ul li").hover(function()
					{
						$(this).children('ul').slideDown();
					},
					function()
					{
						$(this).children('ul').slideUp();
					});
					
					$('.feedComment').click(function()
					{
						$('.slides').slideUp();
						$(this).parents('.statusWords').next('.slides').slideDown();
					});
					
					$(".media_title ul li").hover(function()
					{
						$(this).children('ul').slideDown();
					},
					function()
					{
						$(this).children('ul').slideUp();
					});
					$('.media_title ul li ul li').click(function()
					{
						
					});
					//self._statusHtml['text'] = $(
					self.startLoadStatus( self );
				}
	};
	

	$(document).ready(function()
	{
		new PersonPage();
	});
	
})(window);

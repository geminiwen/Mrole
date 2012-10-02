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
					for(var i = 0; i < data.length; i++ )
					{
						var domNode = self._statusHtml['text']();
						var emNode	= domNode.find('.statusWords').find('em');
						emNode.text(data[i]['status_content']);
						var realNameNode = domNode.find('.statusWords').find('a');
						realNameNode.text(data[i]['stu_realname']);
						var userIdNode = domNode.find('.userId');
						userIdNode.val(data[i]['status_user']);
						var timeNode = domNode.find('.feedTime');
						timeNode.text(data[i]['status_time']);
						var sourceNode = domNode.find('.feedSource').find('a');
						sourceNode.text('测试设备');
						domNode.appendTo('.statusWrapper');
					}
					
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
					self._statusHtml =
					{
						'text': function() { return $('<dd class="statusContent"><div class="statusInfoBox"><ul><li> \
							<input type="hidden" class="userId" value=""> \
							<img src="resources/img/user/1.jpg" width="60" height="60" class="statusImg"/> \
							<ul><li class="statusFriend" >友</li> \
								<li class="statusFans"   >粉</li> \
							</ul></li></ul></div>	\
							<div class="statusWords"> \
								<p node-type="feed-list-content"> \
									<a title="" href="" usercard=""></a> :	\
									<em ></em> \
								</p> \
								<div class="feedInfo"> \
									<span style="clear:both"> \
										<span class="feedComment">评论</span> \
										<span class="feedShare">分享</span> \
									</span> \
									<span class="feedTime"></span> \
									<span class="feedSource">来自 <a></a></span> \
								</div> \
							</div> \
							<div class="clear"></div> \
							<div class="commentContent slides"></div> \
							</dd>'
						) }
					};
					self.startLoadStatus( self );
				}
	};
	

	$(document).ready(function()
	{
		new PersonPage();
	});
	
})(window);

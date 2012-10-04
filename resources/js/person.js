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
						url: '/state/state_public_time_line',
						type: 'get',
						dataType:'json',
						success: function( data )
							{
								var result = data['result'];
								if( !result )
								{
									window.location="/";
									//alert(data['message']);
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
						var statusIdNode = domNode.find('.statusId');
						statusIdNode.val(data[i]['status_id']);
						var timeNode = domNode.find('.feedTime');
						timeNode.text(data[i]['status_time']);
						var sourceNode = domNode.find('.feedSource').find('a');
						sourceNode.text('测试设备');
						var img		= domNode.find('img');
						if( data[i]['photo_url'] != null )
						{
							img.attr('src',data[i]['photo_url']);
						}
						else
						{
							img.attr('src','/resources/img/user/1.jpg');
						}
						
						var commentNode = domNode.find('.feedComment');
						commentNode.click(function()
								{
									var show = $(this).data('show');
									var myDomNode = $(this).parents('.statusContent');
									var commentContentNode = myDomNode.find(".commentContent");
									commentContentNode.slideToggle("fast",function()
									{
										if( !show )
										{
											self.startLoadComments(self,myDomNode);
										}
										else
										{
											myDomNode.find(".commentContentDl").empty();
										}
									});
									myDomNode.find(".feedCommentBot").toggle();
									
									$(this).data('show',!show);
								});
						var commentSubmitBtn = domNode.find('.replyBtn');
						commentSubmitBtn.click(function()
						{
							var myDomNode = $(this).parents('.statusContent');
							self.startReplyStatusComment(self,myDomNode);
						});
								
								
						commentNode.data('show',false);
						
						domNode.appendTo('.statusWrapper');
						
					}
					/*
					$(".statusInfoBox ul li").hover(function()
					{
						$(this).children('ul').slideDown();
					},
					function()
					{
						$(this).children('ul').slideUp();
					});
					*/
					
				},
		startLoadComments: function ( self, elem )
				{
					var statusIdNode = elem.find('.statusId');
					var status_id = statusIdNode.val();
					$.ajax({
						url:'/state/comment_time_line?comment_status_id='+status_id,
						type: 'get',
						dataType: 'json',
						success: function(data)
								{
									var result = data['result'];
									if( !result )
									{
										alert(data['message']);
									}
									else
									{
										self.finishLoadComments(self,data['data'], elem);
									}
								},
						error:	function()
								{
									alert('服务器发生错误');
								}
					});
				},
		finishLoadComments: function (self, data, elem)
				{
					for(var i = 0; i < data.length; i++ )
					{
						var d = data[i];
						var domNode;
						if(d['is_reply'])
						{
							domNode = self._commentHtml['me']();
						}
						else
						{
							domNode = self._commentHtml['you']();
						}
						var idNode = domNode.find('.commentId');
						idNode.val(d['comment_id']);
						var pNode = domNode.find('p');
						var nameNode = pNode.find('a');
						var contentNode = pNode.find('em');
						nameNode.text(d['stu_realname']);
						nameNode.attr('usercard',d['stu_username']);
						contentNode.text(" : " + d['comment_content'] );
						var imgNode = domNode.find('.photo');
						if(d['photo_url'])
						{
							imgNode.attr('src',d['photo_url']);
						}
						else
						{
							imgNode.attr('src','/resources/img/user/1.jpg');
						}
						var deleteNode = domNode.find('.delete');
						
						deleteNode.click(function()
						{
							var e = $(this).parent();
							var rootElem = elem;
							self.deleteMyComment( self, e, rootElem );
						});
						
						var replyNode  = domNode.find('.reply');
						
						replyNode.click(function()
						{
							var e = $(this).parent();
							var rootElem = elem;
							self.replySomeBody( self, e, rootElem );
						});
						
						domNode.appendTo(elem.find('.commentContentDl'));
					}
				},
		startReplyStatusComment: function ( self, elem )
				{
					var data = {
						'comment_content': elem.find('.commentTextInput').html()
					};
					var url = '/state_comment/status_comment_update?status_id='+elem.find('.statusId').val();
					var comment_id = elem.find('.replyId').val();
					if( comment_id != "" )
					{
						url += "&comment_id="+comment_id;
					}
					
					$.ajax({
						url: url,
						type: "post",
						dataType: "json",
						data: data,
						success: function ( data )
								{
									alert('ok');
								},
						error: function ()
								{
									alert('服务器错误');
								}
					});
					
				},
		deleteMyComment: function ( self, elem, rootElem )
				{
					
				},
		replySomeBody: function ( self, elem, rootElem )
				{
					var commentIdNode = elem.find('.commentId');
					var commentId   = commentIdNode.val();
					var replyIdNode = rootElem.find('.replyId');
					replyIdNode.val(commentId);
					var replyCommentNode = rootElem.find('.commentTextInput');
					var replyTargetNode  = elem.find('a');
					var replyTargetRealName = replyTargetNode.text();
					var replyTargetUserName = replyTargetNode.attr('usercard');
					replyCommentNode.html('回复'+replyTargetRealName+' :');
				},
		self: this,
		init: function ( self )  //初始化函数
				{	
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
					
					$('.commentInput').keyup(function()
					{
						
					});
					
					self._statusHtml =
					{
						'text': function() { return $('<dd class="statusContent"><div class="statusInfoBox"><ul><li> \
							<input type="hidden" class="statusId" value="">\
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
										<span class="feedComment">评论<b class="feedCommentBot">&nbsp;</b></span> \
										<span class="feedShare">分享</span> \
									</span> \
									<span class="feedTime"></span> \
									<span class="feedSource">来自 <a></a></span> \
								</div> \
							</div> \
							<div class="clear"></div> \
							<div class="commentContent"> \
											 <div class="commentInputBox"> \
													<input type="hidden" class="replyId" value="" />\
													<div class="textareaInput commentTextInput" contenteditable="true" ></div> \
													<div> \
														<button style="float:right;margin-bottom: 5px;" class="replyBtn" >回复</button> \
														<div class="clear"></div> \
													</div> \
											 </div> \
											<dl class="commentContentDl" style="margin:0px"></dl> \
							</div> \
							</dd> \
							<hr style="margin:0 10px;"> '
						) }
					};
					
					self._commentHtml = 
					{
						'me': function() {
								return $('<dd class="Clearfix"> \
								<input type="hidden" class="commentId" value=""/> \
							   <img class="PL10 FR statusImg photo" src="" width="50" height="50"  /> \
							   <p class="FR" style="margin:0px">\
										<a title="" href="" usercard=""></a> \
										<em></em> \
							   </p> \
							   <img class="PR10 FR statusImg reply" src="resources/img/commentContQue.gif" width="50" height="50" /> \
							   </dd>');
							},	
						'you': function() {
								return $('<dt class="Clearfix">\
								<input type="hidden" class="commentId" value=""/> \
								<img class="FL PR10 statusImg photo" src="resources/img/user/1.jpg" width="50" height="50"  /> \
									<p class="FL" style="margin:0px">\
										<a title="" href="" usercard=""></a> \
										<em></em> \
									</p> \
								<img class="PL10 statusImg reply" src="resources/img/commentContQue.gif" width="50" height="50"  /> \
								</dt>');
							}
					}
					self.startLoadStatus( self );
				}
	};
	

	$(document).ready(function()
	{
		new PersonPage();
	});
	
})(window);

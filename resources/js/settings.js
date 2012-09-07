// JavaScript Document
$(document).ready(function()
{
	
	$('.navigator li').click(function()
	{
		$(this).siblings().removeClass('nav_on').addClass('nav_off');
		$(this).addClass('nav_on');
	});
	
	$('.nav2 li').click(function()
	{
		$(this).siblings().removeClass('selected');
		$(this).addClass('selected');
		var index = $('.nav2 li').index(this);
		$('.selectedTab').removeClass('selectedTab');
		switch( index )
		{
			case 0:
			{
					$('.importContent').addClass('selectedTab');
					break;
			}
			case 1:
			{
					$('.extendContent').addClass('selectedTab');
					break;
			}
			case 2:
			{
				$('.customContent').addClass('selectedTab');
				break;
			}
		}
	});
	
	$('.keywordsChoice td').click(function()
	{
		var self = $(this);
		var siblings = $(this).siblings();
		$(this).animate({ width: 83 }, function(){
			self.css({'background-color':'#ACDA22'});
		});
		$(this).siblings().animate({ width: 160 },function ()
		{
			siblings.css({'background-color':'inherit'});
		});
		
		var index = $('.keywordsChoice td').index(this);
		var box = $('#keywordBox'+(index+1));
		box.siblings().fadeOut(function()
		{
			box.fadeIn();
		});
		
		
	});
	
});
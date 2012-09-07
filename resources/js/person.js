// JavaScript Document
$(document).ready(function()
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
});
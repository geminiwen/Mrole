<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>个人中心</title>
<link href="/resources/css/person.css" type="text/css" rel="stylesheet" />

<script src="/resources/js/jquery-min.js" type="text/javascript"></script>
<script src="/resources/js/audio.min.js" type="text/javascript"></script>
<script src="/resources/js/person.js" type="text/javascript"></script>
<script type="text/javascript">
  audiojs.events.ready(function() {
	  var audios = document.getElementsByTagName('audio');
	  audiojs.create(audios[0], {
		  css: false,	
		  createPlayer: {
			  markup: false,
			  playPauseClass: 'media_playpause',
			  playedClass:'hidden',
			  scrubberClass: 'hidden',
              progressClass: 'hidden',
           	  loaderClass: 'hidden',
              timeClass: 'hidden',
              durationClass: 'hidden',
              errorMessageClass: 'hidden',
              playingClass: 'playingZ',
              loadingClass: 'hidden',
              errorClass: 'hidden'
		  }
	  });
  });
</script>

</head>

<body>
	<div class="head">
    <div class="headWrapper">
		<div class="logo"></div>
        <div class="nav">
        	<div class="nav_header">
            	<div class="media_player">
        		<audio src="/resources/media/qiuniao.mp3" preload="auto" ></audio>
            	<div class="media_logo"></div>
                <div class="media_title">
                <ul>
                <li>
                囚鸟
                <ul><li>test</li></ul>
                </li>
                </ul>
                </div>
                <div class="media_playpause">
                	<p class="playZ"></p>
                    <p class="pauseZ"></p>
                    <p class="loadingZ"></p>
                    <p class="errorZ"></p>
                	<p class="hidden"></p>
                </div>
                <div class="clear"></div>
                </div>
                <div class="navigator">
                	<ul>
                    <li class="nav_on">脉络</li>
                    <li class="nav_off">脉铺</li>
                    <li class="nav_off">生活</li>
                    <li class="nav_off">校园</li>
                    <li class="nav_off">资源</li>
                    <li class="nav_off">设置</li>
                    <li class="clear"></li>
                    </ul>
                </div>
                <div class="searchBox">
                	
                	<input type="text" id="searchInput" placeholder="搜索人/信息" name="search" x-webkit-speech lang="zh-CN"/>
                    <div class="searchBtn">&nbsp;</div>				
                </div>
                <div class="clear"></div>
            </div>
            <div class="nav2">
            	<div class="selected">中国计量学院</div>
            </div>
        </div>
    </div>
    </div>
    <div class="statusBody">
    	<div class="leftBar">
        	<div>主页</div>
            <div>发布</div>
            <div>动态</div>
            <div>榜单</div>
            <div>联系</div>
            <div>活动</div>
        </div>
        <dl class="statusWrapper">
        	
        	<dd class="statusContent">
            	<div class="statusInfoBox">
                    <ul>
                    	<li>
                    	<img src="/resources/img/user/1.jpg" width="60" height="60" class="statusImg"/>
                        <ul>
                        	<li class="statusFriend" >友</li>
                            <li class="statusFans"   >粉</li>
                        </ul>
                    	</li>
                    </ul>
                </div>
                <div class="statusWords">
                	<p node-type="feed-list-content">
                    	<a nick-name="阿温" title="阿温" href="http://www.baidu.com" usercard="id=123456"> 阿温 </a> :	
                		<em >测试下em标签4444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444
                   		</em>
                    </p>
                    <div class="feedInfo">
                    <span style="clear:both">
                    	<span class="feedComment">评论</span>
                        <span class="feedShare">分享</span>
                    </span>
                    <span class="feedTime">
                     2012年9月1日 00:00:00
                    </span>
                    <span class="feedSource">来自 <a>测试设备</a></span>
                    
                   
                    </div>
                </div>
                <div class="clear"></div>
                <div class="commentContent slides">
                    	test
                </div>
            </dd>
            
            
        </dl>
        <div class="clear"></div>
    </div>
</body>
</html>

<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="{{ config('app.title') }}"/>
	<!-- Document Title -->
	<title>{{ $title }}</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="apple-touch-icon" href="{{ $pub_url }}/png/apple-touch-icon.png" />
	<link href="{{ $pub_url }}/png/apple-touch-startup-image-320x460.png" media="(device-width: 320px)" rel="apple-touch-startup-image">
	<link href="{{ $pub_url }}/png/apple-touch-startup-image-640x920.png" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
	<title>LITHIUM - mobile template</title>
	<link rel="stylesheet" href="{{ $pub_url }}/css/framework7.css">
	<link rel="stylesheet" href="{{ $pub_url }}/css/style.css">
	<link type="text/css" rel="stylesheet" href="{{ $pub_url }}/css/swipebox.css" />
	<link type="text/css" rel="stylesheet" href="{{ $pub_url }}/css/animations.css" />
    <link rel="stylesheet" href="{{ asset('/global/css/social-buttons.css') }}"/>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,900' rel='stylesheet' type='text/css'>
    <style>
    .link-more {
        text-align: center;
        margin: 5px;
        color: #5c81ff;
        font-weight: bold;
        }
        .swiper-wrapper img {
            width: 100%;
        }
        .nowrap {
            white-space: nowrap;
        }
        h3.title{
            margin-bottom: -15px;
        }
        .showMap{
            width: 100%;
            height: 300px;
        }
        .box-gray{
            background: #eee;
            padding: 5px!important;
            padding-bottom: 1px!important;
            margin: 5px 0 20px!important;
            color: #f20612;
        }
        .help-block {
            font-size: 10px;
            color: #b9b9b9;
        }
        .main-nav ul li img {
            display: inline-block!important;
            max-width: 20%!important;
        }
    </style>
	@stack('styles')
</head>
<body id="mobile_wrap">

    <div class="statusbar-overlay"></div>

    <div class="panel-overlay"></div>

    <div class="panel panel-left panel-reveal">
			<nav class="sidebar-nav">
			<ul>
			<li><a href="index-2.html" class="close-panel"><img src="{{ $pub_url }}/png/home.png" alt="" title="" /><span>Home</span></a></li>
			<li><a href="about.html" class="close-panel"><img src="{{ $pub_url }}/png/mobile.png" alt="" title="" /><span>About</span></a></li>
			<li><a href="features.html" class="close-panel"><img src="{{ $pub_url }}/png/features.png" alt="" title="" /><span>Features</span></a></li>
			<li><a href="#" data-popup=".popup-login" class="open-popup close-panel"><img src="{{ $pub_url }}/png/lock.png" alt="" title="" /><span>Login</span></a></li>
			<li><a href="team.html" class="close-panel"><img src="{{ $pub_url }}/png/users.png" alt="" title="" /><span>Team</span></a></li>
			<li><a href="blog.html" class="close-panel"><img src="{{ $pub_url }}/png/blog.png" alt="" title="" /><span>Blog</span></a></li>		
			<li><a href="photos.html" class="close-panel"><img src="{{ $pub_url }}/png/photos.png" alt="" title="" /><span>Photos</span></a></li>
			<li><a href="videos.html" class="close-panel"><img src="{{ $pub_url }}/png/video.png" alt="" title="" /><span>Videos</span></a></li>
			<li><a href="music.html" class="close-panel"><img src="{{ $pub_url }}/png/music.png" alt="" title="" /><span>Music</span></a></li>
			<li><a href="shop.html" class="close-panel"><img src="{{ $pub_url }}/png/shop.png" alt="" title="" /><span>Shop</span></a></li>
			<li><a href="cart.html" class="close-panel"><img src="{{ $pub_url }}/png/cart.png" alt="" title="" /><span>Cart</span></a></li>
			<li><a href="tables.html" class="close-panel"><img src="{{ $pub_url }}/png/tables.png" alt="" title="" /><span>Tables</span></a></li>
			<li><a href="toggle.html" class="close-panel"><img src="{{ $pub_url }}/png/toggle.png" alt="" title="" /><span>Toggle</span></a></li>
			<li><a href="tabs.html" class="close-panel"><img src="{{ $pub_url }}/png/tabs.png" alt="" title="" /><span>Tabs</span></a></li>
			<li><a href="form.html" class="close-panel"><img src="{{ $pub_url }}/png/form.png" alt="" title="" /><span>Forms</span></a></li>
			<li><a href="contact.html" class="close-panel"><img src="{{ $pub_url }}/png/contact.png" alt="" title="" /><span>Contact</span></a></li>
			</ul>
			</nav>
    </div>

    <div class="panel panel-right panel-reveal">
      <div class="user_login_info">
		<nav class="user-nav">
            <ul>
			    <li><a href="#" data-popup=".popup-login" class="open-popup close-panel"><img src="{{ $pub_url }}/png/lock.png" alt="" title=""><span>Login</span></a></li>
            </ul>
		</nav>
        
      </div>
    </div>

    <div class="views">

      <div class="view view-main">

	  	{!! $notif !!} 
          
		@yield('content')

        <!-- Bottom Toolbar-->
        <div class="toolbar">
              <div class="toolbar-inner">
              <ul class="toolbar_icons">
              <li><a href="#" data-panel="right" class="open-panel"><img src="{{ $pub_url }}/png/user.png" alt="" title="" /></a></li>
              <li><a href="#" data-popup=".popup-social" class="open-popup"><img src="{{ $pub_url }}/png/love-2.png" alt="" title="" /></a></li>
              <li class="menuicon"><a href="/" id="toolbarHome"><img src="{{ $pub_url }}/png/home.png" alt="" title="" /></a></li>
              <li><a href="#" data-popup=".popup-social" class="open-popup"><img src="{{ $pub_url }}/png/twitter.png" alt="" title="" /></a></li>
              <li><a href="tel:123456789" class="external"><img src="{{ $pub_url }}/png/phone.png" alt="" title="" /></a></li>
              </ul>
              </div>  
        </div>

      </div>
    </div>
	
    <!-- Social Icons Popup -->
    <div class="popup popup-social">
		<div class="content-block">
		<h4>Social Share</h4>
		<p>Share icons solution that allows you share and increase your social popularity.</p>
		<ul class="social_share">
		<li><a href="http://twitter.com/" id="url-share-twitter" class="external" target="_blank"><img src="{{ $pub_url }}/png/twitter-2.png" alt="" title="" /><span>TWITTER</span></a></li>
		<li><a href="http://www.facebook.com/" id="url-share-facebook"  class="external" target="_blank"><img src="{{ $pub_url }}/png/facebook.png" alt="" title="" /><span>FACEBOOK</span></a></li>
		<li><a href="http://plus.google.com/" id="url-share-google"  class="external" target="_blank"><img src="{{ $pub_url }}/png/gplus.png" alt="" title="" /><span>GOOGLE</span></a></li>
		<li><a href="http://www.dribbble.com/" id="url-share-twitter"  class="external" target="_blank"><img src="{{ $pub_url }}/png/dribbble.png" alt="" title="" /><span>DRIBBBLE</span></a></li>
		<li><a href="http://www.linkedin.com/" id="url-share-twitter"  class="external" target="_blank"><img src="{{ $pub_url }}/png/linkedin.png" alt="" title="" /><span>LINKEDIN</span></a></li>
		<li><a href="http://www.pinterest.com/" id="url-share-twitter"  class="external" target="_blank"><img src="{{ $pub_url }}/png/pinterest.png" alt="" title="" /><span>PINTEREST</span></a></li>
		</ul>
		<div class="close_popup_button"><a href="#" class="close-popup"><img src="{{ $pub_url }}/png/menu_close.png" alt="" title="" /></a></div>
		</div>
    </div>

    <!-- LOGIN -->
    <div class="popup popup-login">
        <div class="content-block">
            <h4>LOGIN</h4>
            <div class="text-center" id="form-login" data-store="{{ url('membership/save') }}">
                <h6>Silakan login untuk meanjutkan</h6>
                <a href="#" id="btn-login-google">&nbsp;</a>
                <a href="#" id="btn-login-facebook">&nbsp;</a>
                <a href="#" id="btn-login-twitter">&nbsp;</a>
            </div>
            <div class="close_popup_button">
                <a href="#" class="close-popup"><img src="{{ $pub_url }}/png/menu_close.png" alt="" title=""></a>
            </div>
        </div>
    </div>

    <!-- MEJA -->
    <div class="popup popup-meja">
        <div class="content-block">
            <h4>PILIH MEJA</h4>
            <div class="size_selectors text-center">   
                @for( $i=1;$i<=24; $i++ )             
                <input id="meja-{{$i}}" name="meja" value="meja-{{$i}}" type="radio">  
                <label for="meja-{{$i}}" style="margin: 5px; padding: 30px 18px;">Meja {{$i}}</label>
                @endfor
            </div>
            <div class="close_popup_button">
                <a href="#" class="close-popup"><img src="{{ $pub_url }}/png/menu_close.png" alt="" title=""></a>
            </div>
        </div>
    </div>

    

<script type="text/javascript" src="{{ $pub_url }}/js/jQuery-2.1.4.min.js"></script>
<script type="text/javascript" src="{{ $pub_url }}/js/cookie.js"></script>

<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key={{ config('app.map.key') }}&language=id"></script>
<script src="https://www.gstatic.com/firebasejs/4.0.0/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyD_G_ZNknZvIsJHnh3SZjYRQaYhYA6_nu0",
    authDomain: "kemanagitu-6f3aa.firebaseapp.com",
    databaseURL: "https://kemanagitu-6f3aa.firebaseio.com",
    projectId: "kemanagitu-6f3aa",
    storageBucket: "kemanagitu-6f3aa.appspot.com",
    messagingSenderId: "372322146671"
  };
  firebase.initializeApp(config);
</script>

<script type="text/javascript" src="{{ $pub_url }}/js/jquery.validate.min.js" ></script>
<script type="text/javascript" src="{{ $pub_url }}/js/framework7.js"></script>
<script type="text/javascript" src="{{ $pub_url }}/js/jquery.swipebox.js"></script>
<script type="text/javascript" src="{{ $pub_url }}/js/jquery.fitvids.js"></script>
<script type="text/javascript" src="{{ $pub_url }}/js/email.js"></script>
<script type="text/javascript" src="{{ $pub_url }}/js/audio.min.js"></script>
<script type="text/javascript" src="{{ $pub_url }}/js/readmore.min.js"></script>
<script type="text/javascript" src="{{ $pub_url }}/js/my-app.js"></script>

<script>
if(window.location.href.indexOf('#!')<=0)
{
    window.location.href = "{{FeUrl("current")}}";
}
</script>

<!-- Java Script -->		
@stack('scripts')
</body>

</html>
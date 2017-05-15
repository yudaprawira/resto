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
	  
		<div class="user_thumb">
		<img src="{{ $pub_url }}/jpg/page_photo2.jpg" alt="" title="" />
			<div class="user_details">
			<p>Welcome, <span>Alexia Doe</span></p>
			</div>  
			<div class="user_avatar"><img src="{{ $pub_url }}/jpg/avatar3.jpg" alt="" title="" /></div>       
		</div>
		
		<nav class="user-nav">
			<ul>
				<li><a href="features.html" class="close-panel"><img src="{{ $pub_url }}/png/settings.png" alt="" title="" /><span>Account Settings</span></a></li>
				<li><a href="features.html" class="close-panel"><img src="{{ $pub_url }}/png/briefcase.png" alt="" title="" /><span>My Account</span></a></li>
				<li><a href="features.html" class="close-panel"><img src="{{ $pub_url }}/png/message.png" alt="" title="" /><span>Messages</span><strong>12</strong></a></li>
				<li><a href="features.html" class="close-panel"><img src="{{ $pub_url }}/png/love.png" alt="" title="" /><span>Favorites</span><strong>5</strong></a></li>
				<li><a href="index-2.html" class="close-panel"><img src="{{ $pub_url }}/png/lock.png" alt="" title="" /><span>Logout</span></a></li>
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
              <li class="menuicon"><a href="contact.html"><img src="{{ $pub_url }}/png/contact.png" alt="" title="" /></a></li>
              <li><a href="#" data-popup=".popup-social" class="open-popup"><img src="{{ $pub_url }}/png/twitter.png" alt="" title="" /></a></li>
              <li><a href="tel:123456789" class="external"><img src="{{ $pub_url }}/png/phone.png" alt="" title="" /></a></li>
              </ul>
              </div>  
        </div>

      </div>
    </div>

	
    <!-- Login Popup -->
    <div class="popup popup-login">
        <div class="content-block">
            <h4>LOGIN</h4>
            <div class="loginform">
                <form id="LoginForm" method="post">
                    <input type="text" name="Username" value="" class="form_input required" placeholder="username" />
                    <input type="password" name="Password" value="" class="form_input required" placeholder="password" />
                    <div class="forgot_pass"><a href="#" data-popup=".popup-forgot" class="open-popup">Forgot Password?</a></div>
                    <input type="submit" name="submit" class="form_submit" id="submit" value="SIGN IN" />
                </form>
                <div class="signup_bottom">
                    <p>Don't have an account?</p>
                    <a href="#" data-popup=".popup-signup" class="open-popup">SIGN UP</a>
                </div>
            </div>
            <div class="close_popup_button">
                <a href="#" class="close-popup"><img src="{{ $pub_url }}/png/menu_close.png" alt="" title="" /></a>
            </div>
        </div>
    </div>

    <!-- Register Popup -->
    <div class="popup popup-signup">
        <div class="content-block">
            <h4>REGISTER</h4>
            <div class="loginform">
                <form id="RegisterForm" method="post">
                    <input type="text" name="Username" value="" class="form_input required" placeholder="Username" />
                    <input type="text" name="Email" value="" class="form_input required" placeholder="Email" />
                    <input type="password" name="Password" value="" class="form_input required" placeholder="Password" />
                    <input type="submit" name="submit" class="form_submit" id="submit" value="SIGN UP" />
                </form>
		<h5>- OR REGISTER WITH A SOCIAL ACCOUNT -</h5>
		<div class="signup_social">
			<a href="http://www.facebook.com/" class="signup_facebook external">FACEBOOK</a>
			<a href="http://www.twitter.com/" class="signup_twitter external">TWITTER</a>            
		</div>		
            </div>
            <div class="close_popup_button">
                <a href="#" class="close-popup"><img src="{{ $pub_url }}/png/menu_close.png" alt="" title="" /></a>
            </div>
        </div>
    </div>
	
    <!-- Forgot Password Popup -->
    <div class="popup popup-forgot">
        <div class="content-block">
            <h4>FORGOT PASSWORD</h4>
            <div class="loginform">
                <form id="ForgotForm" method="post">
                    <input type="text" name="Email" value="" class="form_input required" placeholder="email" />
                    <input type="submit" name="submit" class="form_submit" id="submit" value="RESEND PASSWORD" />
                </form>
                <div class="signup_bottom">
                    <p>Check your email and follow the instructions to reset your password.</p>
                </div>
            </div>
            <div class="close_popup_button">
                <a href="#" class="close-popup"><img src="{{ $pub_url }}/png/menu_close.png" alt="" title="" /></a>
            </div>
        </div>
    </div>
	
    <!-- Social Icons Popup -->
    <div class="popup popup-social">
		<div class="content-block">
		<h4>Social Share</h4>
		<p>Share icons solution that allows you share and increase your social popularity.</p>
		<ul class="social_share">
		<li><a href="http://twitter.com/" class="external"><img src="{{ $pub_url }}/png/twitter-2.png" alt="" title="" /><span>TWITTER</span></a></li>
		<li><a href="http://www.facebook.com/" class="external"><img src="{{ $pub_url }}/png/facebook.png" alt="" title="" /><span>FACEBOOK</span></a></li>
		<li><a href="http://plus.google.com/" class="external"><img src="{{ $pub_url }}/png/gplus.png" alt="" title="" /><span>GOOGLE</span></a></li>
		<li><a href="http://www.dribbble.com/" class="external"><img src="{{ $pub_url }}/png/dribbble.png" alt="" title="" /><span>DRIBBBLE</span></a></li>
		<li><a href="http://www.linkedin.com/" class="external"><img src="{{ $pub_url }}/png/linkedin.png" alt="" title="" /><span>LINKEDIN</span></a></li>
		<li><a href="http://www.pinterest.com/" class="external"><img src="{{ $pub_url }}/png/pinterest.png" alt="" title="" /><span>PINTEREST</span></a></li>
		</ul>
		<div class="close_popup_button"><a href="#" class="close-popup"><img src="{{ $pub_url }}/png/menu_close.png" alt="" title="" /></a></div>
		</div>
    </div>
    
<script type="text/javascript" src="{{ $pub_url }}/js/jQuery-2.1.4.min.js"></script>
<script type="text/javascript" src="//maps.google.com/maps?file=api&amp;v=2&amp;key={{ config('app.map.key') }}"></script>
<script type="text/javascript" src="{{ $pub_url }}/js/jquery.validate.min.js" ></script>
<script type="text/javascript" src="{{ $pub_url }}/js/framework7.js"></script>
<script type="text/javascript" src="{{ $pub_url }}/js/jquery.swipebox.js"></script>
<script type="text/javascript" src="{{ $pub_url }}/js/jquery.fitvids.js"></script>
<script type="text/javascript" src="{{ $pub_url }}/js/email.js"></script>
<script type="text/javascript" src="{{ $pub_url }}/js/audio.min.js"></script>
<script type="text/javascript" src="{{ $pub_url }}/js/readmore.min.js"></script>
<script type="text/javascript" src="{{ $pub_url }}/js/my-app.js"></script>


<!-- Java Script -->		
@stack('scripts')
</body>

</html>
@extends( config('app.template') . 'layouts.master')

@section('content')
        <div class="pages">

          <div data-page="index" class="page homepage">
            <div class="page-content homepagecontent">	

                        <div class="homenavbar">
                                <h1>Lithiu<span>m.</span></h1>								
                        </div>
			
			<nav class="main-nav">
			<ul>
			<li class="navbg1"><a href="index-2.html" class="navbgtransblue"><img src="{{ $pub_url }}/png/home-2.png" alt="" title="" /><span>Home</span></a></li>
			<li class="navbg2"><a href="about.html" class="navbgtransblack"><img src="{{ $pub_url }}/png/mobile-2.png" alt="" title="" /><span>About</span></a></li>
			
			<li class="navbg3"><a href="features.html" class="navbgtransblack"><img src="{{ $pub_url }}/png/features-2.png" alt="" title="" /><span>Features</span></a></li>
			<li class="navbg4"><a href="blog.html" class="navbgtransgreen"><img src="{{ $pub_url }}/png/blog-2.png" alt="" title="" /><span>Latest News</span></a></li>	
			
			<li class="navbg5"><a href="photos.html" class="navbgtransred"><img src="{{ $pub_url }}/png/photos-2.png" alt="" title="" /><span>Photo Gallery</span></a></li>
			<li class="navbg6"><a href="videos.html" class="navbgtransblack"><img src="{{ $pub_url }}/png/video-2.png" alt="" title="" /><span>Videos</span></a></li>
			

			<li class="navbg7"><a href="shop.html" class="navbgtransblack"><img src="{{ $pub_url }}/png/shop-2.png" alt="" title="" /><span>Shop Online</span></a></li>
			<li class="navbg8"><a href="cart.html" class="navbgtransyellow"><img src="{{ $pub_url }}/png/cart-2.png" alt="" title="" /><span>Cart</span></a></li>
			
			<li class="navbg9"><a href="#" data-popup=".popup-login" class="open-popup navbgtransviolet"><img src="{{ $pub_url }}/png/lock-2.png" alt="" title="" /><span>Login</span></a></li>
			<li class="navbg10"><a href="#" data-panel="right" class="open-panel navbgtransblack"><img src="{{ $pub_url }}/png/users-2.png" alt="" title="" /><span>Account</span></a></li>
			</ul>
			</nav>	    
            </div>
          </div>
        </div>
@endsection

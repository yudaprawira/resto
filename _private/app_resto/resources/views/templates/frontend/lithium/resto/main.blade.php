@extends( config('app.template') . 'layouts.master')

@section('content')

<div class="pages">
  <div data-page="about" class="page pagename" style="background-image:url({{ $pub_url }}/jpg/bg-kuliner.jpeg);">
    <div class="page-content pagecontent">
    
	<div class="navbarpages">
		<div class="navbar_left">
			<div class="logo_text"><a href="{{ 'kuliner/'.val($row, 'url') }}">KULINE<span>R</span></a></div>
		</div>			
		<a href="#" data-panel="left" class="open-panel">
			<div class="navbar_right"><img src="{{ $pub_url }}/png/menu.png" alt="" title="" /></div>
		</a>
		<a href="#" data-panel="right" class="open-panel">
        <div class="navbar_right whitebg"><img src="{{ $pub_url }}/png/{{ session::has('ses_feuserid') ? 'user_online' : 'user' }}.png" class="icon-user" src-online="{{ $pub_url }}/png/user_online.png" src-offline="{{ $pub_url }}/png/user.png"alt="" title="" /></div>
    </a>					
    <a href="#" data-panel="right" data-popup=".popup-pelayan" class="open-popup close-panel">
        <div class="navbar_right whitebg"><img src="{{ $pub_url }}/png/pelayan.png" class="icon-pelayan" src-online="{{ $pub_url }}/png/pelayan_online.png" src-offline="{{ $pub_url }}/png/pelayan.png" alt="" title="" /></div>
    </a>					
	</div>
						
     <div id="pages_maincontent">
      <div id="dataMember" data-memberid="{{ session::get('ses_feuserid') }}" data-state="{{ val($row, 'url') }}"></div>
      
          <h2 class="page_title" style="color: #fff;">{{ val($row, 'nama') }}</h2>
			  
              <!-- Slider -->
              <div class="swiper-container-pages swiper-init" data-effect="slide" data-pagination=".swiper-pagination">
                <div class="swiper-wrapper">
                
                    <div class="swiper-slide">
                    <img src="{{ imgUrl(val($row, 'foto_utama')) }}" alt="" title="" />
                    </div>
                    @if(val($row, 'foto'))
                    @foreach( json_decode(val($row, 'foto'), true) as $f )
                    <div class="swiper-slide">
                    <img src="{{ imgUrl($f) }}" alt="" title="" />
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="swiper-pagination"></div>
              </div>		  

              <nav class="main-nav">
									<ul>
                    <li class="navbg10" style="background-image:url({{ $pub_url }}/jpg/lokasi.jpeg);"><a href="{{ 'kuliner/'.val($row, 'url').'/about' }}" class="navbgtransblack"><img src="{{ $pub_url }}/png/info.png" alt="" title="" /><span>INFO</span></a></li>
                    <li class="navbg10" style="background-image:url({{ $pub_url }}/jpg/scan.jpeg);"><a href="{{ 'kuliner/'.val($row, 'url').'/scan' }}" class="navbgtransblack"><img src="{{ $pub_url }}/png/icon-qrcode.png" alt="" title="" /><span>SCAN QRCODE</span></a></li>
                    <li class="navbg10" style="background-image:url({{ $pub_url }}/jpg/bg-kuliner.jpeg);"><a href="{{ 'kuliner/'.val($row, 'url').'/menu' }}" class="navbgtransblack"><img src="{{ $pub_url }}/png/icon-kuliner.png" alt="" title="" /><span>DAFTAR MENU</span></a></li>
                    <li class="navbg10" style="background-image:url({{ $pub_url }}/jpg/menu.png);"><a href="{{ 'kuliner/'.val($row, 'url').'/pesanan' }}" class="navbgtransblack"><img src="{{ $pub_url }}/png/daftar-pesanan.png" alt="" title="" /><span>DAFTAR PESANAN</span></a></li>
									</ul>
							</nav>
			            
         </div>
      </div>
      
      
    </div>
  </div>
</div>
@endsection
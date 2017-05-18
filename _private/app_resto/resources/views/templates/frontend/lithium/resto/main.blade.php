@extends( config('app.template') . 'layouts.master')

@section('content')

<div class="pages">
  <div data-page="about" class="page pagename">
    <div class="page-content pagecontent">
    
	<div class="navbarpages">
		<div class="navbar_left">
			<div class="logo_text"><a href="{{ 'kuliner/'.val($row, 'url') }}">KULINE<span>R</span></a></div>
		</div>			
		<a href="#" data-panel="left" class="open-panel">
			<div class="navbar_right"><img src="{{ $pub_url }}/png/menu.png" alt="" title="" /></div>
		</a>
		<a href="#" data-panel="right" class="open-panel">
			<div class="navbar_right whitebg"><img src="{{ $pub_url }}/png/user.png" alt="" title="" /></div>
		</a>					
	</div>
						
     <div id="pages_maincontent">
      
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
                    <li class="navbg10"><a href="{{ 'kuliner/'.val($row, 'url').'/about' }}" class="{{getClassBgTrans()}}"><img src="{{ $pub_url }}/png/info.png" alt="" title="" /><span>INFO</span></a></li>
									</ul>
							</nav>
			            
         </div>
      
      </div>
      
      
    </div>
  </div>
</div>
@endsection
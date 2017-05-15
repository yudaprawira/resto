@extends( config('app.template') . 'layouts.master')

@section('content')

<div class="pages">
  <div data-page="about" class="page no-toolbar no-navbar">
    <div class="page-content">
    
	<div class="navbarpages">
		<div class="navbar_left">
			<div class="logo_text"><a href="index-2.html">ERR<span>OR</span></a></div>
		</div>			
		<a href="#" data-panel="left" class="open-panel">
			<div class="navbar_right"><img src="{{ $pub_url }}/png/menu.png" alt="" title="" /></div>
		</a>
		<a href="#" data-panel="right" class="open-panel">
			<div class="navbar_right whitebg"><img src="{{ $pub_url }}/png/user.png" alt="" title="" /></div>
		</a>					
	</div>
						
     <div id="pages_maincontent">
          <h2 class="page_title">404 Not Found</h2>
	        <div class="page_single layout_fullwidth_padding">	
              <blockquote>
              HALAMAN TIDAK DITEMUKAN
              </blockquote>
            </div>
      </div>
      
      
    </div>
  </div>
</div>
@endsection
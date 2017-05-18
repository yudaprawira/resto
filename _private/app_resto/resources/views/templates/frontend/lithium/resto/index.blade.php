@extends( config('app.template') . 'layouts.master')

@section('content')

<div class="pages">
  <div data-page="about" class="page no-toolbar no-navbar pagename" style="background-image:url({{ $pub_url }}/jpg/bg-kuliner.jpeg);">
    <div class="page-content pagecontent">
    
	<div class="navbarpages">
		<div class="navbar_left">
			<div class="logo_text"><a href="kuliner">KULINE<span>R</span></a></div>
		</div>			
		<a href="#" data-panel="left" class="open-panel">
			<div class="navbar_right"><img src="{{ $pub_url }}/png/menu.png" alt="" title="" /></div>
		</a>
		<a href="#" data-panel="right" class="open-panel">
			<div class="navbar_right whitebg"><img src="{{ $pub_url }}/png/user.png" alt="" title="" /></div>
		</a>					
	</div>
						
     <div id="pages_maincontent">
      
        <div>
            @if ( $rows )
								<nav class="main-nav">
									<ul>
									@foreach($rows as $r)
											<li style="background-image:url({{ imgUrl(val($r,'foto_utama')) }});"><a href="{{ 'kuliner/'.val($r, 'url') }}" class="{{getClassBgTrans()}}"><span>{{ val($r, 'nama') }}</span></a></li>
									@endforeach
									</ul>
							</nav>
						@endif
        </div>
				<div class="center">{!! $rows->appends(Input::except('page'))->render() !!}</div>
      </div>
      
      
    </div>
  </div>
</div>
@endsection
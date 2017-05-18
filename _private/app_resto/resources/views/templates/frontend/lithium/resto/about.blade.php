@extends( config('app.template') . 'layouts.master')

@section('content')

<div class="pages">
  <div data-page="about" class="page no-toolbar no-navbar">
    <div class="page-content">
    
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
      
          <h2 class="page_title">{{ val($row, 'nama') }}</h2>
			  
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
			  
	              <div class="page_single layout_fullwidth_padding">	
	                <div class="description">{!! val($row, 'deskripsi') !!}</div>

                  <ul class="simple_list box-gray">
                    @foreach( json_decode(val($row, 'type')) as $c)
                      <li>{{ trans('restoran::global.'.$c) }}  &nbsp; <span class="help-block inline">{{ trans('restoran::global.'.$c.'helper') }}</span></li>
                    @endforeach
                  </ul>
                  
                  <div class="row">
                    <div class="col-auto">
                      <h3 class="title">Kategori</h3>  
                      <ul class="simple_list">
                        @foreach( json_decode(val($row, 'kategori')) as $c)
                          <li>{{trans('restoran::global.kategori_menu.'.$c)}}</li>
                        @endforeach
                      </ul>
                    </div>

                    <div class="col-auto">
                      <h3 class="title">Fasilitas</h3>  
                      <ul class="simple_list">
                        @foreach( explode(',', val($row, 'fasilitas')) as $f)
                          <li>{{$f}}</li>
                        @endforeach
                      </ul>
                    </div>
                  </div>

                  <h3 class="title">Jam Operasional</h3>  
                  <ul class="features_list_detailed">
                    @foreach( json_decode(val($row, 'jam_operasional'), true) as $kJ=>$cJ)
                      <li>
                          <div class="row">
                            <div class="col-50">{{$kJ}}</div>
                            @if ( val($cJ,'buka') )
                            <div class="col-50 nowrap">{{val($cJ,'mulai')}} - {{val($cJ,'tutup')}}</div>
                            @else
                            <div class="col-50 nowrap">LIBUR</div>
                            @endif
                          </div>
                      </li>
                    @endforeach
                  </ul>

                  <h3 class="title">Kontak</h3>  
                  <ul class="features_list_detailed">
                    @if( val($row, 'kontak_telepon') ) <li><i class="fa fa-phone"></i>{!! val($row, 'kontak_telepon') !!}</li> @endif
                    @if( val($row, 'kontak_wa') ) <li><i class="fa fa-whtasapp"></i>{!! val($row, 'kontak_wa') !!}</li> @endif
                    @if( val($row, 'kontak_bbm') ) <li><i class="fa fa-bbm"></i>{!! val($row, 'kontak_bbm') !!}</li> @endif
                    @if( val($row, 'kontak_facebook') ) <li><i class="fa fa-facebook"></i>{!! val($row, 'kontak_facebook') !!}</li> @endif
                    @if( val($row, 'kontak_twitter') ) <li><i class="fa fa-twitter"></i>{!! val($row, 'kontak_twitter') !!}</li> @endif
                    @if( val($row, 'kontak_instagram') ) <li><i class="fa fa-instagram"></i>{!! val($row, 'kontak_instagram') !!}</li> @endif
                  </ul>

                  <h3 class="title">Lokasi</h3>
                  <address>{{ val($row, 'alamat') }}, <span class="nowrap">Kode pos : {{ val($row, 'kodepos') }}</span>, {{ val($row, 'kecamatan') }}, {{ val($row, 'kota') }}, {{ val($row, 'provinsi') }}</address>
                  <div class="showMap" id="map-{{ val($row, 'url') }}" data-info="{{ val($row, 'nama') }}" data-lat="{{ val($row, 'lokasi_lat') }}" data-lng="{{ val($row, 'lokasi_lng') }}"></div>

                  
         </div>
      
      </div>
      
      
    </div>
  </div>
</div>
@endsection
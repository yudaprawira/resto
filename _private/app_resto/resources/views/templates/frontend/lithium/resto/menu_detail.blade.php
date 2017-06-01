@extends( config('app.template') . 'layouts.master')

@section('content')

<div class="pages">
  <div data-page="shop" class="page no-navbar">
    <div class="page-content">
    
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
      
          <h2 class="page_title">{{ val($row, 'nama') }} | Daftar Menu</h2>
			  
              <!-- Slider -->
              <div class="swiper-container-pages swiper-init" data-effect="slide" data-pagination=".swiper-pagination">
                <div class="swiper-wrapper">
                
                    <div class="swiper-slide">
                    <img src="{{ imgUrl(val($rowMenu, 'foto_utama')) }}" alt="" title="" />
                    </div>
                    @if(val($rowMenu, 'foto'))
                    @foreach( json_decode(val($rowMenu, 'foto'), true) as $f )
                    <div class="swiper-slide">
                    <img src="{{ imgUrl($f) }}" alt="" title="" />
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="swiper-pagination"></div>
              </div>		  
    
            <div class="page_single layout_fullwidth_padding">
              <h2>{{ val($rowMenu, 'nama') }}</h2>
              <a href="{{ urlMenu($row, $rowMenu, 'share') }}" title="{{ val($rowMenu, 'nama') }}" data-popup=".popup-social" class="open-popup shopfav" style="width: 30px;height: 30px;display: inline-block;float: right;"><img src="{{ $pub_url }}/png/love-3.png" alt="" title=""></a>
              <table class="tableInfo">
                <tr>
                  <td>Harga</td> <td>:</td> <td>{{ formatNumber(val($rowMenu, 'harga'), 0, true) }}</td>
                </tr>
                <tr>
                  <td>Kategori</td> <td>:</td> <td>{{ val($rowMenu, 'rel_kategori.nama') }}</td>
                </tr>
                <tr>
                  <td>Halal</td> <td>:</td> <td>{{ strtoupper(val($rowMenu, 'halal')) }}</td>
                </tr>
              </table>
              <br/>
              <div class="shop_item_details">
              
                <h3 class="">DESKRIPSI</h3>
                <div style="word-break: break-all; text-align: justify;">{!! val($rowMenu, 'deskripsi') !!}</div>

                <h3 class="">SELECT QUANTITY</h3>
                  <div class="item_qnty_shop">
                      <form id="myform" method="POST" action="#">
                          <input value="-" class="qntyminusshop" field="quantity-{{val($rowMenu, 'id')}}" type="button">
                          <input name="quantity-{{val($rowMenu, 'id')}}" value="1" class="qntyshop" type="text">
                          <input value="+" class="qntyplusshop" field="quantity-{{val($rowMenu, 'id')}}" type="button">
                      </form>
                  </div>
                  <a href="#" class="addtocart button_full btyellow" style="margin: 25px 0 150px;" data-resto="{{val($row, 'url')}}" data-meja="{{val($row, 'meja')}}" data-id="{{val($rowMenu, 'id')}}" data-url="{{ urlMenu($row, $rowMenu) }}" data-nama="{{val($rowMenu, 'nama')}}" data-harga="{{val($rowMenu, 'harga')}}" data-foto="{{ imgUrl($rowMenu->foto_utama, '200xauto') }}">PESAN</a>
                  </div>
                </div>
            </div>


              <!-- Setting Toolbar -->
              <span id="setToolBar"
                  data-home="{{ 'kuliner/'.val($row, 'url') }}"
                  data-url="{{val($row, 'url')}}"
                  data-id="resto-{{val($row, 'id')}}"
              ></span>

         </div>
      </div>
    </div>
  </div>
</div>

@endsection
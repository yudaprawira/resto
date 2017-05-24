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
                    <div class="navbar_right whitebg"><img src="{{ $pub_url }}/png/user.png" alt="" title="" /></div>
                </a>					
            </div>
						
            <div id="pages_maincontent">
            
                <h2 class="page_title">{{ val($row, 'nama') }} | Daftar Menu</h2>
                    
                <div class="page_single layout_fullwidth_padding">
      
                <ul class="shop_items">
                
                    @if( !empty($rowMenu) )
                    @foreach($rowMenu as $r)
                    <li>
                    <div class="shop_thumb"><a href="{{ urlMenu($row, $r) }}"><img src="{{ imgUrl($r->foto_utama, '200xauto') }}" alt="" title=""></a></div>
                    <div class="shop_item_details">
                    <h4><a href="{{ urlMenu($row, $r) }}">{{ val($r, 'nama') }}</a></h4>
                    <div class="shop_item_price">{{ formatNumber(val($r, 'harga'), 0, true) }}</div>
                        <div class="item_qnty_shop">
                            <form id="myform" method="POST" action="#">
                                <input value="-" class="qntyminusshop" field="quantity-{{val($r, 'id')}}" type="button">
                                <input name="quantity-{{val($r, 'id')}}" value="1" class="qntyshop" type="text">
                                <input value="+" class="qntyplusshop" field="quantity-{{val($r, 'id')}}" type="button">
                            </form>
                        </div>
                    <a href="#" class="addtocart" data-resto="{{val($row, 'url')}}" data-id="{{val($r, 'id')}}" data-url="{{ urlMenu($row, $r) }}" data-nama="{{val($r, 'nama')}}" data-harga="{{val($r, 'harga')}}" data-foto="{{ imgUrl($r->foto_utama, '200xauto') }}">PESAN</a>
                    <a href="{{ urlMenu($row, $r, 'share') }}" title="{{ val($r, 'nama') }}" data-popup=".popup-social" class="open-popup shopfav"><img src="{{ $pub_url }}/png/love-3.png" alt="" title=""></a>
                    </div>
                    </li> 
                    @endforeach
                    @endif
                    
                </ul>

                <div class="text-center">
                    {!! $rowMenu->appends(Input::except('page'))->setPath('kuliner/'.val($row, 'url').'/menu')->render() !!}
                </div>
                
                </div>


                <br/><br/>
                <br/><br/>
                <br/><br/>


                <!-- Setting Toolbar -->
                <span id="setToolBar"
                    data-home="{{ 'kuliner/'.val($row, 'url') }}"
                ></span>
            </div>

        </div>
    </div>
</div>

@endsection
@extends( config('app.be_template') . 'layouts.master')

@section('content')
<form method="POST" action="{{ BeUrl(config('restoran.info.alias').'/save') }}" enctype="multipart/form-data"> 

    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"> {{ trans('restoran::global.image') }} </h3>
                    <a href="#" class="btn btn-sm btn-flat btn-default pull-right" id="changeImage"><i class="fa fa-pencil"></i> {{ trans('restoran::global.change_image') }} </a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="text-center">
                        <img  src="{{ val($dataForm, 'foto_utama') ? asset('media/'.val($dataForm, 'foto_utama')) : asset('/global/images/no-image.png') }}" id="imagePreview">
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"> {{ trans('restoran::global.image_other') }} </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <ul id="imagethumbs" class="row text-center">
                        @if ( val($dataForm, 'foto') && !empty(json_decode(val($dataForm, 'foto'), true) ) )
                        @foreach( array_values(json_decode(val($dataForm, 'foto'), true)) as $tK=>$tV  )
                        <li class="col-xs-6 col-sm-6 col-md-4">
                            <div class="item-inner">
                                <img id="thumbSrc-{{ ($tK+1) }}" src="{{ imgUrl($tV) }}">
                                <input id="thumbPath-{{ ($tK+1) }}" name="foto[{{ ($tK+1) }}]" value="{{ $tV }}" type="hidden">
                                <div class="action">
                                    <div class="button btn-group btn-block" role="group">
                                        <button type="button" class="btn btn-sm btn-flat btn-default btn-setdefault" title="{{ trans('restoran::global.set_default') }}">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-flat btn-danger btn-deletethumb" title="{{ trans('restoran::global.deletethumb') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        @endif
                        <li class="col-xs-6 col-sm-6 col-md-4">
                            <div class="item-inner">
                                <a href="#" class="btn btn-default btn-add-thumb"><i class="fa fa-plus"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"> {{ trans('restoran::global.jam_oprasional') }} </h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped table-bordered table-hover nowrap" style="width: 100%;" id="table-oprational">
                        <thead>
                            <th class="col-md-2">{{ trans('restoran::global.hari') }}</th>
                            <th class="col-md-1">{{ trans('restoran::global.buka') }}</th>
                            <th class="col-md-10">{{ trans('restoran::global.jam') }}</th>
                        </thead>
                        <tbody>
                            <?php $rowJOP = json_decode(val($dataForm, 'jam_operasional'), true); ?>
                            @foreach( trans('global.day_long') as $day=>$dayIndo )
                            <?php $jop = val($rowJOP, $day); ?>
                            <tr>
                                <td class="nowrap" style="max-width: 10px;">{{ $dayIndo }}</td>
                                <td><div class="text-center"><input type="checkbox" class="excheck checkIsOpen" name="jam_operasional[{{$day}}][buka]" value="1" {{ val($jop, 'buka')=='1' ? 'checked' : '' }}  /></div></td>
                                <td>
                                    <div class="setLibur text-center" style="display: {{ val($jop, 'buka')=='1' ? 'none' : 'block' }};">LIBUR</div>
                                    <table class="setTime" style="display:  {{ val($jop, 'buka')=='1' ? 'block' : 'none' }};">
                                        <tr>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-time timepicker timestart" name="jam_operasional[{{$day}}][mulai]" value="{{ val($jop, 'mulai') }}">

                                                    <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td> - </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-time timepicker timeend" name="jam_operasional[{{$day}}][tutup]" value="{{ val($jop, 'tutup') }}">

                                                    <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"> {{ trans('restoran::global.meja') }} </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group has-feedback">
                        <label>{{ trans('restoran::global.jml_meja') }}</label><span class="char_count"></span>
                        <input type="text" class="form-control tNum" name="meja[standart]" maxlength="5" value="{{ val(json_decode(val($dataForm, 'meja'), true), 'standart') }}" />
                    </div>
                </div>
            </div>


        </div>
        <div class="col-md-8">
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"> {{ val($dataForm, 'form_title') }} </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                    <div class="row">
                        <div class="col-md-8">

                            <div class="form-group has-feedback">
                                <input type="checkbox" name="status" {{ isset($dataForm['status']) ? (val($dataForm, 'status')=='1' ? 'checked' : '') : 'checked' }} /> {{ trans('global.status_active') }}
                            </div>
                            
                            <div class="form-group has-feedback">
                                <label>{{ trans('restoran::global.nama') }}</label><span class="char_count"></span>
                                <input type="text" class="form-control" name="nama" maxlength="125" value="{{ val($dataForm, 'nama') }}" />
                            </div>
                            <div class="form-group has-feedback">
                                <label>{{ trans('menu::global.kategori') }}</label>
                                <select class="select2 form-control" name="kategori[]" multiple>
                                @foreach( trans('restoran::global.kategori_menu') as $kID=>$kNm )
                                    <option value="{{$kID}}" {{ val($dataForm, 'kategori') ? (in_array($kID, json_decode(val($dataForm, 'kategori'), true)) ? 'selected=1' : '') : '' }}>{{$kNm}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                        @if ( val($dataForm, 'id') )
                            {!!QrCode::size(150)->generate(FeUrl('kuliner/'.val($dataForm, 'url'), val($dataForm, 'nama')))!!}
                        @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6" style="padding-right: 1px;">
                            <div class="form-group has-feedback">
                                <label>{{ trans('restoran::global.type') }}</label> <br/>
                                <ul style="list-style: none; margin: 0;padding: 0;">
                                    <li><input type="checkbox" name="type[]" value="-dn-" {{ is_array(json_decode(val($dataForm, 'type'), true)) ? (in_array('-dn-', json_decode(val($dataForm, 'type'), true)) ? 'checked' : '') : '' }} /> {{ trans('restoran::global.-dn-') }}  &nbsp; <span class="help-block inline">{{ trans('restoran::global.-dn-helper') }}</span> </li>
                                    <li><input type="checkbox" name="type[]" value="-tk-" {{ is_array(json_decode(val($dataForm, 'type'), true)) ? (in_array('-tk-', json_decode(val($dataForm, 'type'), true)) ? 'checked' : '') : '' }} /> {{ trans('restoran::global.-tk-') }}  &nbsp; <span class="help-block inline">{{ trans('restoran::global.-tk-helper') }}</span> </li>
                                    <li><input type="checkbox" name="type[]" value="-do-" {{ is_array(json_decode(val($dataForm, 'type'), true)) ? (in_array('-do-', json_decode(val($dataForm, 'type'), true)) ? 'checked' : '') : '' }} /> {{ trans('restoran::global.-do-') }}  &nbsp; <span class="help-block inline">{{ trans('restoran::global.-do-helper') }}</span> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>{{ trans('restoran::global.fasilitas') }}</label><span class="char_count"></span>
                                <textarea class="form-control" style="min-height: 100px;" name="fasilitas" maxlength="255" placeholder="{{ trans('restoran::global.fasilitas_helper') }}">{!! val($dataForm, 'fasilitas') !!}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <label>{{ trans('restoran::global.kontak') }}</label>
                        <div class="row row-kontak">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                    <span class="char_count"></span>
                                    <input type="text" class="form-control" name="kontak_bbm" placeholder="{{ trans('restoran::global.kontak_bbm') }}" maxlength="8" value="{{ val($dataForm, 'kontak_bbm') }}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <span class="char_count"></span>
                                    <input type="text" class="form-control" name="kontak_telepon" placeholder="{{ trans('restoran::global.kontak_telepon') }}" maxlength="13" value="{{ val($dataForm, 'kontak_telepon') }}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-whatsapp"></i></span>
                                    <span class="char_count"></span>
                                    <input type="text" class="form-control" name="kontak_wa" placeholder="{{ trans('restoran::global.kontak_wa') }}" maxlength="13" value="{{ val($dataForm, 'kontak_wa') }}" />
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row row-kontak">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                                    <span class="char_count"></span>
                                    <input type="text" class="form-control" name="kontak_facebook" placeholder="{{ trans('restoran::global.kontak_facebook') }}" maxlength="8" value="{{ val($dataForm, 'kontak_facebook') }}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                                    <span class="char_count"></span>
                                    <input type="text" class="form-control" name="kontak_twitter" placeholder="{{ trans('restoran::global.kontak_twitter') }}" maxlength="13" value="{{ val($dataForm, 'kontak_twitter') }}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                                    <span class="char_count"></span>
                                    <input type="text" class="form-control" name="kontak_instagram" placeholder="{{ trans('restoran::global.kontak_instagram') }}" maxlength="13" value="{{ val($dataForm, 'kontak_instagram') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group has-feedback">
                        <label>{{ trans('restoran::global.alamat') }}</label><span class="char_count"></span>
                        <textarea class="form-control" style="min-height: 50px;" name="alamat" id="alamat" maxlength="255" placeholder="{{ trans('restoran::global.alamat_helper') }}">{!! val($dataForm, 'alamat') !!}</textarea>
                    </div>
                    
                    <p class="help-block">Posisikan marker (berwarna merah) pada peta dibawah ini, geser tepat menuju lokasi restoran Anda.</p>
                    <div id="map"></div>
                    <input type="hidden" class="form-control" name="lokasi_lat" id="lokasi_lat" value="{{ val($dataForm, 'lokasi_lat', config('app.map.default.lat')) }}" />
                    <input type="hidden" class="form-control" name="lokasi_lng" id="lokasi_lng" value="{{ val($dataForm, 'lokasi_lng', config('app.map.default.lng')) }}" />
                    <input type="hidden" class="form-control" name="kecamatan" id="kecamatan" value="{{ val($dataForm, 'kecamatan') }}" />
                    <input type="hidden" class="form-control" name="kota" id="kota" value="{{ val($dataForm, 'kota') }}" />
                    <input type="hidden" class="form-control" name="provinsi" id="provinsi" value="{{ val($dataForm, 'provinsi') }}" />
                    <input type="hidden" class="form-control" name="kodepos" id="kodepos" value="{{ val($dataForm, 'kodepos') }}" />

                    <div class="form-group has-feedback">
                        <label>{{ trans('restoran::global.deskripsi') }}</label><span class="char_count"></span>
                        <textarea class="form-control" style="min-height: 50px;" name="deskripsi" id="editor" placeholder="{{ trans('restoran::global.deskripsi_helper') }}">{!! val($dataForm, 'deskripsi') !!}</textarea>
                    </div>

                    <input type="hidden" name="id" value="{{ val($dataForm, 'id') }}" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="file" name="image" id="inputImage" />
                    <button type="submit" class="btn btn-primary btn-flat">{{ val($dataForm, 'id') ? trans('global.act_edit') : trans('global.act_add') }}</button>
                    <a href="{{ BeUrl(config('restoran.info.alias')) }}" class="btn btn-default btn-flat btn-reset">{{ trans('global.act_back') }}</a>
                  
                </div><!-- /.box-body -->
              </div>
        </div>
    </div>

</form>
@stop

@push('style')
<link rel="stylesheet" href="{{ asset('/global/css/jquery.ui.theme.css') }}"/>
<style>
.inline {
    display: inline-block;
}
.row-kontak .char_count{
    position: absolute;
    top: 4px;
    right: 4px;
    color: #bbb;
    font-size: 12px;
    font-weight: normal;
    z-index: 9;
}
.row-kontak .form-control{
    padding-right: 20px;
}
.input-time{
    max-width: 70px;
}
#imagePreview {
    width: 100%;
}
#inputImage {
    height: 0;
    width: 0;
    visibility: hidden;
}
#imagethumbs {
    list-style: none;
    padding: 0;
    margin: 0 -2px;
}
#imagethumbs li {
    padding: 2px;
}
#imagethumbs li img {
    width: 100%;
}
#imagethumbs li .item-inner{
    min-height: 100px;
    background: #ddd;
    position: relative;
    text-align: center;
}
#imagethumbs .btn-add-thumb {
    position: absolute;
    top: 14%;
    left: 14%;
    padding: 0px 15px;
    font-size: 50px;
}
#imagethumbs li .item-inner .action{
    position: absolute;
    top: 35%;
    left: 18%;
    display: none;
}
#imagethumbs li .item-inner:hover .action{
    display: block;
}

.ui-autocomplete-input, .input input {
  border: none; 
  font-size: 14px;
  width: 100%;
  height: 24px;
  margin-bottom: 5px;
  padding-top: 2px;
}

.ui-autocomplete-input {
  border: 1px solid #DDD !important;
  padding-top: 0px !important;
}

.map-wrapper
{
  float:left;  
  margin: 0 10px 0 10px;
}

#map {
  border: 1px solid #DDD; 
  width:100%;
  height: 300px;
  margin: 10px 0 10px 0;
  -webkit-box-shadow: #AAA 0px 0px 15px;
}

#legend {
  font-size: 12px;
  font-style: italic;
}

.ui-menu .ui-menu-item a {
  font-size: 12px;
}

.input {
  float:left;  
}

.input-positioned
{
  padding: 35px 0 0 0;
}

.ui-menu {
	list-style:none;
	padding: 2px;
	margin: 0;
	display:block;
	float: left;
}
.ui-menu .ui-menu {
	margin-top: -3px;
}
.ui-menu .ui-menu-item {
	margin:0;
	padding: 0;
	zoom: 1;
	float: left;
	clear: left;
	width: 100%;
}
.ui-menu .ui-menu-item a {
	text-decoration:none;
	display:block;
	padding:.2em .4em;
	line-height:1.5;
	zoom:1;
}
.ui-menu .ui-menu-item a.ui-state-hover,
.ui-menu .ui-menu-item a.ui-state-active {
	font-weight: normal;
	margin: -1px;
}
</style>
@endpush

@push('scripts')
<script src="http://maps.googleapis.com/maps/api/js?libraries=places&key={{ config('app.map.key') }}"></script>
<script src="{{ asset('/global/js/jquery.ui.addresspicker.js') }}"></script>
<script src="{{ asset('/global/js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
tinymce.init({ 
    selector:'#editor',
    height: 300,
    theme: 'modern', 
    plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
    ],
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
    image_advtab: true,
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'
    ] 
});
$(document).ready(function(){
    $(document).on('click', '#imagethumbs .btn-add-thumb', function(){
        clearThumb();
        var index = $('#imagethumbs li').length;
        var thumbSrc = 'thumbSrc-'+index;
        var thumbPath = 'thumbPath-'+index;
        var content = '<li class="col-xs-6 col-sm-6 col-md-4"><div class="item-inner">'
                    + '<img id="'+ thumbSrc +'"><input id="'+ thumbPath +'" type="hidden" name="foto['+index+']"/>'
                    +'<div class="action">'
                    +'<div class="button btn-group btn-block" role="group">'
                    +'<button type="button" class="btn btn-sm btn-flat btn-default btn-setdefault" title="{{ trans('restoran::global.set_default') }}"><i class="fa fa-check"></i></button>'
                    +'<button type="button" class="btn btn-sm btn-flat btn-danger btn-deletethumb" title="{{ trans('restoran::global.deletethumb') }}"><i class="fa fa-trash"></i></button>'
                    +'</div>'
                    +'</div>'
                    +'</div></li>';
        $('#imagethumbs li:last').before(content);
        imgSelector('#'+thumbSrc, '#'+thumbPath);
        return false;
    });

    //event closed modal image selector
    $('#modalImageSelector').on('hidden.bs.modal', function(){
        clearThumb();
    });

    //set defult
    $(document).on('click', '#imagethumbs li .item-inner .action .btn-setdefault', function(){
        var url = $(this).closest('li').find('img').attr('src');
        var path = $(this).closest('li').find('input[type=hidden]').val();
        $('#imagePreview').attr('src', url);
        $('#inputImage').attr('type', 'hidden');
        $('#inputImage').val(path);
        return false;
    });
    //delete thumb
    $(document).on('click', '#imagethumbs li .item-inner .action .btn-deletethumb', function(){
        $(this).closest('li').remove();
        return false;
    });

    function clearThumb()
    {
        $('#imagethumbs li').each(function(){
            if ( $(this).find('input[type=hidden]').length>0 && !$(this).find('input[type=hidden]').val() )
            {
                $(this).remove();
            }
        });
    }
    
    //event buka/libur
    $(document).on('change', '#table-oprational .checkIsOpen', function(){
        var row = $(this).closest('tr');
        var buka = $(this).is(':checked');
        var start = row.find('.timestart').val();
        var end = row.find('.timeend').val();

        var startDefault = null;
        var endDefault = null;

        //find filled time
        $('#table-oprational .timestart').each(function(){
            if ( $(this).val()) startDefault = $(this).val();
        });
        $('#table-oprational .timeend').each(function(){
            if ( $(this).val() ) endDefault = $(this).val();
        });

        if ( buka )
        {
            row.find('.setLibur').hide();
            row.find('.setTime').show();
            row.find('.timestart').val(startDefault);
            row.find('.timeend').val(endDefault);
        }
        else
        {
            row.find('.setLibur').show();
            row.find('.setTime').hide();
            row.find('.timestart').val('');
            row.find('.timeend').val('');
        }

    });

    //MAP
    var addresspickerMap = $( "#alamat" ).addresspicker({
      regionBias: "id",
      language: "id",
      mapOptions: {
        zoom: 15,
        center: new google.maps.LatLng($('#lokasi_lat').val(), $('#lokasi_lng').val()),
        scrollwheel: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      },
      reverseGeocode: true,
      elements: {
        map:      "#map",
        lat:      "#lokasi_lat",
        lng:      "#lokasi_lng",
        administrative_area_level_3: '#kecamatan',
        administrative_area_level_2: '#kota',
        administrative_area_level_1: '#provinsi',
        postal_code: '#kodepos',
      },
    });

    var gmarker = addresspickerMap.addresspicker( "marker");
    gmarker.setVisible(true);

    //JAM Operasional
    var tblOpr = $('#table-oprational').DataTable({
        'dom': 't',
        'ordering': false,
        'responsive': true
    });
    tblOpr.on( 'responsive-display', function ( e, datatable, row, showHide, update ) {
        initTimePicker();
    } );

    
});

</script>
@endpush
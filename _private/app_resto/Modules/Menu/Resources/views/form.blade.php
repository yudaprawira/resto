@extends( config('app.be_template') . 'layouts.master')

@section('content')
<form method="POST" action="{{ BeUrl(config('menu.info.alias').'/save') }}" enctype="multipart/form-data" id="formMenuResto">

    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"> {{ trans('menu::global.image') }} </h3>
                    <a href="#" class="btn btn-sm btn-flat btn-default pull-right" id="changeImage"><i class="fa fa-pencil"></i> {{ trans('menu::global.change_image') }} </a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="text-center">
                        <img  src="{{ val($dataForm, 'foto_utama') ? asset('media/'.val($dataForm, 'foto_utama')) : asset('/global/images/no-image.png') }}" id="imagePreview">
                    </div>
                    <div class="form-group has-feedback">
                        <span class="char_count"></span>
                        <input type="text" class="form-control" name="foto_info" maxlength="125" placeholder="{{ trans('menu::global.copyright') }}" id="inputCopyright" value="{{ val($dataForm, 'foto_info') }}" />
                    </div>
                </div>
            </div>

            <!-- PHOTO -->
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"> {{ trans('menu::global.images') }} </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <ul id="imagethumbs" class="row text-center">
                        @if ( val($dataForm, 'foto') && !empty(json_decode(val($dataForm, 'foto'), true) ) )
                        @foreach( array_values(json_decode(val($dataForm, 'foto'), true)) as $tK=>$tV  )
                        <li class="col-md-12">
                            <div class="row-fluid">
                                <div class="col-md-4 no-padding">
                                    <div class="item-inner">
                                        <img id="thumbSrc-{{ ($tK+1) }}" src="{{ imgUrl(val($tV, 'url')) }}">
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
                                </div>
                                <div class="col-md-8" style="padding-right: 0;">
                                    <input id="thumbPath-{{ ($tK+1) }}" name="foto[{{ ($tK+1) }}][url]" value="{{ val($tV, 'url') }}" type="hidden" class="inputThumbUrl">
                                    <input id="thumbPath-{{ ($tK+1) }}" name="foto[{{ ($tK+1) }}][copyright]" value="{{ val($tV, 'copyright') }}" placeholder="&copy; {{ trans('pustakagambar::global.copyright') }}" type="text" class="form-control inputThumbCopyright">
                                    <textarea id="thumbPath-{{ ($tK+1) }}" name="foto[{{ ($tK+1) }}][description]" class="form-control inputThumbDescription" placeholder="{{ trans('pustakagambar::global.keterangan') }}">{{ val($tV, 'description') }}</textarea>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        @endif
                        <li class="col-md-4">
                            <div class="item-inner">
                                <a href="#" class="btn btn-default btn-add-thumb"><i class="fa fa-plus"></i></a>
                            </div>
                        </li>
                    </ul>
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
                                <label>{{ trans('menu::global.nama') }}</label><span class="char_count"></span>
                                <input type="text" class="form-control" name="nama" maxlength="125" value="{{ val($dataForm, 'nama') }}" />
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                        @if ( val($dataForm, 'id') )
                            {!!QrCode::size(150)->generate(val($dataForm, 'publish_url'))!!}
                        @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>{{ trans('menu::global.kategori') }}</label>
                                <select class="select2 form-control" name="kategori">
                                @foreach( val(categoryArray(),'id_name') as $kID=>$kNm )
                                    <option value="{{$kID}}" {{ val($dataForm, 'kategori')==$kID ? 'selected=1' : '' }}>{{$kNm}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>{{ trans('menu::global.harga') }}</label>
                                <input type="text" class="form-control tNum" name="harga" value="{{ val($dataForm, 'harga') ? formatNumber(val($dataForm, 'harga')) : 0 }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>{{ trans('menu::global.halal') }}</label>
                                <select class="select2 form-control" name="halal">
                                @foreach( config('menu.halal') as $kID=>$kNm )
                                    <option value="{{$kID}}" {{ val($dataForm, 'halal')==$kID ? 'selected' : '' }}>{{$kNm}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group has-feedback">
                        <label>{{ trans('menu::global.deskripsi') }}</label><span class="char_count"></span>
                        <textarea id="editor" class="form-control" name="deskripsi">{{ val($dataForm, 'deskripsi') }}</textarea>
                    </div>

                    <input type="hidden" name="id" value="{{ val($dataForm, 'id') }}" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="file" name="foto_utama" id="inputImage" />
                    <button type="submit" class="btn btn-primary btn-flat">{{ val($dataForm, 'id') ? trans('global.act_edit') : trans('global.act_add') }}</button>
                    <a href="{{ BeUrl(config('menu.info.alias')) }}" class="btn btn-default btn-flat btn-reset">{{ trans('global.act_back') }}</a>
                  
                </div><!-- /.box-body -->
              </div>
        </div>
    </div>

</form>
@stop

@push('style')
<style>
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
    border-bottom: 1px solid #bbb;
    margin-bottom: 5px;
    padding-bottom: 5px;
}
#imagethumbs li:last-child {
    border-bottom:none!important;
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
.inputThumbCopyright {
    margin-bottom: 10px;
}
</style>
@endpush

@push('scripts')
<script src="{{ asset('/global/js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
initNumber();
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
$(document).on('click', '#imagethumbs .btn-add-thumb', function(){
    clearThumb();
    var index = $('#imagethumbs li').length;
    var thumbSrc = 'thumbSrc-'+index;
    var thumbPath = 'thumbPath-'+index;
    var thumbCopy = 'thumbCopy-'+index;
    var thumbDesc = 'thumbDesc-'+index;

    var content = '<li class="col-md-12">'
                        +'<div class="row-fluid">'
                            +'<div class="col-md-4 no-padding">'
                                +'<div class="item-inner">'
                                    +'<img id="'+ thumbSrc +'">'
                                    +'<div class="action">'
                                        +'<div class="button btn-group btn-block" role="group">'
                                            +'<button type="button" class="btn btn-sm btn-flat btn-default btn-setdefault" title="{{ trans('restoran::global.set_default') }}">'
                                                +'<i class="fa fa-check"></i>'
                                            +'</button>'
                                            +'<button type="button" class="btn btn-sm btn-flat btn-danger btn-deletethumb" title="{{ trans('restoran::global.deletethumb') }}">'
                                                +'<i class="fa fa-trash"></i>'
                                            +'</button>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'
                            +'<div class="col-md-8" style="padding-right: 0;">'
                                +'<input id="'+ thumbPath +'" name="foto['+index+'][url]"  type="hidden" class="inputThumbUrl">'
                                +'<input id="'+ thumbCopy +'" name="foto['+index+'][copyright]" placeholder="&copy; {{ trans('pustakagambar::global.copyright') }}" type="text" class="form-control inputThumbCopyright">'
                                +'<textarea id="'+ thumbDesc +'" name="foto['+index+'][description]" class="form-control inputThumbDescription" placeholder="{{ trans('pustakagambar::global.keterangan') }}"></textarea>'
                            +'</div>'
                        +'</div>'
                    +'</li>';
    $('#imagethumbs li:last').before(content);
    imgSelector('#'+thumbSrc, '#'+thumbPath, '#'+thumbCopy, '#'+thumbDesc);
    return false;
});

//event closed modal image selector
$('#modalImageSelector').on('hidden.bs.modal', function(){
    clearThumb();
});

//set defult
$(document).on('click', '#imagethumbs li .item-inner .action .btn-setdefault', function(){
    var url = $(this).closest('li').find('img').attr('src');
    var path = $(this).closest('li').find('.inputThumbUrl').val();
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

//submit save
$(document).on('submit', '#formMenuResto', function(){
    stringToNumForm($(this));
});

function clearThumb()
{
    $('#imagethumbs li').each(function(){
        if ( $(this).find('.inputThumbUrl').length>0 && !$(this).find('.inputThumbUrl').val() )
        {
            $(this).remove();
        }
    });
}
</script>
@endpush
@extends( config('app.be_template') . 'layouts.master')

@section('content')
    <!-- Main content -->
    <section class="content">

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" class="flat" href="#tab-meja">MEJA</a></li>
            <li><a data-toggle="tab" class="flat" href="#tab-pesanan">PESANAN</a></li>
        </ul>

        <div class="tab-content">
            <div id="tab-meja" class="tab-pane fade in active">

                @if( val(session::get('ses_switch_to'), session::get('ses_switch_active')) )
                <?php $active = val(session::get('ses_switch_to'), session::get('ses_switch_active')); 
                      $meja = json_decode(val($active, 'meja'), true); ?>

                      <script>
                        var resto = '{{val($active, 'url')}}';
                        var kategori = 'standart';
                        var defaultUser = {
                            uid : '-',
                            displayName : 'Tamu',
                            photoURL : '-',
                        };

                        //fetch data
                        var type  = 'resto';
                        var table = type + '/' + resto + '/' + 'meja' + '/' + kategori;
                        var ref = firebase.database().ref().child(table).orderByChild('id');
                        var count = 0;
                        ref.on('value', function (snapshot) {
                            var html = '';
                            if (snapshot.hasChildren()) 
                            {
                                var idMeja = [];
                                snapshot.forEach(function (child) {
                                    var obj = child.val();
                                    idMeja.push(obj.id);
                                    html+='<div class="col-xs-6 col-md-2"><div data-object="'+btoa(JSON.stringify(obj))+'" data-toggle="modal" data-target="#modalMeja" class="item '+ (obj.status=='tersedia' ? '' : 'active') +'">Meja '+ obj.id +'</div></div>';
                                });
                                if ( idMeja.length != {{val($meja, 'standart')}} )
                                {
                                    for(var i=1; i<={{val($meja, 'standart')}}; i++)
                                    {
                                        if ( !idMeja.includes(i) )
                                        {
                                           updateMeja(resto, i, kategori, null, defaultUser);
                                        }
                                    }
                                }
                            }
                            else
                            {
                                for(var i=1; i<={{val($meja, 'standart')}}; i++)
                                {
                                    updateMeja(resto, i, kategori, null, defaultUser);
                                }
                            }
                            $('.list-meja').html(html);
                        });
                      </script>
                
                    <div class="row-fluid list-meja">
                        <h1 class="text-center">SEDANG MEMUAT...</h1>
                    </div>
                    <div class="clearfix"></div>

                @endif
            </div>
            <div id="tab-pesanan" class="tab-pane fade">
                pesanan
            </div>
        </div>

        <!-- MODAL MEJA -->
        <div id="modalMeja" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Info Meja</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-hover table-striped">
                        <tr>
                            <td rowspan="4" style="width: 126px;"><img src="" id="mod-meja-foto" style="width: 126px;"></td>
                        </tr>
                        <tr>
                            <td style="width:10px;">ID</td> <td id="mod-meja-id">-</td>
                        </tr>
                        <tr>
                            <td style="width:10px;">Nama</td> <td><input type="text" class="form-control" id="mod-meja-nama"></td>
                        </tr>
                        <tr>
                            <td style="width:10px;">Status</td> <td>
                                <input type="radio" name="mod-meja-status" class="excheck" id="mod-meja-status-dipakai" value="dipakai"> Dipakai &nbsp; &nbsp; &nbsp;
                                <input type="radio" name="mod-meja-status" class="excheck" id="mod-meja-status-tersedia" value="tersedia"> Tersedia 
                            </td>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
        </div>

    </section>
@stop
@push('style')
<style>
.tab-pane{
    background: #fff;
    border-left: 1px solid #ddd;
    padding: 10px;
    border-bottom: 1px solid #ddd;
    border-right: 1px solid #ddd;
}
.list-meja .item{
    border: 1px solid #ddd;
    margin: 5px;
    padding: 35px 20px;
    text-align: center;
    cursor: pointer;
    font-weight: bold;
    text-transform: uppercase;
}
.list-meja .item:hover,
.list-meja .item.active {
    background: #00a65a;
    color: #FFF;
}
</style>
@endpush
@push('scripts')
<script>
$(document).on('click', '.list-meja .item', function(){
    var obj = jQuery.parseJSON(atob($(this).data('object')));
    $('#mod-meja-id').text('Meja '+ obj.id);
    $('#mod-meja-nama').val(obj.user.nama);
    $('#mod-meja-foto').attr('src', (obj.user.foto == '-'? '{{asset('/global/images/no-image.png')}}' : obj.user.foto ));

    $('[name="mod-meja-status"]').attr('checked', false);
    $('[name="mod-meja-status"]').prop('checked', false);

    if ( obj.status=='dipakai' )
    {
        $('#mod-meja-status-dipakai').attr('checked', true);
        $('#mod-meja-status-dipakai').prop('checked', true);
    }
    else
    {
        $('#mod-meja-status-tersedia').attr('checked', true);
        $('#mod-meja-status-tersedia').prop('checked', true);
    }

    return false;
});
</script>
@endpush
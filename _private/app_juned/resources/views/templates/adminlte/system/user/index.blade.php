@extends( config('app.be_template') . 'layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">{{ trans('system/user.title') }}</h3>
                  <div class="link-table-pane">
                    <a href="{{ BeUrl('system-user') }}" class="{{ $isTrash ? '' : 'active'}}">{{ trans('global.all') }} <span>({{$countAll}})</span></a> | 
                    <a href="{{ BeUrl('system-user/trash') }}" class="{{ $isTrash ? 'active' : ''}}">{{ trans('global.trash') }} <span>({{$countTrash}})</span></a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <table class="table table-striped table-bordered" id="list-table" data-url="{{ BeUrl('system-user').($isTrash ? '/trash' : '') }}" data-token="{{ csrf_token() }}" data-responsive="1" data-fixedheader="1">
                    <thead>
                    <tr>
                      <th data-sort="1" data-search="1" data-column="id" style="width: 10px">#</th>
                      <th data-sort="1" data-search="1" data-column="username">{{ trans('system/user.name') }}</th>
                      <th data-sort="1" data-search="1" data-column="reldivisi.nama">Divisi</th>
                      <th data-sort="1" data-search="1" data-column="rellevel.name">Jabatan</th>
                      <th data-sort="1" data-search="1" data-column="last_login">{{ trans('system/user.lastlogin') }}</th>
                      <th data-sort="1" data-search="1" data-column="status" class="col-md-1 nowrap">{{ trans('global.status') }}</th>
                      <th data-sort="0" data-search="0" data-column="action" style="width: 90px;white-space: nowrap;">{{ trans('global.action') }}</th>
                    </tr>
                    </thead>
                    <tbody> </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div>
        </div>
        <div class="col-md-4">
            {!! $form !!}
        </div>
    </div>
@stop

@push('style')
<style>
#list-table td:nth-child(3),
#list-table td:nth-child(4),
#list-table td:nth-child(5){
  white-space: nowrap;
  text-align: center;
}
</style>
@endpush
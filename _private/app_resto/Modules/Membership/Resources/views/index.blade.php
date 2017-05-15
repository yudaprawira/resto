@extends( config('app.be_template') . 'layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data {{ config('membership.info.name') }} </h3>
                  <a href="{{ BeUrl(config('membership.info.alias').'/add') }}" class="btn btn-primary btn-flat btn-add pull-right">{{ trans('global.add') }} {{ config('membership.info.name') }} </a>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <table class="table table-striped table-bordered" id="list-table" data-url="{{ BeUrl(config('membership.info.alias')) }}" data-token="{{ csrf_token() }}" data-responsive="1" data-fixedheader="1">
                    <thead>
                    <tr>
                      <th data-sort="1" data-search="1" data-column="id" style="width: 10px">ID</th>
                      <th data-sort="1" data-search="1" data-column="nama">{{ trans('membership::global.nama') }}</th>
                      <th data-sort="1" data-search="1" data-column="status" class="col-md-1 nowrap">{{ trans('global.status') }}</th>
                      <th data-sort="1" data-search="1" data-column="created_at" class="col-md-1 nowrap">{{ trans('membership::global.created_at') }}</th>
                      <th data-sort="1" data-search="1" data-column="updated_at" class="col-md-1 nowrap">{{ trans('membership::global.updated_at') }}</th>
                      <th data-sort="0" data-search="0" data-column="action" style="width: 90px;white-space: nowrap;">{{ trans('global.action') }}</th>
                    </tr>
                    </thead>
                    <tbody> </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div>
        </div>
    </div>
@stop
@push('style')
<style>
.btn-add{
  margin-right: 5px;
}
#list-table td:nth-child(3),
#list-table td:nth-child(4),
#list-table td:nth-child(5){
  white-space: nowrap;
  text-align: center;
}
</style>
@endpush
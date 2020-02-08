@if(Session::has('flash_message'))
<div class="col-sm-12 col-xs-12">
    <div class="alert alert-success alert-dismissible fade in" role="alert" style="margin-bottom: -10px">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong> {{ Session::get('flash_message') }} </strong>
    </div>
</div>
@endif
@if(Session::has('flash_error'))
<div class="col-sm-12 col-xs-12">
    <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-bottom: -10px">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong> {{ Session::get('flash_error') }}</strong>
    </div>
</div>
@endif

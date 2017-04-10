@if (session()->has('flash_notification.message'))
    <div class="alert alert-{{ session('flash_notification.level') }}" style="width: 100%;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {!! session('flash_notification.message') !!}
    </div>
@endif
@if (Session::has('message'))
    <div class="alert alert-success" role="alert">
        <span class="status-msg">{{ Session::get('message') }}</span>
    </div>
@endif

{{--@if (Session::has('status'))--}}
{{--    <div class="alert alert-success" role="alert">--}}
{{--        {{ Session::get('status') }}--}}
{{--    </div>--}}
{{--@endif--}}

@if (Session::has('danger'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('danger') }}
    </div>
@endif


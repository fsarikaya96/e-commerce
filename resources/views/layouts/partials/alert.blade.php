@if (Session::has('message'))
    <div class="alert alert-success" role="alert">
        <span class="status-msg">{{ Session::get('message') }}</span>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-warning" role="alert">
        <strong>HATA!</strong>
    @foreach ($errors->all() as $error)
        <p class="mt-2">{{$error}}</p>
    @endforeach
    </div>
@endif



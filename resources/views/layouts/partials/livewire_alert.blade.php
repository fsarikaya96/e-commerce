@if (Session::has('livewire_message'))
    <div class="alert alert-success" role="alert">
        <span class="status-msg">{{ Session::get('livewire_message') }}</span>
    </div>
@endif

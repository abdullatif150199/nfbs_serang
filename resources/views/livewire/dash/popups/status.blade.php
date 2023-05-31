@if ($data->status === 'show')
    <x-badge color="green" text="Ditampilkan" />
@else
    <x-badge color="gray" text="Disembunyikan" />
@endif

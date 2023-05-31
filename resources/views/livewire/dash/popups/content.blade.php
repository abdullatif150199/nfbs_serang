@if ($data->type === 'image')
    <img src="{{ $data->popup_thumb_url }}" class="h-auto w-28 rounded" />
@else
    {!! $data->content !!}
@endif

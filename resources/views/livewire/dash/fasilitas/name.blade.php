<div>
    <p class="mb-4 text-lg font-semibold">{{ $data->title }}</p>

    <div class="flex items-center space-x-2">
        @foreach ($data->subfacilities as $item)
            <img src="{{ $item->image_thumb_url }}" class="h-auto w-28 rounded" alt="Fasilitas NFBS Serang">
        @endforeach
    </div>
</div>

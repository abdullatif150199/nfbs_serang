<div class="flex flex-col space-y-2">
    <a href="{{ route('post.show', $data->slug) }}" target="_blank"
        class="text-blue-800 font-semibold break-normal hover:underline">{{ $data->title }}</a>
    <div>
        {!! $data->publicationLabel() !!}
        &#8729;
        <span class="text-gray-600 text-sm">{{ $data->date }}</span>
        &#8729;
        <x-badge color="gray" text="{{ $data->category->title }}" />
    </div>
</div>

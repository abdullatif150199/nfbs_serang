<div>
    @if (!empty($info))
        <p>
            {!! $info->title !!}
            <a href="{{ $info->link }}"
                class="inline-flex items-center justify-center text-base font-medium text-gray-900 bg-white hover:underline">
                Baca selengkapnya<span aria-hidden="true"> &nbsp; &rarr;</span>
            </a>
        </p>

        <div class="mt-4">
            <a href="{{ route('dash.edit', ['item' => 'info', 'id' => $info->id]) }}"
                class="inline-flex items-center pl-3 pr-4 py-1.5 text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-0.5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                    <path fill-rule="evenodd"
                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                        clip-rule="evenodd" />
                </svg>
                <span>SUNTING</span>
            </a>
        </div>
    @endif
</div>

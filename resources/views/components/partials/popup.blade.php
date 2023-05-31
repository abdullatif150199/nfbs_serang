<div>
    <div x-data="{ modelOpen: false }" x-init="setTimeout(() => modelOpen = {{ $show }}, 2000)" x-cloak>
        <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pb-4 text-center md:items-center">
                <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                    x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-90" aria-hidden="true"></div>

                <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                    <div class="flex items-center justify-between space-x-4">
                        <div class="absolute top-0 right-0 pt-4 pr-4">
                            <button type="button" x-on:click="modelOpen = false"
                                class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <span class="sr-only">Close</span>
                                <!-- Heroicon name: outline/x-mark -->
                                <x-icon.o-x class="h-6 w-6" />
                            </button>
                        </div>
                    </div>

                    @if ($popup->type === 'image')
                        <a href="{{ $popup->url }}">
                            <img src="{{ $popup->popup_url }}" alt="Popup image">
                        </a>
                    @endif

                    @if ($popup->type === 'text')
                        <div class="p-4 prose lg:prose-xl">
                            {!! $popup->content !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

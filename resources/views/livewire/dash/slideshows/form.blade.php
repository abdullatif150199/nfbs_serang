<div>
    <form wire:submit.prevent="save">
        <div class="px-4 py-5 sm:p-6 md:grid md:grid-cols-3 md:gap-6">
            @if ($errors->any())
                @php
                    dump($errors->any());
                @endphp
            @endif
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Slideshow</h3>
                <p class="mt-1 mb-4 text-sm text-gray-500">
                    Sangat disarankan agar memperkecil ukuran gambar yang akan diupload, gunakan tool berikut
                    <a href="https://tinyjpg.com/" class="text-blue-600 font-semibold" target="_blank">tinyjpg</a>.
                </p>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="space-y-6">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">
                            Slide image
                        </label>
                        @if (!$image_edit)
                            <x-file-attachment wire:model="image" :file="$image" />
                        @else
                            <img src="{{ asset($image_thumb) }}" class="object-scale-down h-40 w-100" alt="slideshow">
                            <button wire:click.prevent="delete({{ $postId }})" title="hapus"
                                class="group p-2 border border-transparent rounded-full shadow-sm text-white bg-gray-200 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                                <!-- Heroicon name: solid/x -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-gray-500 group-hover:text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        @endif
                    </div>
                    <x-input label="Judul" name="title" placeholder="Opsional" livewire />
                    <x-input label="Url" name="url" placeholder="Opsional" livewire />
                </div>
            </div>
        </div>
        <div class="flex justify-end px-4 py-3 rounded-b-xl sm:px-6">
            <button type="button"
                class="bg-white py-2 px-5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Cancel
            </button>
            <button type="submit"
                class="ml-3 inline-flex justify-center py-2 px-6 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Save
            </button>
        </div>
    </form>

    @once
        @push('script')
            <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
        @endpush
    @endonce
</div>

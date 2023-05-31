<div>
    <form wire:submit.prevent="save">
        <div class="px-4 py-5 sm:p-6 md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Buat Artikel</h3>
                <p class="mt-1 mb-4 text-sm text-gray-500">
                    Sangat disarankan agar memperkecil ukuran gambar yang akan diupload, gunakan tool berikut
                    <a href="https://tinyjpg.com/" class="text-blue-600 font-semibold" target="_blank">tinyjpg</a>.
                </p>

                <div class="space-y-6">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">
                            Cover image
                        </label>
                        <x-file-attachment wire:model="image" :file="$image" />
                    </div>
                    <div class="grid grid-cols-2">
                        <x-select label="Kategori" name="category_id" :list="$categories" livewire />
                        <div class="space-x-4">
                            <div class="mb-7"></div>
                            <button
                                onclick="Livewire.emit('openModal', 'dash.website.categories-form', {{ json_encode(['id' => null]) }})"
                                class="inline-flex items-center pl-3 pr-4 py-1.5 text-xs font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>NEW</span>
                            </button>
                        </div>
                    </div>
                    <x-date-picker label="Tanggal publish" name="published_at" livewire />
                    <span class="text-xs text-gray-500">*Jika kosong, akan disimpan sebagai draft</span>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="space-y-6">
                    <x-input label="Judul" name="title" livewire />
                    <x-input label="Slug" name="slug" livewire />
                    <x-tinymce wire:model="body" placeholder="Ketikan konten disini..." />
                    @error('body')
                        <p class="mt-2 text-xs font-semibold text-red-600" id="email-error">{{ $message }}</p>
                    @enderror
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

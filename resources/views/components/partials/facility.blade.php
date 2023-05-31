<div>
    <div class="bg-gray-50">
        <div class="mx-auto md:flex md:justify-between">
            <div class="md:w-1/3 bg-gray-50 p-4 md:p-8  md:text-right">
                <h2 class="text-gray-600 text-3xl font-extrabold tracking-tight sm:text-4xl mb-4">
                    Fasilitas
                </h2>
                <ul class="hidden md:flex flex-col items-end space-y-2">
                    {{-- <li class="flex items-center font-semibold">
                        <a href="" class="hover:underline hover:text-gray-500">Asrama</a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </li> --}}
                    @foreach ($listItems as $key => $val)
                        <li class="flex items-center">
                            <button onclick="Livewire.emit('get-slides', {{ $key }})"
                                class="hover:underline hover:text-gray-500">{{ $val }}</button>
                            <div></div>
                        </li>
                    @endforeach
                </ul>
                <div class="md:hidden">
                    <label for="facility" class="sr-only">Fasilitas</label>
                    <select id="facility" name="facility"
                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option>Pilih Fasilitas</option>
                        @foreach ($listItems as $key => $val)
                            <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="md:w-2/3">
                {{-- <img src="images/background.jpg" class="w-full h-auto object-cover" alt="Fasilitas"> --}}
                <livewire:web.facility />
            </div>
        </div>
    </div>
</div>

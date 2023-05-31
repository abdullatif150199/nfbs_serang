<div class="grid grid-cols-3 gap-4">
    <div>
        <div class="shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
            <div class="divide-y">
                <div class="flex items-center justify-between px-4 py-6">
                    <div class="ml-7 text-md font-bold uppercase text-gray-700">
                        Menu
                    </div>
                </div>
                @foreach ($menuList as $index => $menu_list)
                    <div class="bg-white rounded-b">
                        <label class="relative p-4 flex items-center cursor-pointer">
                            <input type="radio" wire:model="menu_id" name="menu_id" value="{{ $menu_list->id }}"
                                class="h-4 w-4 cursor-pointer text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                aria-labelledby="privacy-setting-0-label"
                                aria-describedby="privacy-setting-0-description">
                            <div class="ml-3 flex flex-col">
                                <span class="text-gray-900 block text-sm font-medium">
                                    {{ $menu_list->name }}
                                </span>
                            </div>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-span-2">
        <div class="shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
            <div class="divide-y">
                <div class="flex items-center justify-between px-4 py-4">
                    <div class="ml-7 text-md font-bold uppercase text-gray-700">
                        Sub Menu
                    </div>
                    <div class="space-x-1">
                        <x-button.primary
                            onclick="Livewire.emit('openModal', 'dash.menu.form', {{ json_encode(['menu_id' => $menu_id]) }})"
                            class="flex items-center bg-white">
                            <x-icon.plus class="h-4 w-4 mr-1" /> New
                        </x-button.primary>
                    </div>
                </div>
                @forelse ($submenuList as $sub)
                    <div class="flex justify-between px-4 py-2 items-center bg-white rounded-b">
                        <div class="flex items-center">
                            <input type="radio" name="submenu_id" value="{{ $sub->id }}"
                                class="h-4 w-4 cursor-pointer text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                aria-labelledby="privacy-setting-0-label"
                                aria-describedby="privacy-setting-0-description">
                            <div class="ml-3 flex flex-col">
                                <span class="text-gray-900 block text-sm font-medium">
                                    {{ $sub->sub_name }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <button
                                onclick="Livewire.emit('openModal', 'dash.menu.sub-menu-edit-form', {{ json_encode(['submenu_id' => $sub->id]) }})"
                                title="Edit"
                                class="group p-2 border border-transparent rounded-full text-white hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                                <x-icon.o-edit class="h-4 w-4 text-gray-500 group-hover:text-white" />
                            </button>
                            <a href="#"
                                wire:click.prevent="confirm({{ $sub->id }}, 'delete', 'Yakin ingin menghapus?')"
                                title="Hapus"
                                class="group p-2 border border-transparent rounded-full text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                                <x-icon.o-trash class="h-4 w-4 text-gray-500 group-hover:text-white" />
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="px-10 py-4 uppercase bg-orange-100">
                        <span>Menu ini tidak memiliki Sub-Menu</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

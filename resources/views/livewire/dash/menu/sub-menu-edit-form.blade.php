<div>
    <div class="w-full my-10">
        <div class="bg-white rounded-xl">
            <form wire:submit.prevent="update">
                <div class="px-4 py-5 sm:p-6 md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Edit Submenu</h3>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="space-y-6">
                            <x-input label="Nama Submenu" wire:model="sub_name" name="sub_name" />
                            <x-input label="Url" wire:model="sub_url" name="sub_url" />
                        </div>
                    </div>
                </div>
                <div class="flex justify-end px-4 py-3 rounded-b-xl sm:px-6">
                    <button type="button" wire:click="$emit('closeModal')"
                        class="bg-white py-2 px-5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </button>
                    <button type="submit" wire:loading.remove wire:target="update"
                        class="ml-3 inline-flex justify-center py-2 px-6 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

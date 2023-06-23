<div>
    <form wire:submit.prevent="save">
        <div class="px-4 py-5 sm:p-6 md:grid md:grid-cols-3 flex justify-center">
            <div class="mt-5 md:mt-0 md:col-span-2 ">
                <div class="space-y-6 mx-auto">
                    <x-input label="Nama" name="nama" livewire />
                    <x-input label="Jurusan" name="jurusan" livewire />
                    <x-input label="Nama Kampus" name="nama_kampus" livewire />
                    <x-select label="Jenis Kampus" name="jenis_kampus" :list="$listJenisKampus" livewire />
                    <x-select label="Tahun Lulus" name="tahun_lulus" :list="$listTahunLulus" livewire />
                </div>
            </div>
        </div>
        <div class="flex justify-start px-4 py-3 rounded-b-xl sm:px-6">
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
</div>

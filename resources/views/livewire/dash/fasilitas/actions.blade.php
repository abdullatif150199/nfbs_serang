<div class="flex items-center space-x-1">
    <a href="{{ route('dash.edit', ['item' => 'fasilitas', 'id' => $data->id]) }}" title="Edit"
        class="group p-2 border border-transparent rounded-full text-white hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
        <x-icon.o-edit class="h-4 w-4 text-gray-500 group-hover:text-white" />
    </a>

    <a href="#" wire:click.prevent="confirm({{ $data->id }}, 'delete', 'Yakin ingin menghapus?')" title="Hapus"
        class="group p-2 border border-transparent rounded-full text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
        <x-icon.o-trash class="h-4 w-4 text-gray-500 group-hover:text-white" />
    </a>
</div>

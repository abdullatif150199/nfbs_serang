<div class="flex items-center space-x-1">
    <a href="#" wire:click.prevent="confirm({{ $data->id }}, 'changeStatus', 'Yakin ingin mengubah status?')"
        title="{{ $data->status === 'show' ? 'Sembunyikan' : 'Tampilkan' }}"
        class="group p-2 border border-transparent rounded-full text-white {{ $data->status === 'show' ? 'hover:bg-gray-500' : 'hover:bg-green-500' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
        @if ($data->status === 'show')
            <x-icon.o-eye-slash class="h-4 w-4 text-gray-500 group-hover:text-white" />
        @else
            <x-icon.o-eye class="h-4 w-4 text-gray-500 group-hover:text-white" />
        @endif
    </a>

    @if ($data->type === 'text')
        <a href="{{ route('dash.edit', ['item' => 'popups', 'id' => $data->id]) }}" title="Edit"
            class="group p-2 border border-transparent rounded-full text-white hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
            <x-icon.o-edit class="h-4 w-4 text-gray-500 group-hover:text-white" />
        </a>
    @endif

    <a href="#" wire:click.prevent="confirm({{ $data->id }}, 'delete', 'Yakin ingin menghapus?')"
        title="Hapus"
        class="group p-2 border border-transparent rounded-full text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
        <x-icon.o-trash class="h-4 w-4 text-gray-500 group-hover:text-white" />
    </a>
</div>

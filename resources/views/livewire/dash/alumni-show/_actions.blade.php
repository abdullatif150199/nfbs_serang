<div class="flex items-center space-x-1">
    <!-- <a href="{{ route('dash.show', ['item' => 'alumni-show', 'id' => $data->id]) }}"
        class="inline-flex items-center px-2 py-2 text-xs
                                font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none
                                focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        <x-icon.o-eye class="h-5 w-5 mr-1" />
        <span>Show</span>
    </a>     -->
        
    </a> 
    <a href="{{ route('dash.edit', ['item' => 'alumni', 'id' => $data->id]) }}" title="edit"
        class="group p-2 border border-transparent rounded-full text-white hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
        <x-icon.o-edit class="h-4 w-4 text-gray-500 group-hover:text-white" />
    </a>

    <a href="#" wire:click.prevent="deleteConfirm({{ $data->id }})" title="hapus"
        class="group p-2 border border-transparent rounded-full text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
        <x-icon.o-trash class="h-4 w-4 text-gray-500 group-hover:text-white" />
    </a>
</div>

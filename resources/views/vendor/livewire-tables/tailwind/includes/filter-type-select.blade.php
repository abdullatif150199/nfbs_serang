<div class="mt-1 relative rounded-md shadow-sm">
    @if($key === 'tahun_lulus')
        <select
        wire:model.stop="filters.{{ $key }}"
        wire:model="tahunLulus"
        wire:key="filter-{{ $key }}"
        id="filter-{{ $key }}"
        class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600"
         >
    @else
        <select
            wire:model.stop="filters.{{ $key }}"
            wire:key="filter-{{ $key }}"
            id="filter-{{ $key }}"
            class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600"
        >
    @endif
        @foreach($filter->options() as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
</div>
<x-dash-layout>
    <div class="pt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="flex-1 text-2xl font-bold text-gray-900">Posts</h1>
        <!-- Stat -->
        <livewire:dash.posts.stat />

        <!-- Table -->
        <div class="-mx-4 my-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
            <div class="divide-y">
                <div class="flex items-center justify-between px-4 py-4">
                    <div class="text-md font-medium uppercase text-gray-700">
                        Daftar Artikel
                    </div>
                    <div class="space-x-1">
                        <a href="{{ route('dash.views', 'categories') }}"
                            class="inline-flex items-center pl-3 pr-4 py-2 text-xs
                                                    font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none
                                                    focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <x-icon.o-tag class="h-5 w-5 mr-1" />
                            <span>Kategori</span>
                        </a>

                        <a href="{{ route('dash.create', 'posts') }}"
                            class="inline-flex items-center pl-3 pr-4 py-2 text-xs
                                                    font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none
                                                    focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <x-icon.o-plus class="h-5 w-5 mr-1" />
                            <span>New</span>
                        </a>
                    </div>
                </div>
                <div class="rounded-b flex flex-col px-4 py-4">
                    <livewire:dash.posts.table />
                </div>
            </div>
        </div>
    </div>
</x-dash-layout>

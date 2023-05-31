<x-dash-layout>
    <div class="pt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="flex-1 text-2xl font-bold text-gray-900">About Us</h1>

        <!-- Table -->
        <div class="-mx-4 my-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
            <div class="divide-y">
                <div class="flex items-center justify-between px-4 py-4">
                    <div class="text-md font-medium uppercase text-gray-700">
                        TENTANG KAMI
                    </div>
                    <div class="space-x-1">
                        {{-- right button here --}}
                    </div>
                </div>
                <div class="rounded-b flex flex-col px-4 py-4">
                    <livewire:dash.about-us.index />
                </div>
            </div>
        </div>
    </div>
</x-dash-layout>

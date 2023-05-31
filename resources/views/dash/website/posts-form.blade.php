<x-dash-layout>
    <div class="pt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="flex-1 text-2xl font-bold text-gray-900">Posts</h1>
        <!-- Stat -->
        <livewire:dash.posts.stat />

        <!-- Table -->
        <div class="w-full my-10">
            <div class="bg-white rounded-xl">
                <livewire:dash.posts.form :postId="$postId" />
            </div>
        </div>
    </div>
</x-dash-layout>

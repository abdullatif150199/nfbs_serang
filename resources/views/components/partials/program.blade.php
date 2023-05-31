<div>
    <div class="bg-white">
        <!-- Header -->
        <div class="relative pb-32 bg-gray-800">
            <div class="absolute inset-0">
                <img class="w-full h-full object-cover" src="images/bg-unggulan.jpg" alt="">
                <div class="absolute inset-0 bg-gray-800" style="mix-blend-mode: multiply;" aria-hidden="true"></div>
            </div>
            <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
                <h2 class="text-white text-3xl font-extrabold tracking-tight sm:text-4xl">
                    Program Unggulan
                </h2>
                <p class="mt-6 max-w-3xl text-xl text-gray-300">NFBS Serang sangat menekankan keseimbangan pengajaran
                    antara
                    teori dan praktik, sehingga kegiatan belajar mengajar dapat
                    lebih dinamis dan tidak membosankan serta fokus pada minat dan bakat santri.</p>
            </div>
        </div>

        <!-- Overlapping cards -->
        <section class="-mt-32 max-w-7xl mx-auto relative z-10 pb-20 md:pb-32 px-8 md:px-4"
            aria-labelledby="contact-heading">
            <h2 class="sr-only" id="contact-heading">Sains</h2>
            <div class="grid grid-cols-1 gap-y-20 lg:grid-cols-3 lg:gap-y-0 lg:gap-x-8">
                @foreach ($programs as $program)
                    <div class="bg-white rounded-2xl shadow-xl">
                        <div class="relative pt-16 px-6 pb-8 md:px-8">
                            <div
                                class="absolute top-0 p-5 inline-block bg-blue-600 rounded-xl shadow-lg transform -translate-y-1/2">
                                <!-- Heroicon name: outline/newspaper -->
                                <x-icon.o-newspaper class="h-6 w-6 text-white" />
                            </div>
                            <h3 class="text-xl font-medium text-gray-900">{{ $program->name }}</h3>
                            <p class="mt-4 text-base text-gray-500">
                                {{ $program->desc_preview }}
                            </p>
                        </div>
                        <div class="p-6 bg-gray-50 rounded-bl-2xl rounded-br-2xl md:px-8">
                            <a href="{{ route('post.program', $program->slug) }}"
                                class="text-base font-medium text-blue-700 hover:text-blue-600">Selengkapnya<span
                                    aria-hidden="true"> &rarr;</span></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</div>

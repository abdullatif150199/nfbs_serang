@extends('layouts.web')

@section('content')

   <div class="relative mt-24 flex justify-center items-center text-center ">
        <h1 class="pt-16 text-xl font-semibold tracking-tight text-gray-900 md:text-3xl text-center">Sebaran Alumni</h1>
   </div>

    <div class="relative py-8 md:py-16 overflow-hidden justify-center items-center mt-24 grid bg-white">
        <div class="text-center text-3xl">
            <img class="w-full rounded-lg" src="storage/alumni/alumni.jpg" alt="Sebaran Alumni">
        </div>
        <div class="hidden lg:block lg:absolute lg:inset-y-0 lg:h-full lg:w-full">
            <div class="relative h-full text-lg max-w-prose mx-auto" aria-hidden="true">
                <svg class="absolute top-12 left-full transform translate-x-32" width="404" height="384" fill="none"
                    viewBox="0 0 404 384">
                    <defs>
                        <pattern id="74b3fd99-0a6f-4271-bef2-e80eeafdf357" x="0" y="0" width="20"
                            height="20" patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" class="text-gray-200"
                                fill="currentColor" />
                        </pattern>
                    </defs>
                    <rect width="404" height="384" fill="url(#74b3fd99-0a6f-4271-bef2-e80eeafdf357)" />
                </svg>
                <svg class="absolute top-1/2 right-full transform -translate-y-1/2 -translate-x-32" width="404"
                    height="384" fill="none" viewBox="0 0 404 384">
                    <defs>
                        <pattern id="f210dbf6-a58d-4871-961e-36d5016a0f49" x="0" y="0" width="20"
                            height="20" patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" class="text-gray-200"
                                fill="currentColor" />
                        </pattern>
                    </defs>
                    <rect width="404" height="384" fill="url(#f210dbf6-a58d-4871-961e-36d5016a0f49)" />
                </svg>
                <svg class="absolute bottom-12 left-full transform translate-x-32" width="404" height="384"
                    fill="none" viewBox="0 0 404 384">
                    <defs>
                        <pattern id="d3eb07ae-5182-43e6-857d-35c643af9034" x="0" y="0" width="20"
                            height="20" patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" class="text-gray-200"
                                fill="currentColor" />
                        </pattern>
                    </defs>
                    <rect width="404" height="384" fill="url(#d3eb07ae-5182-43e6-857d-35c643af9034)" />
                </svg>
            </div>
        </div>
        <div class="row my-10 z-10">
            <div class="mx-4 my-10 bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
                <div class="divide-y">
                    <!-- <div class="flex items-center justify-center text-center px-4 py-4 w-full">
                        <div class="text-md font-small uppercase text-gray-700 ">
                           Daftar Sebaran Alumni Angkatan 2022
                        </div>
                    </div> -->
                    <div class="rounded-b flex flex-col px-4 py-4">
                        <livewire:dash.alumni-index.table/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="max-w-prose mx-auto">
            <div id="disqus_thread"></div>
        </div>
    </div>
@endsection

@push('script')
    {{-- Disqus Api's --}}
    <script>
 
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document,
                s = d.createElement('script');
            s.src = 'https://nfbs-serang.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
            Disqus.</a></noscript>
@endpush




<div>
    <div id="fasilitas-slider" class="splide" aria-label="Fasilitas Images">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($facility->subfacilities as $slide)
                    <li class="splide__slide">
                        <img src="{{ $slide->image_url }}" alt="Fasilitas NFBS Serang">
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var splide = new Splide('#fasilitas-slider', {
                    type: 'fade',
                    rewind: true,
                    autoplay: true,
                });

                splide.mount();
            });
        </script>
    @endpush
</div>

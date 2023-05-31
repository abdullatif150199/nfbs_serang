<div>
    <section class="relative mt-24 h-auto w-full">
        <div id="image-slider" class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($sliders as $item)
                        <li class="splide__slide">
                            <a href="{{ $item->url }}">
                                <img src="{{ asset($item->image_url) }}" class="object-contain w-full" alt="Slideshow">
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
</div>

@extends('layouts.web')

@section('meta')
    <!-- meta social media facebook -->
    <meta name="author" content="NFBS">
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="nfbs.or.id" />
    <meta property="article:publisher" content="https://www.facebook.com/nurulfikriserangbanten" />
    <meta property="og:title" content="NFBS Serang - Cerdas, Sholeh dan Muslih" />
    <meta property="og:description"
        content="Sekolah terbaik, sekolah berasrama yang mengintegrasikan program pendidikan ilmu agama Islam dan ilmu umum" />
    <meta property="og:image" content="{{ url('/img/logo.png') }}" />
    <meta property="og:image:width" content="700" />
    <meta property="og:image:height" content="350" />
    <meta property="revisit-after" content="7" />
    <meta property="webcrawlers" content="all" />
    <meta property="rating" content="general" />
    <meta property="spiders" content="all" />
    <meta property="robots" content="all" />
@endsection

@section('content')
    <!-- Slide show -->
    <x-partials.slide-show />

    <!-- CTA -->
    <x-partials.cta />

    <!-- About Us -->
    <x-partials.about-us />

    <!-- Artikel -->
    <livewire:web.posts />

    <!-- Achievement -->
    <x-partials.achievement />

    <!-- Program -->
    <x-partials.program />

    <!-- Facility -->
    <x-partials.facility />

    <!-- Alumni -->
    <x-partials.alumni />

    <!-- Testimonial -->
    {{-- <x-partials.testimonial /> --}}
@endsection

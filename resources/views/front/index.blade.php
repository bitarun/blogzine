@extends('layouts.front.master')

@section('content')

    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- =======================
        Main hero START -->

        {{--@include('front.partials.index.trending-navbar')--}}
        @include('front.partials.index.trending-news-slider')
        @include('front.partials.index.top-news')
        @include('front.partials.index.videos-news')
        @include('front.partials.index.category-news')
        @include('front.partials.index.editor-news')

        <!-- =======================
        Section END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->

@endsection

@extends('layouts.front.master')

@section('content')

    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <script>
            const categoryEnName = @json($category->en_name);
        </script>

        <!-- =======================
        Inner intro START -->
        <section class="pt-4 pb-3">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-dots">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}"><i
                                            class="bi bi-house me-1"></i>
                                        خانه</a></li>
                                <li class="breadcrumb-item active">شبکه ای نسخه 4</li>
                            </ol>
                        </nav>
                        <h1>اخبار با فیلتر دسته بندی {{ $category->name }}</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================
        Inner intro END -->

        <!-- =======================
        Main content START -->
        <section class="position-relative pt-0">
            <div class="container">
                <!-- Nav Filters -->
                {{--<div class="row">
                    <div class="col-12">
                        <div class="grid-menu" data-target=".filter-container">
                            <ul class="nav nav-pills justify-content-start mb-3">
                                <li class="nav-item"><span class="nav-link disabled ps-0">فیلتر: </span></li>
                                <li class="nav-item"><a data-filter="*" class="nav-link active">همه</a></li>
                                <li class="nav-item"><a data-filter=".travel-category" class="nav-link">گردشگری</a></li>
                                <li class="nav-item"><a data-filter=".covid-category" class="nav-link">کووید</a></li>
                                <li class="nav-item"><a data-filter=".photo-category" class="nav-link">عکاسی</a></li>
                                <li class="nav-item"><a data-filter=".business-category" class="nav-link">کسب و کار</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>--}}
                <div class="row filter-container overflow-hidden" id="article-container"
                     data-isotope='{"layoutMode": "masonry"}'>
                    <!-- Card item START -->

                    @forelse($articles as $article)

                        <div class="col-sm-6 col-lg-4 grid-item business-category">
                            <div class="card mb-4">
                                <!-- Card img -->
                                <div class="card-fold position-relative">
                                    <img class="card-img" src="{{ largeThumbnail($article->lg_thumb) }}"
                                         alt="Card image">
                                </div>
                                <div class="card-body px-0 pt-3">
                                    <h4 class="card-title"><a href="#" class="btn-link text-reset">
                                            {{ $article->title }}
                                        </a></h4>
                                    <p class="card-text">{{ $article->description }}</p>
                                    <!-- Card info -->
                                    <ul class="nav nav-divider align-items-center text-uppercase small">
                                        <li class="nav-item">
                                            <a href="#"
                                               class="nav-link text-reset btn-link">{{ $article->author->name }}</a>
                                        </li>
                                        <li class="nav-item">{{ jalaliDateFormatA($article->created_at) }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    @empty
                    @endforelse

                    <!-- Card item END -->
                </div> <!-- Row end -->

                <div class="col-12 text-center mt-5">

                    <div id="loading" class="d-none">
                        <i class="fas fa-spinner fa-spin"></i>
                        <span>در حال بارگزاری ... </span>
                    </div>

                </div>

            </div>
        </section>
        <!-- =======================
        Main content END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->

@endsection

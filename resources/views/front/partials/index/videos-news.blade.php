<section class="my-4 pb-0 card-grid">

    <div class="container">
        <div class="d-flex justify-content-between align-items-baseline mb-4">
            <p class="fw-bold mb-3 fs-5 position-relative news-section-title">جدیدترین <span
                    class="fw-normal fs-6">ویدیو ها </span>
            </p>
            <div class="border-bottom border-primary border-2 opacity-1" style="width: 75%;"></div>
        </div>
        <div class="row g-4">
            <!-- Left big card -->
            <div class="col-lg-6">
                <div class="card card-overlay-bottom  card-bg-scale">
                    <img class="img-fluid h-100" src="{{ mediumThumbnail($videoArticles['first']->md_thumb) }}" alt="">
                    <!-- Card featured -->
                    <span class="card-featured" title=""><i class="fas fa-star"></i></span>
                    <!-- Card Image overlay -->
                    <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                        <div class="w-100 mt-auto">
                            <!-- Card categories -->
                            <a href="#" class="badge text-bg-danger mb-2"><i
                                    class="fas fa-circle me-2 small fw-bold"></i>{{ $videoArticles['first']->category->name }}
                            </a>
                            <!-- Card title -->
                            <h2 class="text-white h1"><a
                                    href="{{ route('article.show', [$videoArticles['first']->category, $videoArticles['first']]) }}"
                                    class="btn-link stretched-link text-reset">
                                    {{ $videoArticles['first']->title }}</a></h2>
                            <p class="text-white">{{ excerpt($videoArticles['first']->description, 150) }}</p>
                            <!-- Card info -->
                            <ul class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
                                <li class="nav-item">
                                    <div class="nav-link">
                                        <div class="d-flex align-items-center text-white position-relative">
                                            <div class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle"
                                                     src="{{ getAvatarImage($videoArticles['first']->author->profile->avatar_image) }}"
                                                     alt="avatar">
                                            </div>
                                            <span class="ms-3"> <a href="#"
                                                                   class="stretched-link text-reset btn-link">
                                                    {{ $videoArticles['first']->author->name }}</a></span>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">{{ jalaliDateFormatA($videoArticles['first']->created_at) }}</li>
                                <li class="nav-item">5 دقیقه زمان مطالعه</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right small cards -->
            <div class="col-lg-6">
                <div class="row g-4">
                    <!-- Card item START -->
                    <div class="col-12">
                        <div class="card card-overlay-bottom card-grid-sm card-bg-scale"
                             style="background-image:url({{ largeThumbnail($videoArticles['second']->lg_thumb) }}); background-position: center left; background-size: cover;">
                            <!-- Card Image -->
                            <!-- Card Image overlay -->
                            <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                                <div class="w-100 mt-auto">
                                    <!-- Card categories -->
                                    <a href="#" class="badge text-bg-warning mb-2"><i
                                            class="fas fa-circle me-2 small fw-bold"></i>
                                        {{ $videoArticles['second']->category->name }}
                                    </a>
                                    <!-- Card title -->
                                    <h4 class="text-white"><a
                                            href="{{ route('article.show', [$videoArticles['second']->category, $videoArticles['second']]) }}"
                                            class="btn-link stretched-link text-reset">
                                            {{ $videoArticles['second']->title }}</a></h4>
                                    <!-- Card info -->
                                    <ul
                                        class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
                                        <li class="nav-item position-relative">
                                            <div class="nav-link"><a href="#"
                                                                     class="stretched-link text-reset btn-link">
                                                    {{ $videoArticles['second']->author->name }}</a>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            {{ jalaliDateFormatA($videoArticles['second']->created_at) }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card item END -->
                    <!-- Card item START -->

                    @forelse($videoArticles['others'] as $elseArticle)

                        <div class="col-md-6">
                            <div class="card card-overlay-bottom card-grid-sm card-bg-scale"
                                 style="background-image:url({{ mediumThumbnail($elseArticle->md_thumb) }}); background-position: center left; background-size: cover;">
                                <!-- Card Image overlay -->
                                <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                                    <div class="w-100 mt-auto">
                                        <!-- Card categories -->
                                        <a href="#" class="badge text-bg-success mb-2"><i
                                                class="fas fa-circle me-2 small fw-bold"></i>{{ $elseArticle->category->name }}
                                        </a>
                                        <!-- Card title -->
                                        <h4 class="text-white"><a
                                                href="{{ route('article.show', [$elseArticle->category, $elseArticle]) }}"
                                                class="btn-link stretched-link text-reset">
                                                {{ excerpt($elseArticle->title, 20) }}</a></h4>
                                        <!-- Card info -->
                                        <ul
                                            class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
                                            <li class="nav-item position-relative">
                                                <div class="nav-link"><a href="#"
                                                                         class="stretched-link text-reset btn-link">
                                                        {{ $elseArticle->author->name }}</a>
                                                </div>
                                            </li>
                                            <li class="nav-item">{{ jalaliDateFormatA($elseArticle->created_at) }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                    @endforelse
                    <!-- Card item END -->
                </div>
            </div>
        </div>
    </div>
</section>

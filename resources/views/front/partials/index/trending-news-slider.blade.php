<section class="pt-4 pb-0 card-grid ">
    <div class="container pe-0">
        <p class="fw-bold mb-4">اخبار روز</p>
        <div class="swiper" dir="rtl">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->

                @forelse($trendingArticles as $article)

                    <div class="swiper-slide">
                        <div class="card card-overlay-bottom card-grid-lg card-bg-scale">
                            <img class="img-fluid" src="{{ largeThumbnail($article->lg_thumb) }}" alt="">
                            <!-- Card featured -->
                            <!-- <span class="card-featured" title=""><i class="fas fa-star"></i></span> -->
                            <!-- Card Image overlay -->
                            <div class="card-img-overlay">
                                <div class="w-100 h-100 position-relative">
                                    <!-- Publish Date -->
                                    <span class="position-absolute start-0 badge text-bg-light"><i
                                            class="bi bi-calendar-check me-2"></i>{{ jalaliDateFormatA($article->created_at) }}</span>
                                    <!-- Card categories -->
                                    <a href="{{ route('archive', $article->category) }}" class="badge text-bg-success mb-2 position-absolute end-0 "><i
                                            class="fas fa-circle me-2 small fw-bold"></i>{{ $article->category->name }}
                                    </a>
                                    <!-- Card title -->
                                    <!-- Author -->
                                    <div class="text-white position-absolute" style="bottom: 57px;right: 13px;">
                                        <div class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle"
                                                 src="{{ getAvatarImage($article->author->profile->avatar_image) }}" alt="avatar">
                                        </div>
                                        <span class="ms-1"><a href="#"
                                                              class="stretched-link text-reset btn-link">{{ $article->author->name }}</a></span>
                                    </div>
                                    <h2 class="w-100 rounded px-3 py-3 slider-topic-title position-absolute bottom-0">
                                        <a class="text-white"
                                            href="{{ route('article.show', [$article->category, $article]) }}" class="">{{ $article->title }}
                                        </a></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty

                    <div class="alert alert-info">مقاله ای ثبت نشده‌است!</div>

                @endforelse

            </div>
            <!-- If we need pagination -->
            <!-- <div class="swiper-pagination"></div> -->

            <!-- If we need navigation buttons -->
            <!-- <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div> -->
        </div>
    </div>
</section>

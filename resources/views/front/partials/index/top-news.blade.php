<section class="my-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-baseline mb-4">
            <p class="fw-bold mb-3 fs-5 position-relative news-section-title">دسته بندی <span
                    class="fw-normal fs-6">خبرها
					</span>
            </p>
            <div class="border-bottom border-primary border-2 opacity-1" style="width: 75%;">

            </div>
        </div>
        <div class="container">
            <div class="col-12">
                <div class="swiper-cats" dir="rtl" style="height: 50px;">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @forelse($categories as $category)
                            <div class="swiper-slide">
                                <a href="{{ route('archive', $category) }}" class=" py-3 px-1 d-block btn btn-light"
                                   style="border-radius:.7rem;">{{ $category->name }}</a>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="my-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-baseline mb-4">
            <p class="fw-bold mb-3 fs-5 position-relative news-section-title">داغ ترین <span
                    class="fw-normal fs-6">خبرها
				</span>
            </p>
            <div class="border-bottom border-primary border-2 opacity-1" style="width: 75%;">

            </div>
        </div>
        <div class="row">
            <!-- Recent post widget START -->
            <!-- Recent post item -->
            @forelse($topArticles as $article)
                <div class="col-md-6 card mb-3">
                    <div class="d-flex p-3"
                         style="box-shadow: 0px 5px 20px 0px rgba(69, 67, 96, 0.1);border-radius: .7rem;">
                        <img class="rounded w-25" src="{{ smallThumbnail($article->sm_thumb) }}" alt="">
                        <div class="d-flex flex-column justify-content-center ms-4">
                            <h6>
                                <a href="{{ route('article.show', [$article->category, $article]) }}" class="">{{ $article->title }}</a>
                            </h6>
                            <div class="small mt-1">{{ jalaliDateFormatA($article->created_at) }}</div>
                        </div>
                    </div>

                </div>
            @empty
            @endforelse
        </div>
        <!-- Recent post widget END -->


    </div>
    </div>
</section>

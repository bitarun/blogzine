<section class="my-4 pb-0 card-grid ">
    <div class="container pe-0">
        <div class="d-flex justify-content-between align-items-baseline">
            <p class="fw-bold mb-3 fs-5 position-relative news-section-title">اخبار <span
                    class="fw-normal fs-6">تکنولوژی</span></p>
            <div class="border-bottom border-primary border-2 opacity-1" style="width: 75%;"></div>
        </div>
        <div class="swiper" dir="rtl">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper p-3">
                <!-- Slides -->

                @forelse($techArticles as $article)

                    <div class="swiper-slide py-5" style="height: 100%;">
                        <div class="card bg-lights p-4 d-flex flex-column"
                             style="height: 100%; box-shadow: 0px 5px 20px 0px rgba(69, 67, 96, 0.1);">

                            <!-- Card img -->
                            <div class="position-relative">
                                <img class="card-img"
                                     style="margin-top:-60px; height:220px; object-fit:cover;"
                                     src="{{ largeThumbnail($article->lg_thumb) }}" alt="Card image">

                                <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                    <div class="w-100 mt-auto">
                                        <a href="#" class="badge text-bg-warning mb-2">
                                            <i class="fas fa-circle me-2 small fw-bold"></i>{{ $article->category->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Card body -->
                            <div class="card-body px-0 pt-3 d-flex flex-column" style="flex:1;">
                                <a href="#!" class="mb-0 text-body small">
                                    <i class="bi bi-info-circle ps-1"></i> ویژه
                                </a>

                                <h4 class="card-title mt-2">
                                    <a href="{{ route('article.show', [$article->category, $article]) }}" class="btn-link text-reset">
                                        {{ $article->title }}
                                    </a>
                                </h4>

                                <p class="card-text" style="flex:1;">
                                    {{ $article->description }}
                                </p>

                                <!-- Card info (چسبیده به پایین) -->
                                <ul class="nav nav-divider align-items-center mt-auto d-none d-sm-inline-block">
                                    <li class="nav-item">
                                        <div class="nav-link">
                                            <div class="d-flex align-items-center position-relative">
                                                <div class="avatar avatar-xs">
                                                    <img class="avatar-img rounded-circle"
                                                         src="{{ getAvatarImage($article->author->profile->avatar_image) }}"
                                                         alt="avatar">
                                                </div>
                                                <span class="ms-3">
                                <a href="#" class="stretched-link text-reset btn-link">
                                    {{ $article->author->name }}
                                </a>
                            </span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item">{{ jalaliDateFormatA($article->created_at) }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                @empty
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

<section class="my-4 pb-0 card-grid ">
    <div class="container pe-0">
        <div class="d-flex justify-content-between align-items-baseline">
            <p class="fw-bold mb-3 fs-5 position-relative news-section-title">اخبار <span
                    class="fw-normal fs-6">ورزشی</span></p>
            <div class="border-bottom border-primary border-2 opacity-1" style="width: 75%;"></div>
        </div>
        <div class="swiper" dir="rtl">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper p-3">
                <!-- Slides -->

                @forelse($sportsArticles as $article)

                <div class="swiper-slide py-5" style="height: 100%;">
                    <div class="card bg-lights p-4 d-flex flex-column" style="height: 100%; box-shadow: 0px 5px 20px 0px rgba(69, 67, 96, 0.1);">
                        <!-- Card img -->
                        <div class="position-relative">
                            <img class="card-img" style="margin-top: -60px; height: 220px; object-fit: cover;"
                                 src="{{ largeThumbnail($article->lg_thumb) }}"
                                 alt="Card image">
                            <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                <!-- Card overlay bottom -->
                                <div class="w-100 mt-auto">
                                    <!-- Card categories -->
                                    <a href="#" class="badge text-bg-warning mb-2"><i
                                            class="fas fa-circle me-2 small fw-bold"></i>{{ $article->category->name }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-3">
                            <!-- Sponsored Post -->
                            <a href="#!" class="mb-0 text-body small" tabindex="0" role="button"
                               data-bs-container="body" data-bs-toggle="popover" data-bs-trigger="focus"
                               data-bs-placement="top"
                               data-bs-content="شما این تبلیغ را می بینید زیرا فعالیت شما با مخاطبان مورد نظر سایت ما مطابقت دارد.">
                                <i class="bi bi-info-circle ps-1"></i> ویژه
                            </a>
                            <h4 class="card-title mt-2">
                                <a href="{{ route('article.show', [$article->category, $article]) }}" class="btn-link text-reset">{{ $article->title }}</a>
                            </h4>
                            <p class="card-text">{{ $article->description }}</p>
                            <!-- Card info -->
                            <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                                <li class="nav-item">
                                    <div class="nav-link">
                                        <div class="d-flex align-items-center position-relative">
                                            <div class="avatar avatar-xs">
                                                <img class="avatar-img rounded-circle"
                                                     src="{{ getAvatarImage($article->author->profile->avatar_image) }}"
                                                     alt="avatar">
                                            </div>
                                            <span class="ms-3"><a href="#"
                                                                  class="stretched-link text-reset btn-link">
                                                    {{ $article->author->name }}
                                                </a></span>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">{{ jalaliDateFormatA($article->created_at) }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                @empty
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

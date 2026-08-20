<section class="my-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Title -->
                <div class="mb-4 d-flex justify-content-between align-items-baseline">

                    <p class="fw-bold mb-3 fs-5 position-relative news-section-title">مقالات <span
                            class="fw-normal fs-6">گروه مدیریت</span></p>
                    <div class="border-bottom border-primary border-2 opacity-1" style="width: 75%;"></div>

                    <!-- <a href="#" class="text-body small"><u>مشاهده همه</u></a> -->
                </div>
                <div class="tiny-slider arrow-hover arrow-blur arrow-dark arrow-round">
                    <div class="tiny-slider-inner" style="float: left;"
                         data-autoplay="true"
                         data-hoverpause="true"
                         data-gutter="24"
                         data-arrow="true"
                         data-dots="false"
                         data-items-xl="4"
                         data-items-md="3"
                         data-items-sm="2"
                         data-items-xs="1">

                        <!-- Card item START -->

                        @forelse($editorArticles as $article)

                            <div class="card">
                                <!-- Card img -->
                                <div class="position-relative">
                                    <img
                                        class="card-img"
                                        src="{{ smallThumbnail($article->sm_thumb) }}"
                                        alt="Card image"
                                        style="width:100%; height:220px; object-fit:cover;">
                                    <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                        <!-- Card overlay bottom -->
                                        <div class="w-100 mt-auto">
                                            <a href="#" class="badge text-bg-info mb-2"><i
                                                    class="fas fa-circle me-2 small fw-bold"></i>{{ $article->category->name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 pt-3">
                                    <h5 class="card-title"><a href="{{ route('article.show', [$article->category, $article]) }}" class="btn-link text-reset">
                                            {{ $article->title }}
                                        </a></h5>
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

                        @empty
                        @endforelse

                        <!-- Card item END -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

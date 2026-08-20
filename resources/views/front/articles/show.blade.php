@extends('layouts.front.master')

@section('content')

    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- =======================
        Inner intro START -->
        <section class="pt-2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-dark-overlay-5 overflow-hidden card-bg-scale h-400 text-center"
                             style="background-image:url({{ largeThumbnail($article->lg_thumb) }}); background-position: center left; background-size: cover;">
                            <!-- Card Image overlay -->
                            <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                                <div class="w-100 my-auto">
                                    <!-- Card categories -->
                                    <a href="{{ route('archive', $article->category) }}"
                                       class="badge text-bg-danger mb-2"><i
                                            class="fas fa-circle me-2 small fw-bold"></i>{{ $article->category->name }}
                                    </a>
                                    <!-- Card title -->
                                    <h2 class="text-white display-5">{{ $article->title }}</h2>
                                    <!-- Card info -->
                                    <ul class="nav nav-divider text-white-force align-items-center justify-content-center">
                                        <li class="nav-item">
                                            <div class="nav-link">
                                                <div class="d-flex align-items-center text-white position-relative">
                                                    <div class="avatar avatar-sm">
                                                        <img class="avatar-img rounded-circle"
                                                             src="{{ getAvatarImage($article->author->profile->avatar_image) }}"
                                                             alt="avatar">
                                                    </div>
                                                    <span class="ms-3"> <a href="#"
                                                                           class="stretched-link text-reset btn-link">{{ $article->author->name }}</a></span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nav-item">{{ jalaliDateFormatA($article->created_at) }}</li>
                                        <li class="nav-item">5 دقیقه زمان مطالعه</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================
        Inner intro END -->

        <!-- =======================
        Main START -->
        <section class="pt-0">
            <div class="container position-relative" data-sticky-container>
                <div class="row">
                    <!-- Main Content START -->
                    <div class="col-lg-9 mb-5 single-content">
                        <!-- Author info START -->

                        {!! $article->body !!}

                        <div class="d-flex p-2 p-md-4 my-3 bg-primary bg-opacity-10 rounded">
                            <!-- Avatar -->
                            <a href="#">
                                <div class="avatar avatar-xxl me-2 me-md-4">
                                    <img class="rounded-circle"
                                         src="{{ getAvatarImage($article->author->profile->avatar_image) }}"
                                         alt="avatar">
                                </div>
                            </a>
                            <!-- Info -->
                            <div>
                                <div class="d-sm-flex align-items-center justify-content-between">
                                    <div>
                                        <h4 class="m-0"><a href="#" class="text-reset">{{ $article->author->name }}</a>
                                        </h4></div>
                                    <a href="#" class="btn btn-xs btn-primary-soft">مشاهده اخبار</a>
                                </div>
                                <p class="my-2">{{ $article->author->profile->bio }}</p>
                                <!-- Social icons -->
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link ps-0 pe-2 fs-5"
                                           href="{{ $article->author->profile->social_links['linkedin'] }}">
                                            <i class="fab fa-linkedin"></i></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-2 fs-5"
                                           href="{{ $article->author->profile->social_links['telegram'] }}">
                                            <i class="fab fa-telegram-plane"></i></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-2 fs-5"
                                           href="{{ $article->author->profile->social_links['instagram'] }}">
                                            <i class="fab fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Author info END -->

                        <!-- Comments START -->
                        <div class="mt-5">
                            <h3>{{ $article->comments_count }} دیدگاه</h3>
                            <!-- Comment level 1-->

                            @forelse($comments as $comment)
                                @include('front.partials.comment', ['comment' => $comment, 'level' => 0])
                            @empty
                                <div class="alert alert-warning">تاکنون نظری برای این مقاله ثبت نشده‌است.</div>
                            @endforelse

                            <div class="d-sm-flex justify-content-sm-between align-items-sm-center mt-4 mt-sm-3">
                                <!-- Content -->
                                <div>{{ $comments->links('pagination::tailwind') }}</div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    document.querySelectorAll('.reply-toggle').forEach(button => {
                                        button.addEventListener('click', function () {
                                            const commentId = this.dataset.commentId;
                                            const form = document.getElementById('reply-form-' + commentId);

                                            if (!form) return;

                                            form.classList.toggle('d-none');
                                        });
                                    });
                                });
                            </script>

                        </div>
                        <!-- Comments END -->
                        <!-- Reply START -->
                        <div>
                            <h3>ثبت دیدگاه</h3>
                            <form method="POST" action="{{ route('comment.store', $article) }}#commentFormSection"
                                  class="row g-3 mt-2 bg-light p-3 rounded">
                                @csrf
                                <div class="col-12">
                                    <label class="form-label">متن دیدگاه</label>
                                    <textarea name="body" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">ثبت</button>
                                </div>
                            </form>
                        </div>
                        <!-- Reply END -->
                    </div>
                    <!-- Main Content END -->

                    <!-- Right sidebar START -->
                    <div class="col-lg-3">
                        <div data-sticky data-margin-top="80" data-sticky-for="991">
                            <!-- Categories -->
                            <div class="row g-2">

                                @php
                                    $colors = ['warning', 'primary', 'danger', 'info', 'success'];
                                @endphp

                                <h5>دسته بندی ها</h5>
                                @foreach($categories as $category)
                                    @php
                                        $color = $colors[$category->id % count($colors)];
                                    @endphp
                                    <div
                                        class="d-flex justify-content-between align-items-center bg-{{ $color }} bg-opacity-15 rounded p-2 position-relative">
                                        <h6 class="m-0">{{ $category->name }}</h6>
                                        <a href="{{ route('archive', $category) }}"
                                           class="badge bg-{{ $color }} text-dark stretched-link">{{ $category->articles_count }}</a>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Advertisement -->
                            <div class="mt-4">
                                <a href="#" class="d-block card-img-flash">
                                    <img src="{{ Vite::image('adv.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Right sidebar END -->
                </div>
            </div>
        </section>
        <!-- =======================
        Main END -->

        <!-- =======================
        Sticky post START -->
        <div class="sticky-post bg-light border p-4 mb-5 text-sm-end rounded d-none d-xxl-block">
            <div class="d-flex align-items-center">
                <!-- image -->
                <div class="col-4 d-none d-md-block">
                    <img src="{{ Vite::image('blog/4by3/05.jpg') }}" alt="Image">
                </div>
                <!-- Title -->
                <div class="ms-3 text-start">
                    <span>خبر بعدی<i class="bi bi-arrow-right ms-3 rtl-flip"></i></span>
                    <h6 class="m-0"><a href="javascript:void(0)" class="stretched-link btn-link text-reset">تداوم تنفس
                            هوای
                            ناسالم در تهران</a></h6>
                </div>
            </div>
        </div>
        <!-- =======================
        Sticky post END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->

@endsection

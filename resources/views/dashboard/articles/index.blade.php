@extends('layouts.dashboard.master')

@section('content')
    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- =======================
        Post list START -->
        <section class="py-4">
            <div class="container">
                <div class="row pb-4">
                    <div class="col-12">
                        <!-- Title -->
                        <div class="d-sm-flex justify-content-sm-between align-items-center">
                            <h1 class="mb-2 mb-sm-0 h3">لیست اخبار <span
                                    class="badge bg-primary bg-opacity-10 text-primary">{{ $count }}</span></h1>
                            <a href="{{ route('article.create') }}" class="btn btn-sm btn-primary mb-0"><i
                                    class="fas fa-plus me-2"></i>ثبت خبر جدید</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row g-4 mb-4">
                            <div class="col-sm-12 col-lg-6">
                                <!-- Card START -->
                                <div class="card card-body border h-100">
                                    <!-- Icon -->
                                    <div class="fs-3 text-start text-success">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <!-- Content -->
                                    <div class="ms-0">
                                        <h3 class="mb-0">{{ $countByType['text'] }}</h3>
                                        <h6 class="mb-0">فایل متنی</h6>
                                    </div>
                                </div>
                                <!-- Card END -->
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <!-- Card START -->
                                <div class="card card-body border h-100">
                                    <!-- Icon -->
                                    <div class="fs-3 text-start text-success">
                                        <i class="bi bi-camera-reels"></i>
                                    </div>
                                    <!-- Content -->
                                    <div class="ms-0">
                                        <h3 class="mb-0">{{ $countByType['multimedia'] }}</h3>
                                        <h6 class="mb-0">چندرسانه ای</h6>
                                    </div>
                                </div>
                                <!-- Card END -->
                            </div>
                        </div>
                        <!-- Post list table START -->
                        <div class="card border bg-transparent rounded-3">

                            <!-- Card body START -->
                            <div class="card-body p-3">

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <il>{{ $error }}</il>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Search and select START -->
                                <div class="row g-3 align-items-center justify-content-between mb-3">
                                    <!-- Search -->
                                    <div class="col-md-8">
                                        <form method="GET" action="" class="rounded position-relative">
                                            <input class="form-control pe-5 bg-transparent" type="search"
                                                   name="search" value="{{ request('search') }}"
                                                   placeholder="جستجو" aria-label="Search">
                                            <button
                                                class="btn bg-transparent border-0 px-2 py-0 position-absolute top-50 end-0 translate-middle-y"
                                                type="submit"><i class="fas fa-search fs-6 "></i></button>
                                        </form>
                                    </div>

                                    <!-- Select option -->
                                    <div class="col-md-3">
                                        <!-- Short by filter -->
                                        <form method="get" action="{{ route('article.index') }}">
                                            <select name="sort" onchange="this.form.submit()"
                                                    class="form-select z-index-9 bg-transparent"
                                                    aria-label=".form-select-sm">
                                                <option
                                                    value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                                                    جدیدترین
                                                </option>
                                                <option
                                                    value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                                    قدیمی ترین
                                                </option>
                                                <option
                                                    value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>
                                                    محبوب ترین
                                                </option>
                                            </select>

                                        </form>
                                    </div>
                                </div>
                                <!-- Search and select END -->

                                <!-- Post list table START -->
                                <div class="table-responsive border-0">
                                    <table class="table align-middle p-4 mb-0 table-hover table-shrink">
                                        <!-- Table head -->
                                        <thead class="table-dark">
                                        <tr>
                                            <th scope="col" class="border-0 rounded-start">شناسه</th>
                                            <th scope="col" class="border-0">عنوان خبر</th>
                                            <th scope="col" class="border-0">نام نویسنده</th>
                                            <th scope="col" class="border-0">تاریخ انتشار</th>
                                            <th scope="col" class="border-0">دسته بندی</th>
                                            <th scope="col" class="border-0">وضعیت</th>
                                            <th scope="col" class="border-0">لایک</th>
                                            <th scope="col" class="border-0 rounded-end">فعالیت</th>
                                        </tr>
                                        </thead>

                                        @if($articles->isEmpty())
                                            <div class="alert alert-info">
                                                تاکنون مقاله‌ای منتشر نشده‌است! از طریق دکمه‌ی ثبت خبر جدید، اولین مقاله
                                                را ایجاد کنید.
                                            </div>
                                        @else
                                            <!-- Table body START -->
                                            <tbody class="border-top-0">
                                            @foreach($articles as $article)
                                                <!-- Table item -->
                                                <tr>
                                                    <!-- Table data -->
                                                    <td>
                                                        <div class="d-flex">
                                                            <h6 class="course-title mt-2 mt-md-0 mb-0"><a
                                                                    href="#">{{ $article->id }}</a></h6>
                                                            {!! $article->status == 'pending' ? '<div class="spinner-grow spinner-grow-sm text-warning"
                                                                     role="status"></div>' : '' !!}

                                                        </div>
                                                    </td>
                                                    <!-- Table data -->
                                                    <td>
                                                        <h6 class="course-title mt-2 mt-md-0 mb-0"><a
                                                                href="#">{{ $article->title }}</a></h6>
                                                    </td>
                                                    <!-- Table data -->
                                                    <td>
                                                        <h6 class="mb-0"><a
                                                                href="#">{{ $article->author->name ?: 'ناشناس' }}</a>
                                                        </h6>
                                                    </td>
                                                    <!-- Table data -->
                                                    <td>{{ Verta::instance($article->created_at)->format('j F، Y') }}</td>
                                                    <!-- Table data -->
                                                    <td>
                                                        <a href="#" class="badge text-bg-warning mb-2"><i
                                                                class="fas fa-circle me-2 small fw-bold"></i>{{ $article->category->name }}
                                                        </a>
                                                    </td>
                                                    <!-- Table data -->
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="article-status-icon form-check-input"
                                                                   type="checkbox"
                                                                   {{ $article->status == 'published' ? 'checked' : '' }}
                                                                   data-id="{{ $article->id }}">
                                                        </div>
                                                        {{--<span
                                                            class="badge bg-success bg-opacity-10 text-success mb-2">فعال</span>--}}
                                                    </td>
                                                    <!-- Table data -->
                                                    <td>
                                                        <span class="badge bg-danger mb-2">{{ $article->likes }}</span>
                                                    </td>
                                                    <!-- Table data -->
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="#"
                                                               class="delete-article-icon btn btn-light btn-round mb-0"
                                                               data-id="{{ $article->id }}" data-bs-toggle="tooltip"
                                                               data-bs-placement="top"
                                                               title="حذف"><i
                                                                    class="bi bi-trash"></i>
                                                                <div
                                                                    class="spinner-border spinner-border-sm text-info d-none"
                                                                    role="status"></div>
                                                            </a>
                                                            <a href="{{ route('article.edit', $article) }}"
                                                               class="btn btn-light btn-round mb-0"
                                                               data-bs-toggle="tooltip"
                                                               data-bs-placement="top" title="ویرایش"><i
                                                                    class="bi bi-pencil-square"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- Table body END -->
                                            @endforeach
                                    </table>
                                    @endif
                                </div>
                                <!-- Post list table END -->

                                <!-- Pagination START -->
                                <div class="d-sm-flex justify-content-sm-between align-items-sm-center mt-4 mt-sm-3">
                                    <!-- Content -->
                                    <div>{{ $articles->links('pagination::tailwind') }}</div>
                                </div>
                                <!-- Pagination END -->
                            </div>
                        </div>
                        <!-- Post list table END -->
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================
        Main contain END -->
    </main>

    <!-- **************** MAIN CONTENT END **************** -->
@endsection

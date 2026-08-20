@extends('layouts.dashboard.master')
@section('content')
    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <section class="py-4">
            <div class="container">
                <div class="row pb-4">
                    <div class="col-12">
                        <!-- Title -->
                        <h1 class="mb-0 h3">{{ 'ویرایش خبر "' . $article->title . '"' }}</h1>
                    </div>
                </div>
                <div class="row">
                    <form class="row" action="{{ route('article.update', $article) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-sm-12 col-md-8">
                            <!-- Chart START -->
                            <div class="card border">
                                <!-- Card body -->
                                <div class="card-body">
                                    <!-- Form START -->

                                    <!-- Main form -->
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Post name -->
                                            <div class="mb-3">
                                                <label class="form-label">عنوان</label>
                                                <input id="con-name" name="title" type="text"
                                                       class="form-control @error('title') border-danger @enderror"
                                                       placeholder="عنوان خبر"
                                                       value="{{ old('title', $article->title) }}">
                                                @error('title')
                                                <small class="mt-2 d-inline-block text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Post type START -->
                                        @php
                                            $types = [
                                                ['en' => 'breaking', 'fa' => 'فوری', 'icon' => 'bi-chat-left-text'],
                                                ['en' => 'incidents', 'fa' => 'حوادث', 'icon' => 'bi-patch-question'],
                                                ['en' => 'multimedia', 'fa' => 'چند رسانه‌ای', 'icon' => 'bi-camera-reels'],
                                                ['en' => 'other', 'fa' => 'سایر', 'icon' => 'bi-chat-square'],
                                                ['en' => 'news', 'fa' => 'خبری', 'icon' => 'bi-chat-right-dots'],
                                                ['en' => 'text', 'fa' => 'متنی', 'icon' => 'bi-ui-checks-grid'],
                                             ];
                                        @endphp
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">نوع</label>
                                                <div class="d-flex flex-wrap gap-3">
                                                    <!-- Post type item -->
                                                    @foreach($types as $key => $type)
                                                        <div class="flex-fill">
                                                            <input type="radio" class="btn-check" name="type"
                                                                   id="option{{ $key }}"
                                                                   value="{{ $type['en'] }}" {{ $article->type == $type['en'] ? 'checked' : '' }}>
                                                            <label
                                                                class="btn btn-outline-light w-100 @error('type') border-danger @enderror"
                                                                for="option{{ $key }}">
                                                                <i class="bi {{ $type['icon'] }} fs-1"></i>
                                                                <span class="d-block">{{ $type['fa'] }}</span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @error('type')
                                            <small
                                                class="mt-2 d-inline-block text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <!-- Main toolbar -->
                                        <div class="col-md-12">
                                            <!-- Subject -->
                                            <div class="mb-3">
                                                <label class="form-label">متن خبر</label>
                                                <textarea id="newsBody"
                                                          class="form-control tinymce @error('body') border-danger @enderror"
                                                          name="body"
                                                          style="min-height: 300px">{{ old('body', $article->body) }}</textarea>
                                                @error('body')
                                                <small class="mt-2 d-inline-block text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">
                                                    چند رسانه‌ای
                                                </button>
                                                <a href="{{ route('file-manager.index') }}"
                                                   class="btn btn-sm btn-success-soft mb-0 ms-auto"><i
                                                        class="fas fa-plus me-2"></i>افزودن فایل جدید به چندرسانه‌ای</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <!-- slug -->
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label">نامک</label>
                                                    <i class="fa fa-question-circle" data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       title=" ( برای seo بهتر است عنوانی مناسب شامل کلمات کلیدی این خبر برای این مطلب انتخاب کرده و هر کلمه را با - از هم جدا نمایید )">
                                                    </i>
                                                </div>
                                                <input class="form-control @error('slug') border-danger @enderror"
                                                       name="slug" placeholder="نامک ..."
                                                       value="{{ old('slug', $article->slug) }}">
                                                @error('slug')
                                                <small class="mt-2 d-inline-block text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Short description -->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label">توضیح مختصر</label>
                                                    <i class="fa fa-question-circle" data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       title="توضیح مختصری در مورد این خبر شامل کلمات کلیدی و حداکثر شامل ۲۶۰ کارکتر بنویسید">
                                                    </i>
                                                </div>
                                                <textarea
                                                    class="form-control @error('description') border-danger @enderror"
                                                    name="description"
                                                    style="min-height: 100px"
                                                    placeholder="توضیح مختصری را درباره خبر بنویسید...">{{ old('description', $article->description) }}</textarea>
                                                @error('description')
                                                <small class="mt-2 d-inline-block text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="card border">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <!-- Image -->
                                            <div class="position-relative">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h6 class="my-2">آپلود تصویر شاخص</h6>
                                                    <i class="fa fa-question-circle" data-bs-toggle="tooltip"
                                                       data-bs-placement="top" title=" فرمت های مجاز: JPG، JPEG و PNG و ابعاد
                                                پیشنهادی ما 600px * 450px است. تصاویر بزرگتر به اندازه 4:3 برش داده می شود
                                                تا با تصاویر کوچک/پیش نمایش ما مطابقت داشته باشد.">
                                                    </i>
                                                </div>
                                                <input id="fileInput"
                                                       class="d-none"
                                                       type="file"
                                                       name="thumbnails">

                                                <label for="fileInput" class="w-100" style="cursor:pointer;">
                                                    <div class="input-group flex-row-reverse">
                                                        <input type="text" class="form-control upload-name"
                                                               {{--name="thumbnail_name"--}}
                                                               value="{{ $article->sm_thumb ?? '' }}" readonly/>
                                                        <span class="btn btn-custom">آپلود فایل</span>
                                                    </div>
                                                </label>
                                                @error('thumbnails')
                                                <small class="mt-2 d-inline-block text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <!-- Image PreView -->
                                            <img id="preview"
                                                 src="{{ $article->thumbnails ? asset('uploads/images/thumbnails/small/'.$article->thumbnails['small']) : null }}"
                                                 alt="بدون تصویر">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- Tags -->
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label">برچسب</label>
                                                <i class="fa fa-question-circle" data-bs-toggle="tooltip"
                                                   data-bs-placement="top" title="حداکثر 14 کلمه کلیدی، کلمات کلیدی باید با حروف کوچک و با کاما از هم جدا
                                                شوند. به عنوان مثال، جاوا اسکریپت، واکنش، بازاریابی">
                                                </i>
                                            </div>
                                            <textarea class="form-control @error('tags') border-danger @enderror"
                                                      name="tags" rows="1"
                                                      placeholder="ورزش، اقتصاد، ...">{{ old('tags', $article->tags) }}</textarea>
                                            @error('tags')
                                            <small class="mt-2 d-inline-block text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <!-- Message -->
                                        <div class="mb-3">
                                            <label class="form-label">دسته بندی</label>
                                            <select class="form-select @error('category_id') border-danger @enderror"
                                                    aria-label="Default select example"
                                                    name="category_id">
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}" {{ $category->id == $article->category_id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <small class="mt-2 d-inline-block text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check my-3">
                                            <input type="hidden" name="status" value="0">
                                            <input class="form-check-input" name="status" type="checkbox" value="1"
                                                   id="postCheck" {{ $article->status == 'pending' ? 'checked' : '' }}>

                                            <label class="form-check-label" for="postCheck">
                                                ارسال برای بازبینی
                                            </label>
                                            @error('status')
                                            <small class="mt-2 d-inline-block text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Create post button -->
                                    <div class="col-md-12 text-start">
                                        <button id="preview" class="btn btn-success w-100" type="submit">ذخیره</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{--Form End--}}
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">عنوان مدال</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                        </div>

                        <div class="modal-body">
                            @include('dashboard.patrials.files')
                        </div>
                    </div>
                </div>
            </div>

            <div id="notification" class="alert alert-success" role="alert">آدرس فایل کپی شد.</div>

        </section>
    </main>
    <!-- **************** MAIN CONTENT END **************** -->
@endsection

@extends('layouts.dashboard.master')

@section('content')
    <section class="py-4">
        <div class="container">
            <div class="row pb-4">
                <div class="col-12">
                    <!-- Title -->
                    <h1 class="mb-0 h3">بارگزاری فایل</h1>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('file-manager.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <div class="mb-3">
                            <!-- Image -->
                            <div class="position-relative">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="my-2">آپلود تصویر </h6>
                                    <i class="fa fa-question-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                       title=" فرمت های مجاز: JPG، JPEG و PNG و ابعاد
                                                پیشنهادی ما 600px * 450px است. تصاویر بزرگتر به اندازه 4:3 برش داده می شود
                                                تا با تصاویر کوچک/پیش نمایش ما مطابقت داشته باشد.">
                                    </i>
                                </div>

                                <input id="fileInput" class="form-control stretched-link  hidden-upload d-none"
                                       type="file" name="files[]" multiple/>

                                <label for="fileInput" class="w-100" style="cursor:pointer;">
                                    <div class="input-group flex-row-reverse">
                                        <input type="text" class="form-control upload-name"/>
                                        <span
                                            class="btn btn-custom cursor-pointer upload-button">آپلود فایل</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        @foreach($errors->all() as $error)
                            <small class="mt-2 d-inline-block text-danger">{{ $error }}</small>
                        @endforeach
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <!-- Image PreView -->
                            <div class="row" id="preview">

                            </div>

                        </div>
                    </div>

                    <input class="btn btn-success" type="submit" value="آپلود">
                </form>
            </div>


            @if($files->isNotEmpty())
                <form action="{{ route('file-manager.destroy') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="text-end">
                        <input type="submit" value="حذف" class="btn btn-danger">
                    </div>
                    @include('dashboard.patrials.files')
                </form>
            @else
                <div class="alert alert-info ">تاکنون فایلی بارگزاری نشده است.</div>
            @endif
        </div>
    </section>

    <div id="notification" class="alert alert-success" role="alert">آدرس فایل کپی شد.</div>

@endsection

@extends('layouts.front.master')

@section('content')
    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- =======================
        Inner intro START -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8 col-xl-8 mx-auto ">
                        <div class="rounded custom-box-shadow rounded p-4 p-sm-5">
                            <h2>ثبت نام در سایت </h2>
                            <!-- Form START -->
                            <form id="registerForm" method="POST" action="{{ route('register') }}" class="mt-4">
                                @csrf
                                @error('g-recaptcha-response')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <!-- Name -->
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputName1">نام و نام خانوادگی</label>
                                    <input name="name" type="text" value="{{ old('name') }}"
                                           class="form-control @error('name') border-danger @enderror"
                                           id="exampleInputName1"
                                           placeholder="نام و نام خانوادگی">
                                    @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputEmail1">ایمیل</label>
                                    <input name="email" type="email" value="{{ old('email') }}"
                                           class="form-control @error('email') border-danger @enderror"
                                           id="exampleInputEmail1"
                                           aria-describedby="emailHelp" placeholder="ایمیل">
                                    @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                    <br>
                                    <small id="emailHelp" class="form-text">ما هرگز ایمیل شما را با دیگران به اشتراک نمی
                                        گذاریم.</small>
                                </div>
                                <!-- Password -->
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputPassword1">رمز عبور</label>
                                    <input name="password" type="password"
                                           class="form-control @error('password') border-danger @enderror"
                                           id="exampleInputPassword1"
                                           placeholder="*********">
                                    @error('password')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Password -->
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputPassword2">تایید رمز عبور</label>
                                    <input name="password_confirmation" type="password" class="form-control"
                                           id="exampleInputPassword2"
                                           placeholder="*********">
                                </div>
                                <!-- Checkbox -->
                                <div class="mb-3 form-check">
                                    <input type="checkbox" name="subscribe" class="form-check-input" id="subscribe">
                                    <label class="form-check-label" for="subscribe">عضویت در خبرنامه</label>
                                </div>
                                <!-- Button -->
                                <div class="row align-items-center">
                                    <div class="col-sm-4">
                                        <button type="submit" class="g-recaptcha btn btn-success"
                                                data-sitekey="{{ config('services.google_recaptcha.site_key') }}"
                                                data-callback="onSubmit"
                                                data-action="registerRecaptcha">ثبت نام
                                        </button>
                                    </div>
                                    <div class="col-sm-8 text-sm-end">
                                        <span>آیا قبلا ثبت نام کرده اید؟ <a href="{{ route('login') }}"><u>ورود</u></a></span>
                                    </div>
                                </div>
                            </form>
                            <!-- Form END -->
                            <hr>
                            <!-- Social-media btn -->
                            <div class="text-center">
                                <p>برای دسترسی سریع با شبکه اجتماعی خود وارد شوید</p>
                                <ul class="list-unstyled d-flex mt-3 justify-content-center">
                                    <li class="mx-2">
                                        <a href="{{ route('social-login', 'github') }}"
                                           class="btn btn-light d-inline-block fs-6">github<i
                                                class="fab fa-github text-dark align-middle ms-2 fs-5"></i></a>
                                    </li>
                                    <li class="mx-2">
                                        <a href="{{ route('social-login', 'google') }}"
                                           class="btn btn-light d-inline-block fs-6">google<i
                                                class="fab fa-google text-danger align-middle ms-2 fs-5"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================
        Inner intro END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->

@endsection

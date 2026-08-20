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
                        <div class="p-4 p-sm-5  rounded custom-box-shadow">
                            <h2>فراموشی رمز عبور</h2>
                            <!-- Form START -->
                            <form method="POST" action="{{ route('password.email') }}" class="mt-4">
                                @csrf
                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputEmail1">پست الکترونیکی</label>
                                    <input type="email" name="email"
                                           class="form-control @error('email') border-danger @enderror"
                                           id="exampleInputEmail1"
                                           placeholder="ایمیل">
                                    @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Button -->
                                <div class="row align-items-center">
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-success">ارسال درخواست</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Form END -->
                            <hr>
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

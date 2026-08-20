<style>
    .cropper-wrapper {
        max-height: 70vh; /* حداکثر 70٪ ارتفاع صفحه */
        width: 100%;
    }

    .cropper-wrapper img {
        max-width: 100%;
        max-height: 70vh;
        display: block;
    }
</style>

<!-- Profile -->
<div class="offcanvas offcanvas-start w-100" tabindex="-1" id="offcanvas‌Profile"
     aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <h2 class="offcanvas-title flex-grow-1 text-center fw-bold">پروفایل</h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="container">
            <div class="row g-4">
                <!-- Profile cover and info START -->
                <div class="col-12">
                    <div class="card mb-4 position-relative z-index-9">
                        <!-- Cover image -->
                        <div class="py-5 h-200 rounded"
                             style="background-image:url({{ Vite::image('blog/16by9/big/07.jpg') }}); background-position: center bottom; background-size: cover; background-repeat: no-repeat;">
                        </div>
                        <div class="card-body pt-3 pb-0">
                            <div class="row d-flex justify-content-between">
                                <!-- Avatar -->
                                <div class="col-sm-12 col-md-auto text-center text-md-start">
                                    <div class="avatar avatar-xxl mt-n5">
                                        <img id="main-avatar"
                                             class="avatar-img rounded-circle border border-white border-3 shadow"
                                             src="{{ auth()->user()->profile->avatar
                                                     ? asset('uploads/images/avatars/' . auth()->user()->profile->avatar)
                                                     : asset('uploads/images/avatars/avatar.png') }}"
                                             alt="">
                                    </div>
                                </div>
                                <!-- Profile info -->
                                <div
                                    class="col-sm-12 col-md text-center text-md-start d-md-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="my-2">{{ auth()->user()->name }}<i
                                                class="bi bi-patch-check-fill text-info small"></i>
                                        </h4>
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><i
                                                    class="bi bi-calendar2-plus me-1"></i>{{ verta(auth()->user()->created_at)->format('d F Y') }}
                                            </li>
                                        </ul>
                                        <p class="m-0"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Profile info END -->
            </div>

            <div class="row g-4">
                <!-- Left sidebar START -->
                <div class="col-lg-7 col-xxl-8">
                    <!-- Profile START -->
                    <form id="updatePersonalProfileForm" enctype="multipart/form-data">
                        <div class="card border mb-4">
                            <div class="card-header border-bottom p-3">
                                <h4 class="card-header-title mb-0">حساب کاربری</h4>
                            </div>
                            <div class="card-body">
                                <!-- Full name -->
                                <div class="mb-3">
                                    <label class="form-label">نام کامل</label>
                                    <div class="input-group">
                                        <input type="text" name="name" class="form-control"
                                               value="{{ auth()->user()->name }}" placeholder="نام و نام خانوادگی">
                                    </div>
                                </div>
                                <!-- Username -->
                                <div class="mb-3">
                                    <label class="form-label">ایمیل</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly
                                               value="{{ auth()->user()->email }}">
                                    </div>
                                </div>
                                <!-- Profile picture -->
                                <div class="mb-3">
                                    <label class="form-label">تصویر پروفایل</label>
                                    <!-- Avatar upload START -->
                                    <div class="d-flex align-items-center">
                                        <div class="position-relative me-3">
                                            <!-- Avatar edit -->
                                            <div class="position-absolute top-0 end-0  z-index-9">
                                                <a id="editAvatarBtn" class="btn btn-sm btn-light btn-round">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                            <!-- Avatar preview -->
                                            <div class="avatar avatar-xl">
                                                <img id="avatarPreview"
                                                     class="avatar-img rounded-circle border border-white border-3 shadow"
                                                     src="{{ auth()->user()->profile->avatar
                                                     ? asset('uploads/images/avatars/' . auth()->user()->profile->avatar)
                                                     : asset('uploads/images/avatars/avatar.png') }}"
                                                     alt="">
                                            </div>

                                            <input type="file" id="avatarInput" name="avatar" accept="image/*" hidden>
                                        </div>
                                        <!-- Avatar remove button -->
                                        @if(auth()->user()->profile->avatar)
                                            <div id="avatarRemoveWrapper"
                                                class="avatar-remove {{--{{ auth()->user()->profile->avatar ? '' : 'd-none' }}--}}">
                                                <button id="avatarRemoveButton" type="button" class="btn btn-light">
                                                    حذف
                                                </button>
                                            </div>
                                        @endif

                                    </div>
                                    <!-- Avatar upload END -->
                                </div>
                                <!-- Bio -->
                                <div class="mb-3">
                                    <label class="form-label">درباره من</label>
                                    <div class="form-text mb-3">توضیحات مختصری برای پروفایل شما</div>
                                    <textarea class="form-control" name="bio"
                                              rows="10" cols="10"
                                              style="min-height: 300px;">{{ auth()->user()->profile->bio }}</textarea>

                                </div>
                                <!-- Save button -->
                                <div class="d-flex justify-content-end mt-4">
                                    <a href="#" class="btn text-secondary border-0 me-2">لغو</a>
                                    <button type="submit" class="btn btn-primary">ذخیره</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Profile END -->
                    <!-- Social links START -->
                    <form id="updateSocialProfileForm">
                        <div class="card border mb-4">
                            <div class="card-header border-bottom p-3">
                                <h4 class="card-header-title mb-0"> شبکه های اجتماعی</h4>
                            </div>
                            <div class="card-body">
                                <!-- Skype -->
                                <div class="mb-3">
                                    <label class="form-label">تلگرام</label>
                                    <input class="form-control text-end" type="text" name="telegram"
                                           value="{{ auth()->user()->profile->social_links['telegram'] ?? '' }}">
                                </div>
                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label">اینستاگرام</label>
                                    <input class="form-control text-end" type="text" name="instagram"
                                           value="{{ auth()->user()->profile->social_links['instagram'] ?? '' }}">
                                </div>
                                <!-- Address -->
                                <div class="mb-3">
                                    <label class="form-label">لینکداین</label>
                                    <input class="form-control text-end" type="text" name="linkedin"
                                           value="{{ auth()->user()->profile->social_links['linkedin'] ?? '' }}">
                                </div>
                                <!-- Save button -->
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary">ذخیره</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Social links END -->

                </div>
                <!-- Left sidebar END -->

                <!-- Right sidebar START -->
                <div class="col-lg-5 col-xxl-4">
                    <!-- Profile Setting START -->
                    <div class="card border mb-4">
                        <div class="card-header border-bottom p-3">
                            <h4 class="card-header-title mb-0">تنظیمات حساب کاربری</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch form-check-md mb-3">
                                <input class="form-check-input" type="checkbox" id="availabilityCheck"
                                       name="availability"
                                    {{ auth()->user()->profile->availability ? 'checked' : '' }} >
                                <label class="form-check-label" for="availabilityCheck">نمایش اطلاعات پروفایل</label>
                            </div>
                        </div>
                    </div>
                    <!-- Profile Setting END -->
                    <!-- Update password START -->
                    <form id="updatePasswordProfileForm">
                        <div class="card border mb-4">
                            <div class="card-header border-bottom p-3">
                                <h4 class="card-header-title mb-0">تغییر رمز عبور</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">رمز عبور فعلی</label>
                                    <input class="form-control" name="current_password" type="password"
                                           placeholder="*********">
                                </div>
                                <!-- New password -->
                                <div class="mb-3">
                                    <label class="form-label" id="psw-strength-message"></label>
                                    <div class="input-group">
                                        <input class="form-control fakepassword" name="password" type="password"
                                               id="psw-input"
                                               placeholder="*********">
                                        <span class="input-group-text p-0">
												<i class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
											</span>
                                    </div>
                                    <div class="rounded mt-1" id="psw-strength"></div>
                                </div>
                                <!-- New password -->
                                <div>
                                    <label class="form-label">رمز عبور جدید</label>
                                    <input class="form-control" type="password" name="password_confirmation"
                                           placeholder="*********">
                                </div>
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary">ذخیره</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="avatarModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">انتخاب تصویر پروفایل</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <div class="cropper-wrapper">
                    <img id="cropperImage" style="max-width:100%;">
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                <button id="saveAvatar" class="btn btn-primary">تأیید</button>
            </div>

        </div>
    </div>
</div>

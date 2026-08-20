@extends('layouts.dashboard.master')
@section('content')

    <main>
        <section class="py-4">
            <div class="container">
                <div class="container-fluid py-4">

                    {{-- Header --}}
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="fw-bold mb-1">
                                مدیریت کاربران
                                <span class="badge bg-primary bg-opacity-10 text-primary">{{ $usersCount }}</span>
                            </h4>
                            <p class="text-muted mb-0">لیست کاربران ثبت‌نام شده در سیستم</p>
                        </div>

                        <button
                            type="button"
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#createUserModal">
                            + افزودن کاربر
                        </button>
                    </div>

                    {{-- Filters --}}
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row g-3 align-items-center">

                                <div class="col-md-4">
                                    <form method="GET">
                                        <div class="input-group">
                                            <input type="text" value="{{ request('search') }}" name="search"
                                                   class="form-control"
                                                   placeholder="جستجو بر اساس نام یا ایمیل...">
                                            <button class="btn btn-outline-secondary" type="submit">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-3">
                                    <form method="GET">
                                        <select name="status" class="form-select" onchange="this.form.submit()">
                                            <option value="">همه وضعیت‌ها</option>
                                            <option
                                                value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                                                فعال
                                            </option>
                                            <option
                                                value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                                غیرفعال
                                            </option>
                                        </select>
                                    </form>
                                </div>

                                <div class="col-md-3">
                                    <form method="GET">
                                        <select name="role" class="form-select" onchange="this.form.submit()">
                                            <option value="">همه نقش‌ها</option>
                                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>
                                                مدیر
                                            </option>
                                            <option value="author" {{ request('role') == 'author' ? 'selected' : '' }}>
                                                نویسنده
                                            </option>
                                            <option
                                                value="subscriber" {{ request('role') == 'subscriber' ? 'selected' : '' }}>
                                                کاربر
                                            </option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Table --}}
                    <div class="card shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 table-striped">

                                <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>کاربر</th>
                                    <th>ایمیل</th>
                                    <th>نقش</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ عضویت</th>
                                    <th class="text-end">عملیات</th>
                                </tr>
                                </thead>

                                <tbody>

                                @if($users->isEmpty())
                                    {{-- Empty State --}}
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">
                                            کاربری یافت نشد
                                        </td>
                                    </tr>

                                @else

                                    @foreach($users as $key => $user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    {{--<img src="https://i.pravatar.cc/40"
                                                         class="rounded-circle me-2"
                                                         width="40" height="40">--}}
                                                    <div>
                                                        <div class="fw-semibold">{{ $user->name }}</div>
                                                        <small class="text-muted">ID: {{ $user->id }}</small>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>{{ $user->email }}</td>

                                            <td>
                                                <span class="badge bg-primary">{{ $user->role_fa }}</span>
                                            </td>

                                            <td>
                                                <span class="badge bg-success">{{ $user->status }}</span>
                                            </td>

                                            <td>{{ $user->jalaliDate }}</td>

                                            <td class="text-end">
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-outline-primary edit-user-btn"
                                                            data-id="{{ $user->id }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button class="btn btn-outline-danger">
                                                        <i data-id="{{ $user->id }}" class="bi bi-trash user-delete-icon"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>

                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            {{ $users->links('pagination::tailwind') }}
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">کاربر جدید</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Body -->
                        <form id="registerUserForm" method="POST">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">نام و نام خانوادگی</label>
                                    <input type="text" name="name" class="form-control"
                                           placeholder="نام و نام خانوادگی ...">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">ایمیل</label>
                                    <input type="email" name="email" class="form-control" placeholder="ایمیل ...">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">کلمه عبور</label>
                                    <input type="password" name="password" class="form-control"
                                           placeholder="کلمه عبور ...">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">تکرار کلمه عبور</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                           placeholder="تکرار کلمه عبور ...">
                                </div>

                            </div>
                            <!-- Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    انصراف
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    ثبت
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">ویرایش کاربر</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form id="editUserForm" method="POST">

                            <div class="modal-body">

                                <input type="hidden" id="edit_user_id">

                                <div class="mb-3">
                                    <label class="form-label">نام و نام خانوادگی</label>
                                    <input id="edit_name" type="text" name="name" class="form-control"
                                           placeholder="نام و نام خانوادگی ...">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">ایمیل</label>
                                    <input id="edit_email" name="email" class="form-control" placeholder="ایمیل ...">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">نقش</label>
                                    <select name="role" id="edit_role" class="form-select">
                                        <option value="admin">مدیر</option>
                                        <option value="author">نویسنده</option>
                                        <option value="subscriber">کاربر</option>
                                    </select>
                                </div>

                            </div>
                            <!-- Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    انصراف
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    ثبت
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>


            <div id="toastContainer" class="position-fixed left-2 bottom-3"></div>

        </section>
    </main>

@endsection

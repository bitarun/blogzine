<!-- Footer START  -->

<div id="toastContainer" class="position-fixed left-2 bottom-3"></div>

<footer class="bg-dark d-none d-lg-block">
    <div class="container pt-5 ">
        <!-- Widgets START -->
        <div class="row pt-5">
            <!-- Footer Widget -->
            <div class="col-md-6 col-lg-3 mb-4">
                <h5 class="mb-4 text-white">اخبار اخیر</h5>
                <!-- Item -->
                @foreach($twoLatestArticles as $latestArticle)
                    <div class="mb-4 position-relative">
                        <div><a href="#" class="badge text-bg-danger mb-2"><i
                                    class="fas fa-circle me-2 small fw-bold"></i>{{ $latestArticle->category->name }}
                            </a>
                        </div>
                        <a href="{{ route('article.show', [$latestArticle->category, $latestArticle]) }}"
                           class="btn-link text-white fw-normal">{{ $latestArticle->title }}</a>
                        <ul class="nav nav-divider align-items-center small mt-2 text-body-secondary">
                            <li class="nav-item position-relative">
                                <div class="nav-link"><a href="#"
                                                         class="stretched-link text-reset btn-link">{{ $latestArticle->author->name }}</a>
                                </div>
                            </li>
                            <li class="nav-item">{{ verta($latestArticle->created_at)->format('j F ، Y') }}</li>
                        </ul>
                    </div>
                @endforeach
                <!-- Item -->
            </div>
            <!-- Footer Widget -->
            <div class="col-md-6 col-lg-3 mb-4">
                <h5 class="mb-4 text-white">دسته بندی ها</h5>
                <div class="row">
                    <div class="col-10">
                        <ul class="nav flex-column text-primary-hover">
                            @if($menuCategories->isNotEmpty())
                                @foreach($menuCategories as $menuCategory)
                                    <li class="nav-item"><a class="nav-link p-2" href="{{ route('archive', $menuCategory) }}">{{ $menuCategory->name }}<span
                                                class="badge text-bg-danger ms-2">{{ $menuCategory->articles_count }}</span></a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Footer Widget -->
            <div class="col-sm-6 col-lg-3 mb-4">
                <h5 class="mb-4 text-white">تقویم روز</h5>
                <p class="" style="color: #d0d4d9;">{{ 'امروز: ' . verta()->format('j F ماه Y') }}</p>
                <ul class="nav flex-column" style="color: #d0d4d9;">

                    @forelse($todayEvents as $event)
                        <li class="nav-item mb-3">
                            {{ $event['title'] }}
                            <span class="badge bg-success">{{ $event['type'] }}</span>
                        </li>
                    @empty
                        <li class="nav-item mb-3">بدون مناسبت</li>
                    @endforelse
                </ul>
            </div>
            <!-- Footer Widget -->
            <div class="col-sm-6 col-lg-3 mb-4">
                <h5 class="mb-4 text-white">اپلیکیشن موبایل</h5>
                <p class="text-body-secondary">برنامه را دانلود کنید و آخرین اخبار فوری و مقالات روزانه را دریافت
                    کنید.</p>
                <div class="row g-2">
                    <div class="col">
                        <a href="#"><img class="w-100" src="{{ Vite::image('app-store.svg') }}" alt="app-store"></a>
                    </div>
                    <div class="col">
                        <a href="#"><img class="w-100" src="{{ Vite::image('google-play.svg') }}" alt="google-play"></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Widgets END -->


    </div>

    <!-- Footer copyright START -->
    <div class="bg-dark-overlay-3 mt-5">
        <div class="container">
            <div class="row align-items-center justify-content-md-between py-4">
                <div class="col-md-4">
                    <!-- Copyright -->
                    <div class="text-center text-md-start fw-bold">تمامی حقوق محفوظ است
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center justify-content-md-center">

                    <!-- Links -->
                    <ul class="nav fw-bold text-center text-sm-end justify-content-center justify-content-center mt-3 mt-md-0">
                        <li class="nav-item"><a class="nav-link" href="#">آرشیو</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">درباره ما</a></li>

                        <li class="nav-item"><a class="nav-link" href="#">تماس با ما</a></li>


                    </ul>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center justify-content-md-end">

                    <ul class="nav d-flex flex-row-reverse justify-content-between align-items-end ">
                        <li class="nav-item"><a class="nav-link pt-0" href="#"><i class="fab fa-telegram fa-fw me-2"
                                                                                  style="font-size: 22px;"></i></a></li>
                        <li class="nav-item"><a class="nav-link pt-0" href="#"><i class="fab fa-instagram fa-fw me-2"
                                                                                  style="font-size: 22px;"></i></a>
                        </li>
                        <li class="nav-item"><a class="nav-link pt-0" href="#"><i class="fab fa-whatsapp fa-fw me-2"
                                                                                  style="font-size: 22px;"></i></a></li>
                        <li class="nav-item"><a class="nav-link pt-0" href="#"><i class="fab fa-twitter fa-fw me-2"
                                                                                  style="font-size: 22px;"></i></a></li>
                        <li class="nav-item"><a class="nav-link pt-0" href="#"><i class="fab fa-linkedin fa-fw me-2"
                                                                                  style="font-size: 22px;"></i></a></li>
                        <li class="nav-item"><a class="nav-link pt-0" href="#"><i class="fab fa-youtube fa-fw me-2"
                                                                                  style="font-size: 22px;"></i></a></li>
                    </ul>
                </div>


            </div>
        </div>
    </div>
    <!-- Footer copyright END -->
</footer>
<!-- =======================
Footer END -->
<!-- bottom menu -->
<nav class="navbar navbar-light justify-content-around bottom-menu bg-light d-md-none position-fixed bottom-0 w-100"
     style="z-index: 1000;">
    <div class="container>
		<div class=" row
    ">
    <ul class="nav p-2">
        <a href="{{ route('index') }}" class="nav-link active">
            <li class="nav-item d-flex"><i class="bi bi-house me-1" style="font-size: 18px;"></i>خانه</li>
        </a>
        @auth()
            <a href="" class="nav-link">
                <li class="nav-item d-flex"><i class="bi bi-person-lines-fill me-1" style="font-size: 18px;"></i>پروفایل
                </li>
            </a>
        @endauth
        @guest()
            <a href="{{ route('login') }}" class="nav-link">
                <li class="nav-item d-flex"><i class="bi bi-box-arrow-in-left me-1" style="font-size: 18px;"></i>ورود -
                    ثبت
                    نام
                </li>
            </a>
        @endguest
        <a href="" class="nav-link">
            <li class="nav-item d-flex"><i class="bi bi-bell me-1" style="font-size: 18px;"></i>اعلانات</li>
        </a>
    </ul>
    </div>
    </div>
</nav>
<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short"></i></div>
<!-- =======================
JS libraries, plugins and custom scripts -->

{{--<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/min/tiny-slider.js"></script>--}}
{{--<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>--}}

<script>
    function onSubmit() {
        document.getElementById('registerForm').submit();
    }
</script>

<!-- <script>
	const pullToRefresh = document.querySelector('.pull-to-refresh');
		let touchstartY = 0;
		document.addEventListener('touchstart', e => {
			touchstartY = e.targetTouches[0].pageY;
		});
		document.addEventListener('touchmove', e => {
			const touchY = e.targetTouches[0].pageY;
			const touchDiff = touchY - touchstartY;
			if (touchDiff > 0 && window.scrollY === 0) {
				pullToRefresh.classList.add('visible');
				e.preventDefault();
			}
		});
		document.addEventListener('touchend', e => {
			if (pullToRefresh.classList.contains('visible')) {
				pullToRefresh.classList.remove('visible');
				location.reload();
			}
		});
</script> -->

</body>

</html>

<!-- =======================
    Trending START -->
@if($currenyData)

    <section class="py-2">
        <div class="container">
            <div class="row g-0">
                <div class="col-12 bg-primary bg-opacity-10 p-2 ">
                    <div class="d-sm-flex align-items-center text-center text-sm-start">
                        <!-- Title -->
                        <div class="badge bg-primary p-2 px-3">امروز : ۳۰ تیرماه ۱۴۰۳</div>
                        <div class="marquee-container">
                            <div class="marquee">

                                @foreach($currenyData as $data)

                                    <span class="nav-item me-2">
                                        {{ $data['name'] }} :
                                    <span class="{{ number_format($data['price']) . ' ' . $data['unit'] }}"></span>
                                        <span
                                            style="color: {{ str_contains($data['chane_percent']?? '', '-') ? 'red' : 'green' }}">
                                            {{ $data['chane_percent'] }}
                                        </span>
                                    </span>

                                @endforeach

                            </div>
                        </div>


                        <!-- Slider -->
                        <!-- <div class="tiny-slider arrow-end arrow-xs arrow-white arrow-round arrow-md-none">
                            <div class="tiny-slider-inner"
                                data-autoplay="true"
                                data-hoverpause="true"
                                data-gutter="0"
                                data-arrow="true"
                                data-dots="false"
                                data-items="1">
                                <!-- Slider items
                                <div> <a href="#" class="text-reset btn-link">افزایش آلودگی هوا در شهرهای پُرجمعیت تا فردا</a></div>
                                <div> <a href="#" class="text-reset btn-link">حضورمسیحیان در حرم سامرابا آغاز سال جدید </a></div>
                                <div> <a href="#" class="text-reset btn-link">انتقاد ستاره رئال از شعارهای نژادپرستانه </a></div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div> <!-- Row END -->
        </div>
    </section>

@endif
<!-- =======================
Trending END -->

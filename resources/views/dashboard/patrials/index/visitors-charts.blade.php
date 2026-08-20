<div class="col-xl-8">
    <!-- Chart START -->
    <div class="card border h-100">

        <!-- Card header -->
        <div class="card-header p-3 border-bottom">
            <h4 class="card-header-title mb-0">بازدید ماهانه</h4>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Apex chart -->
            <div id="apexChartTrafficStats" class="mt-2"></div>
        </div>
    </div>
    <!-- Chart END -->
</div>
<div class="col-md-6 col-xxl-4">
    <div class="card border h-100">

        <script>
            const referrals = @json($referrals);
            const trafficStats = @json($trafficStats);
        </script>

        <!-- Card header -->
        <div
            class="card-header border-bottom d-flex justify-content-between align-items-center p-3">
            <h5 class="card-header-title mb-0">آمار ارجادهنده‌ها</h5>
            <a href="#" class="btn btn-sm btn-link p-0 mb-0 text-reset">مشاهده همه</a>
        </div>

        <!-- Card body START -->
        <div class="card-body p-4">
            <!-- Chart -->
            <div class=" mx-auto">
                <div id="apexChartTrafficSources"></div>
            </div>
        </div>
    </div>
</div>

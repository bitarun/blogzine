@extends('layouts.dashboard.master')

@section('content')
    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- =======================
        Main contain START -->
        <section class="py-4">
            <div class="container">
                <div class="row g-4">

                    @include('dashboard.patrials.index.stats-cards')
                    @include('dashboard.patrials.index.visitors-charts')

                </div>
            </div>
        </section>
        <!-- =======================
        Main contain END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->

@endsection

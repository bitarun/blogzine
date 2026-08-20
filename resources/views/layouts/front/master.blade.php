@include('layouts.partials.header')
@auth()
    @include('layouts.partials.sidebar')
    @include('layouts.partials.bookmark')
    @include('layouts.partials.profile')
@endauth
@yield('content')
@include('layouts.partials.footer')

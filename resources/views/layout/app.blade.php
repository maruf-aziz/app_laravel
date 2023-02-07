@php
    $segment = request()->segment(1);
@endphp

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- bagian css --}}
    @include('assets.css')

    {{-- bagian css tambahan --}}
    @yield('css_addon')

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">

        <header>
            {{-- bagian menu --}}
            @include('menu.menu')
        </header>
        

        {{-- bagian content --}}
        @yield('content')

        <div id="theModal" class="modal fade">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                </div>
            </div>
        </div>

    </div>

    {{-- bagian js --}}

    @include('assets.js')
    
    {{-- javascript tambahan --}}
    @yield('script')

</body>

</html>

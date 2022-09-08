<!doctype html>
<html>
<head>
   @include('includes.head')
</head>
<body>

<header id="header">

    <div class="container-fluid">

        @include('includes.header')

    </div>


</header>


<section class="banner-section">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-2 col-md-12" id="sidebar">

                @include('includes.crewsidebar')

            </div>

            <div class="col-lg-10 col-md-12" id="main">
                {{-- Body content --}}

                 @yield('content')

            </div>

        </div>

    </div>

</section>

<footer class="row">
    @include('includes.crewfooter')
</footer>

</body>
</html>

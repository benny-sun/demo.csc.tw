<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.flyer.head')
</head>

<body>
    <!-- Swiper -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @include('includes.flyer.sections.cover')
            @include('includes.flyer.sections.contents')
            @include('includes.flyer.sections.back_cover')
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>

    <!-- Jquery JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Swiper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>

    <!-- Lazyload JS -->
    <script src="{{ url('js/vanilla-lazyload-12.0.0.js') }}"></script>

    <!-- Initialize Swiper -->
    <script>

        var lazyLoadInstance = new LazyLoad({
            elements_selector: ".lazy"
            // ... more custom settings?
        });

        var swiper = new Swiper('.swiper-container', {
            direction: 'vertical',
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>

</body>

</html>
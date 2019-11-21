
<script type="text/javascript" src="{{ url('js/album/jquery-1.11.2.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/album/jquery.lazyload.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/album/modernizr.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/album/pace/pace.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/album/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/album/owl-carousel/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/album/lightbox/js/lightbox.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/album/jquery.nicescroll.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/album/jquery.nav.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/album/jquery.inview.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/album/jquery.lazy.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/album/custom.js') }}"></script>
<script type="text/javascript" src="{{ url('js/album/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

<script>
    $(document).on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            always_show_close: false
        });
    });
</script>
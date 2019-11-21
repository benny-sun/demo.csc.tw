    <!-- Footer
	============================================= -->
    <footer>
        <div class="container-fluid">
            <h1>康碁</h1>
            <div class="social">
                <a class="socialProfiles" data-toggle="tooltip" data-placement="bottom" title="康碁粉絲專頁"><i class="fa fa-thumbs-o-up fa-2x"></i></a>
                <a class="shareMenu" data-toggle="tooltip" data-placement="bottom" title="分享"><i class="fa fa-share-alt fa-2x"></i></a>
            </div>
            <h6 class="col-xs-12 col-md-4 col-md-offset-4">&copy; 2019 Concepoint</h6>
            <h6 class="col-xs-12 col-md-4 text-right">Powered by LiRi info</h6>
        </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('js/album/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('bootstrap-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <!-- JS PLUGINS -->
    <script src="{{ asset('plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('plugins/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('plugins/countTo/jquery.countTo.js') }}"></script>
    <script src="{{ asset('plugins/inview/jquery.inview.min.js') }}"></script>
    <script src="{{ asset('plugins/Lightbox/dist/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('plugins/WOW/dist/wow.min.js') }}"></script>
    <script src="{{ asset('plugins/social/socialShare.js') }}"></script>
    <script src="{{ asset('plugins/social/socialProfiles.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- GOOGLE MAP -->
    <script src="{{ url('js/google-maps.js') }}"></script>
    <!-- Lazyload JS -->
    <script src="{{ url('js/vanilla-lazyload-12.0.0.js') }}"></script>


    <script>
        $(document).ready(function () {

            var lazyLoadInstance = new LazyLoad({
                elements_selector: ".lazy"
                // ... more custom settings?
            });

            // $(".lb-container").append(
            //     "<div class='black-cover'></div>" +
            //     "<div class='building'>" +
            //     "<img src='img/product/building.png'>" +
            //     "<h3>Coming soon</h3>"
            // );

            /* 型錄下載 */
            $("#download-link").click(function () {
                location.href = "downloader/process.php";
            });


            /* -- 分享按鈕 -- */
            $('.shareMenu').socialShare({
                social: 'facebook,twitter,weibo,line',
                whenSelect: true,
                selectContainer: '.shareMenu',
                blur: true
            });

            $('.socialProfiles').socialProfiles({
                blur: true,
                facebook: 'concepoint',
                twitter: 'dstand_zhi',
                youtube: 'UCdlmgi5tUdsl84BKvFhvWrA',
                weibo: '5732374544'
            });

            /* --粉專 & 分享按鈕的文字提示--  */
            $('[data-toggle="tooltip"]').tooltip();

            /* --產品小圖於手機板觸發hover的方法-- */
            $('.portfolio-box-caption').bind('touchstart touchend', function() {
                $(this).toggleClass('toggleHoverEffect');
            });

            if ($(window).width() < 768) {
                $('.page-scroll').attr('data-toggle', 'collapse').attr('data-target', '.navbar-collapse');
            }

            {{--  避免表單重複發送  --}}
            jQuery.fn.preventDoubleSubmission = function() {
                $(this).on('submit',function(e){
                    var $form = $(this);
                    if ($form.data('submitted') === true) {
                        e.preventDefault();
                    } else {
                        $form.data('submitted', true);
                        $('button').prop('disabled', true);
                        spinner = '<i class="fa fa-circle-o-notch fa-spin fa-x fa-fw"></i>';
                        $('button').html(spinner + '請稍候..');
                    }
                });
                return this;
            };
            $('form').preventDoubleSubmission();

        });
    </script>
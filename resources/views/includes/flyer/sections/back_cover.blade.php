<!-- Cover -->
<div class="swiper-slide lazy" data-bg="url({{ url('uploads/'.$coverBack->path) }})">
    <div class="cover">
        <div class="center-panel">
            <div class="info">
                <h6>更多產品資訊請詳官網</h6>
                <h6><a href="http://www.csc.tw" class="white-border">www.csc.tw</a></h6>
            </div>
            <div class="social-share">
                <div class="fb-icon"><a href="https://www.facebook.com/sharer/sharer.php?u={{ $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] }}" target="_blank"><img class="lazy" data-src="{{ url('img/icons/fb-icon.png') }}" alt="" ></a></div>
                <div class="line-icon"><a href="line://msg/text/http%3A%2F%2Fconcepoint.com" target="_blank"><img class="lazy" data-src="{{ url('img/icons/LINE-logo.png') }}" alt="" ></a></div>
            </div>
        </div>
        <div class="cover-footer-back">
            <div class="left-panel">
                <div class="name">
                    <div class="logo">
                        <img src="{{ url('img/logo/(logo)concepoint.svg') }}" alt="">
                    </div>
                    <div class="title">康碁有限公司</div>
                </div>
                <div class="contact-info">
                    <h6 class="tel"><a class="text-yellow" href="tel:+886-3-4551512">(03) 4551512</a></h6>
                    <h6 class="email">support@csc.tw</h6>
                </div>
            </div>
        </div>
    </div>
</div>
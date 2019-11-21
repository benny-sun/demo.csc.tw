    <section class="main-header">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="img/logo/(logo)concepoint.svg" class="img-responsive" alt="logo"></a>
                </div>
                <div class="collapse navbar-collapse text-center" id="bs-example-navbar-collapse-1">
                    <div class="col-md-8 col-xs-12 nav-wrap">
                        <ul class="nav navbar-nav">
                            <li><a href="#owl-hero" class="page-scroll">首頁</a></li>
                            <li><a href="#product" class="page-scroll">產品</a></li>
                            <li><a href="#partners" class="page-scroll">合作夥伴</a></li>
                            <li><a href="#about-us" class="page-scroll">關於康碁</a></li>
                            <li><a href="#contact" class="page-scroll">聯絡我們</a></li>
                        </ul>
                    </div>
                    <div class="social-media hidden-sm hidden-xs">
                        <ul class="nav navbar-nav">
                            <li><a class="socialProfiles" data-toggle="tooltip" data-placement="bottom" title="康碁粉絲專頁"><i class="fa fa-thumbs-o-up fa-2x"></i></a></li>
                            <li><a class="shareMenu" data-toggle="tooltip" data-placement="bottom" title="分享"><i class="fa fa-share-alt"></i></a></li>
                        </ul>
                        @include('includes.github-corner')
                    </div>
                </div>

            </div>
        </nav>

        <div id="owl-hero" class="owl-carousel owl-theme">
            @foreach($sliders as $row)
            <div class="item lazy" data-bg="url({{ 'uploads/'.$row->path }})">
                <div class="caption">
                    <h1>{{ $row->title }}</h1>
                    <h2>{{ $row->describe }}</h2>
                </div>
            </div>
            @endforeach
        </div>
    </section>
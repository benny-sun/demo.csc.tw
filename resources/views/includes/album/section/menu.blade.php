    <div id="menu">
        <div class="menu-container">
            <div class="menu-inner">
                <div class="logo-container">
                    <a href="/">
                        <img alt="Concepoint" src="{{ url('img/logo/(logo)concepoint.svg') }}">
                    </a>
                </div>
                <nav class="main-navigation">
                    <ul id="one-page-nav">
                        @foreach ($catelogs as $row)
                        <li class="{{ ($url_id == $row->id) ? 'active' : '' }}"><a href="{{ $row->id }}">{{ $row->title }}</a></li>
                        @endforeach
                    </ul>
                </nav>
                <div class="menu-bottom">
                    <div class="text-center">
                        <a href="http://facebook.com/concepoint" target="_black"><i class="fa fa-facebook-square"></i></a>
                        <a href="https://twitter.com/dstand_zhi" target="_black"><i class="fa fa-twitter"></i></a>
                        <a href="http://youtube.com/channel/UCdlmgi5tUdsl84BKvFhvWrA" target="_black"><i class="fa fa-youtube-play"></i></a>
                        <a href="http://www.weibo.com/u/5732374544" target="_black"><i class="fa fa-weibo"></i></a>
                    </div>
                    <div class="margin-10"></div>
                    <p>Copyright &copy; 2018 <span class="text-white">CSC</span>. All Rights Reserved.</p>
                </div>
            </div><!-- .menu-inner -->
        </div><!-- .menu-container -->
    </div>
    <div id="menu-trigger">
        <i class="fa fa-reorder"></i>
    </div>
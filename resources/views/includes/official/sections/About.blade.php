    <section id="about-us" class="lazy" data-bg="url('uploads/{{ $about_bg['path'] }}')">
        <div class="container-fluid">
            <h2>關於我們</h2>
            <hr class="light-sep">
            <div id="owl-testi" class="owl-carousel owl-theme">
                @foreach ($abouts as $row)
                <div class="item">
                    <div class="quote">
                        <h5>{{ $row->title }}</h5>
                        <p>{!! nl2br($row->describe) !!}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
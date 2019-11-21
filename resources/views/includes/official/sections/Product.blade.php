    <section id="product">
        <div class="container-fluid">
            <h2>產品</h2>
            <hr class="sep">
            <div class="row">
                @foreach ($albumcover as $row)
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay=".3s">
                    <a class="portfolio-box" href="{{ $row->url }}" {!! $row->light_box  !!}>
                        <img src="{{ url('uploads/'.$row->img) }}" class="img-responsive">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    {{ $row->title }}
                                </div>
                                <div class="project-name">
                                    {{ $row->subtitle }}
                                </div>
                            </div>
                            <div class="portfolio-logo">
                                <img src="{{ url('uploads/'.$row->logo) }}">
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
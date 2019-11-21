    <section id="case">
        <div class="container">
            <h2>實際案例</h2>
            <hr class="light-sep">
            <div class="services-box">
                <div class="row wow fadeInUp" data-wow-delay=".3s">
                    @foreach ($cases as $row)
                    <div class="col-md-4 col-xs-12">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <h3>{{ $row->title }}</h3>
                            <p>{{ $row->describe }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
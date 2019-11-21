    <section id="partners">
        <div class="container-fluid">
            <h2>合作夥伴</h2>
            <hr class="sep">
            <div class="row wow fadeInUp" data-wow-delay=".3s">
                @foreach ($partners as $row)
                <div class="col-lg-1 col-md-2 col-xs-3">
                    <img class="lazy" data-src="{{ url('uploads/'.$row->path) }}">
                    <h4>{{ $row->title }}</h4>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="welcome">
        <div class="container">
            <h2>Welcome To <b>康碁</b></h2>
            <hr class="sep">

            @foreach ($welcome as $row)
            <div class="col-md-3 col-xs-6">
                <img class="wow fadeInUp lazy" data-wow-delay=".3s" data-src="{{ url('uploads/'.$row->path) }}" alt="logo">
            </div>
            @endforeach
            
        </div>
    </section>
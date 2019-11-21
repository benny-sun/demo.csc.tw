    <section id="sectionCover">
        <div class="container bg-white">
            <div class="row mobile" style="background-color: #1b1b1b;">
                <div class="col-lg-6 col-md-6 field-cover">
                    <div class="cover">
                        <div>
                            <img class="cover-font" src="{{ url('uploads/'.$header->title) }}">
                            <div class="catelog-text">
                                <h1>{{ $cover_info->title }}</h1>
                                <h2>{{ $cover_info->subtitle }}</h2>
                            </div>
                        </div>
                        <div>
                            <img class="cover-logo" src="{{ url('uploads/'.$header->logo) }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 hidden-xs hidden-sm">
                    <img class="lazy" data-original="{{ url('uploads/'.$header->img) }}">
                </div>
            </div>
        </div>
    </section>
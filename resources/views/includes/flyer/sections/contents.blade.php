<!-- Contents -->
@foreach ($collection as $item)
<div class="swiper-slide lazy" data-bg="url({{ url('uploads/'.$item->path) }})">
    <div class="contents">
        <h4>{{ $item->title }}</h4>
        <p class="description">{{ $item->describe }}<a class="btn btn-secondary" href="{{ $item->link }}">More</a></p>
    </div>
</div>
@endforeach
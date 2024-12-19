<section class="hero">
    <div class="hero__slider owl-carousel">
        @foreach ($banners as $item)
            <div class="hero__items set-bg" data-setbg="{{ Storage::url($item->image) }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h3 style="color: red !important;">{{ $item->collection }}</h3>
                                <h2>{{ $item->title }}</h2>
                                <p>{{ $item->description }}</p>
                                <a href="{{ $item->url }}" class="primary-btn">Shop now <span
                                        class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<style>
    .primary-btn {
        position: absolute;
        bottom: -350px;
    }
</style>

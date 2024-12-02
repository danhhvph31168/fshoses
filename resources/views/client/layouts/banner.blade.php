<section class="hero">
    @foreach ($banners as $item)
    <div class="hero__slider owl-carousel">
        @if (\Str::contains($item->image, 'http'))
        <div class="hero__items set-bg" data-setbg="{{ $item->image}}">

            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>{{ $item->collection }}</h6>
                            <h2>{{ $item->title }}</h2>
                            <p>{{ $item->description }}</p>
                            <a href="{{ route('client.product-list') }}" class="primary-btn">Shop now <span
                                    class="arrow_right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="hero__items set-bg" data-setbg="{{ Storage::url($item->image) }}">

            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>{{ $item->collection }}</h6>
                            <h2>{{ $item->title }}</h2>
                            <p>{{ $item->description }}</p>
                            <a href="{{ route('client.product-list') }}" class="primary-btn">Shop now <span
                                    class="arrow_right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif


        @endforeach
</section>

<style>
.primary-btn {
    position: absolute;
    bottom: -350px;
}
</style>
<section class="categories spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="categories__text">
                    <h2><span>Shoe Collection</span></h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories__hot__deal">
                    <img src="{{ Storage::url($productMaxPriceSale->img_thumbnail) }}" alt="">
                    <div class="hot__deal__sticker" style="background-color: red;">
                        <span>Sale Of</span>
                        <h5>{{ $productMaxPriceSale->price_sale }} %</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="categories__deal__countdown">
                    <span>Deal Of The Week</span>
                    <h2>{{ $productMaxPriceSale->name }}</h2>
                    <div class="categories__deal__countdown__timer" id="countdown">
                        <div class="cd-item">
                            <span>3</span>
                            <p>Days</p>
                        </div>
                        <div class="cd-item">
                            <span>1</span>
                            <p>Hours</p>
                        </div>
                        <div class="cd-item">
                            <span>50</span>
                            <p>Minutes</p>
                        </div>
                        <div class="cd-item">
                            <span>18</span>
                            <p>Seconds</p>
                        </div>
                    </div>
                    <a href="{{ route('productDetail', $productMaxPriceSale->slug) }}" class="btn btn-primary">Shop
                        now</a>

                </div>
            </div>
        </div>
    </div>
</section>

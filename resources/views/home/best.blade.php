@php
    use App\Models\Category;
    $categories = Category::all();

    use App\Models\Product;

    $products = Product::all();
@endphp
<div class="best_sellers">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="section_title new_arrivals_title">
                    <h2>Más Vendidos</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="product_slider_container">
                    <div class="owl-carousel owl-theme product_slider">

                        <!-- Slide 1 -->
                        @foreach ($products as $product)
                            <div class="owl-item product_slider_item">
                                <div class="product-item">
                                    <div class="product discount">
                                        <div class="product_image">
                                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}">
                                        </div>
                                        <div class="favorite favorite_left"></div>
                                        <div class="product_info">
                                            <h6 class="product_name"><a href="single.html">{{ $product->name }}</a></h6>
                                            <div class="product_price">
                                                {{ $product->price }}$</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Navegación del Slider -->

                    <div
                        class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    </div>
                    <div
                        class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

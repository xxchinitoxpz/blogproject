@php
    use App\Models\Category;
    $categories = Category::all();

    use App\Models\Product;

    $products = Product::all();
@endphp
<div class="new_arrivals">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="section_title new_arrivals_title">
                    <h2>Nuevas Llegadas</h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col text-center">
                <div class="new_arrivals_sorting">
                    <ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
                        <!-- Botón "todos" para mostrar todos los productos -->
                        <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked"
                            data-filter="*">todos</li>

                        <!-- Bucle dinámico para mostrar categorías desde la base de datos -->
                        @foreach ($categories as $category)
                            <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center"
                                data-filter=".{{ $category->slug }}">
                                {{ $category->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
                    @foreach ($products as $product)
                        <div class="product-item {{ $product->category->slug }}">
                            <div class="product discount product_filter">
                                <div class="product_image">
                                    <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}">
                                </div>
                                <div class="favorite favorite_left"></div>
                                @if ($product->discount > 0)
                                    <div
                                        class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                        <span>-{{ $product->discount }}$</span>
                                    </div>
                                @endif
                                <div class="product_info">
                                    <h6 class="product_name"><a href="#">{{ $product->name }}</a></h6>
                                    <div class="product_price">
                                        S/ {{ $product->price }}<span>{{ $product->original_price }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="red_button add_to_cart_button">
                                <a href="javascript:void(0)" class="add-to-cart"
                                    data-product-id="{{ $product->id }}">añadir al carrito</a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>


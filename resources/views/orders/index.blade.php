<!DOCTYPE html>
<html lang="en">

<head>
    <title>Colo Shop</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('user-template/styles/bootstrap4/bootstrap.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('user-template/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('user-template/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('user-template/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user-template/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user-template/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user-template/styles/responsive.css') }}">
    <style>
        .order-items {
            margin: 15px 0;
        }

        .order-items div {
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .search-bar input {
            width: 100%;
        }

        .product-details img {
            border-radius: 5px;
            margin-right: 15px;
        }

        .product-details {
            display: flex;
            align-items: center;
        }

        .product-price {
            text-align: right;
        }

        .order-summary p {
            font-size: 1.1em;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <!-- header section start -->
    @include('home.header')


    <div class="container" style="margin-top: 20%">
        <h2>Mis compras</h2>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#">Compras online</a>
            </li>
        </ul>

        <div class="search-bar my-4">
            <input type="text" class="form-control" placeholder="Buscar por N° de pedido" id="searchOrder">
        </div>

        @forelse($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $order->created_at->format('d \d\e F') }}</h5>
                    <p class="card-text">Compra N° {{ $order->id }}</p>

                    @if ($order->delivered_at)
                        <p class="text-success">Entregado el {{ $order->delivered_at->format('l d \d\e F') }}</p>
                    @else
                        <p class="text-warning">En tránsito</p>
                    @endif

                    <div class="order-items">
                        @foreach ($order->products as $product)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}"
                                        width="50">
                                    <span>{{ $product->name }}</span>
                                </div>
                                <span class="text-muted">S/ {{ $product->price }}</span>
                            </div>
                        @endforeach
                    </div>

                    <p class="text-right font-weight-bold">Total: S/ {{ $order->total }}</p>
                </div>
            </div>
        @empty
            <p>No tienes compras registradas.</p>
        @endforelse
    </div>

    <!-- footer section start -->
    @include('home.footer')

    <script src="{{ asset('user-template/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('user-template/styles/bootstrap4/popper.js') }}"></script>
    <script src="{{ asset('user-template/styles/bootstrap4/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user-template/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('user-template/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
    <script src="{{ asset('user-template/plugins/easing/easing.js') }}"></script>
    <script src="{{ asset('user-template/js/custom.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartButtons = document.querySelectorAll('.add-to-cart');

            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');

                    // Realiza la solicitud AJAX para añadir el producto al carrito
                    fetch('/add-to-cart', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                quantity: 1
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message) {
                                alert(data.message); // Muestra el mensaje del servidor
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });
        });
    </script>
</body>

</html>

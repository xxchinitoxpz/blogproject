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

        <h2>Carro ({{ $cart->products->count() }} producto{{ $cart->products->count() > 1 ? 's' : '' }})</h2>

        <div class="row">
            <!-- Carrito de productos -->
            <div class="col-md-8">
                @if ($cart->products->isEmpty())
                    <div class="alert alert-info">
                        No tienes productos en tu carrito.
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <strong>Vendido por</strong> {{ $sellerName ?? 'tu tienda' }}
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($cart->products as $product)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="product-details">
                                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}"
                                                width="60">
                                            <span>{{ $product->name }}</span>
                                                <br>
                                            <br>
                                            <span>Cantidad: {{ $product->pivot->quantity }}</span>
                                        </div>
                                        <div class="product-price">
                                            <strong>S/ {{ $product->price }}</strong>
                                            @if ($product->discount > 0)
                                                <br><span class="text-danger">-{{ $product->discount }}%</span>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Resumen del pedido y formulario de pago -->
            <div class="col-md-4">
                <h3>Resumen de la orden</h3>
                <div class="order-summary">
                    <p><strong>Productos ({{ $cart->products->count() }}):</strong> S/ {{ $cartTotal }}</p>
                    <p><strong>Descuentos:</strong> S/ -{{ $totalDiscount }}</p>
                    <p><strong>Total (USD):</strong> S/ {{ $finalTotal }}</p>
                </div>

                <h3>Información de Pago</h3>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('checkout.create') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="phone">Teléfono:</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Dirección:</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="payment_type_id">Tipo de Pago:</label>
                        <select name="payment_type_id" id="payment_type_id" class="form-control" required>
                            @foreach ($paymentTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Confirmar Compra</button>
                </form>
            </div>
        </div>
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

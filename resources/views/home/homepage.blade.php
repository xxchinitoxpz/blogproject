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
</head>

<body>
    <!-- header section start -->
    @include('home.header')
    <!-- anuncio section start -->
    @include('home.anuncio')
    <!-- banner section start -->
    @include('home.banner')
    <!-- products section start -->
    @include('home.products')
    <!-- deal section start -->
    @include('home.deal')
    <!-- best section start -->
    @include('home.best')
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

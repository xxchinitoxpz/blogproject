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

    <link rel="stylesheet" href="{{ asset('user-template/plugins/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('user-template/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user-template/styles/contact_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user-template/styles/contact_responsive.css') }}">
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
    <div class="fs_menu_overlay"></div>

    <!-- Hamburger Menu -->

   

    <div class="container contact_container">
        <div class="row">
            <div class="col">
                <!-- Breadcrumbs -->
                <div class="breadcrumbs d-flex flex-row align-items-center">
                    <ul>
                        <li><a href="index.html">Inicio</a></li>
                        <li class="active"><a href="#"><i class="fa fa-angle-right"
                                    aria-hidden="true"></i>Contacto</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Map Container -->
        <div class="row">
            <div class="col">
                <div id="google_map">
                    <div class="map_container">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Us -->
        <div class="row">
            <div class="col-lg-6 contact_col">
                <div class="contact_contents">
                    <h1>Contáctanos</h1>
                    <p>Existen muchas formas de contactarnos. Puedes enviarnos un mensaje, llamarnos o enviar un correo
                        electrónico, elige la que más te convenga.</p>
                    <div>
                        <p>(800) 686-6688</p>
                        <p>info.deercreative@gmail.com</p>
                    </div>
                    <div>
                        <p>Dirección: mm</p>
                    </div>
                    <div>
                        <p>Horario: 8.00-18.00 Lunes a Viernes</p>
                        <p>Domingo: Cerrado</p>
                    </div>
                </div>

                <!-- Follow Us -->
                <div class="follow_us_contents">
                    <h1>Síguenos</h1>
                    <ul class="social d-flex flex-row">
                        <li><a href="#" style="background-color: #3a61c9"><i class="fa fa-facebook"
                                    aria-hidden="true"></i></a></li>
                        <li><a href="#" style="background-color: #41a1f6"><i class="fa fa-twitter"
                                    aria-hidden="true"></i></a></li>
                        <li><a href="#" style="background-color: #fb4343"><i class="fa fa-google-plus"
                                    aria-hidden="true"></i></a></li>
                        <li><a href="#" style="background-color: #8f6247"><i class="fa fa-instagram"
                                    aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 get_in_touch_col">
                <div class="get_in_touch_contents">
                    <h1>Ponte en Contacto con Nosotros!</h1>
                    <p>Rellena el formulario a continuación para recibir una respuesta gratuita y confidencial.</p>
                    <form action="post">
                        <div>
                            <input id="input_name" class="form_input input_name input_ph" type="text"
                                name="name" placeholder="Nombre" required="required"
                                data-error="Nombre es requerido.">
                            <input id="input_email" class="form_input input_email input_ph" type="email"
                                name="email" placeholder="Correo Electrónico" required="required"
                                data-error="Correo válido es requerido.">
                            <input id="input_website" class="form_input input_website input_ph" type="url"
                                name="name" placeholder="Sitio Web" required="required"
                                data-error="Nombre es requerido.">
                            <textarea id="input_message" class="input_ph input_message" name="message" placeholder="Mensaje" rows="3"
                                required data-error="Por favor, escribe un mensaje."></textarea>
                        </div>
                        <div>
                            <button id="review_submit" type="submit" class="red_button message_submit_btn trans_300"
                                value="Enviar">Enviar Mensaje</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- footer section start -->
    @include('home.footer')
    <script src="{{ asset('user-template/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('user-template/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
    <script src="{{ asset('user-template/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
    <script src="{{ asset('user-template/js/contact_custom.js') }}"></script>

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

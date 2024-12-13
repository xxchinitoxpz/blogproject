<header class="header trans_300">

    <div class="top_nav">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6 text-right">
                    <div class="top_nav_right">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main_nav_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <div class="logo_container">
                        <a href="#">colo<span>shop</span></a>
                    </div>
                    <nav class="navbar">
                            <ul class="navbar_menu">
                                <li><a href="#">Inicio</a></li>
                                <li><a href="{{ route('contact') }}">Contacto</a></li>
                                <li><a href="{{ route('orders') }}">Pedidos</a></li>
                            </ul>
                        <ul class="navbar_user">
                            <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>

                            @if (Route::has('login'))
                                @auth
                                    <li>
                                        <x-app-layout></x-app-layout>
                                    </li>
                                @else
                                    <li><a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="{{ route('register') }}"><i class="fa fa-user-plus"
                                                aria-hidden="true"></i></a>
                                    </li>
                                @endauth
                            @endif
                            {{-- carrito --}}
                            <li class="checkout">
                                <a href="javascript:void(0)" id="cart-icon">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="checkout_items" class="checkout_items">0</span>
                                </a>
                            </li>

                            {{-- fin carrito --}}
                        </ul>

                    </nav>
                </div>
            </div>
        </div>
    </div>

</header>

<!-- Modal Carrito -->
<div id="cartSidebar" class="cart-sidebar">
    <div class="cart-header">
        <span class="close-cart">&times;</span>
        <h2>Tu Carrito</h2>
    </div>
    <div class="cart-body">
        <ul id="cartItemsList">
            <!-- Productos del carrito se insertan aquí dinámicamente -->
        </ul>
    </div>
    <div class="cart-footer">
        <div class="total">
            <span>Total (USD): </span><span id="cartTotal">0</span>
        </div>
        <button class="btn checkout-button">Continuar al pago</button>
    </div>
</div>
<style>
    /* Estilos para el carrito off-canvas */
    .cart-sidebar {
        position: fixed;
        right: -100%;
        /* Asegúrate de que comience fuera de la pantalla */
        top: 0;
        width: 600px;
        height: 100%;
        background-color: #fff;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
        z-index: 1000;
        transition: right 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    /* Ajustar ancho del carrito en pantallas pequeñas */
    @media (max-width: 768px) {
        .cart-sidebar {
            width: 100%;
            /* Ocupa el 100% de la pantalla en formato móvil */
        }
    }

    /* Cuando se abre la barra lateral */
    .cart-sidebar.open {
        right: 0;
    }


    .cart-header,
    .cart-footer {
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }

    .cart-header h2 {
        margin: 0;
    }

    .cart-body {
        flex-grow: 1;
        padding: 15px;
        overflow-y: auto;
    }

    .cart-footer {
        border-top: 1px solid #ddd;
    }

    .total {
        display: flex;
        justify-content: space-between;
        font-size: 1.2em;
        margin-bottom: 10px;
    }

    .checkout-button {
        width: 100%;
        background-color: #FE7C7F;
        border: none;
        padding: 10px;
        color: white;
        font-size: 1em;
        cursor: pointer;
    }

    .close-cart {
        font-size: 24px;
        cursor: pointer;
        color: #333;
        float: right;
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #ddd;
    }
</style>
<script>
    const checkoutButton = document.querySelector('.checkout-button');

    checkoutButton.addEventListener('click', () => {
        window.location.href = '/checkout';
    });

    document.addEventListener('DOMContentLoaded', function() {
        const cartIcon = document.getElementById('cart-icon');
        const cartSidebar = document.getElementById('cartSidebar');
        const closeCart = document.querySelector('.close-cart');
        const cartItemsList = document.getElementById('cartItemsList');
        const checkoutItems = document.getElementById('checkout_items');
        const cartTotal = document.getElementById('cartTotal');

        // Función para mostrar el carrito
        const openCart = () => {
            cartSidebar.classList.add('open');
        };

        // Función para ocultar el carrito
        const closeCartFunc = () => {
            cartSidebar.classList.remove('open');
        };

        // Obtener productos del carrito cuando se hace clic en el icono del carrito
        cartIcon.addEventListener('click', () => {
            fetch('/cart-products', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.products) {
                        cartItemsList.innerHTML = '';
                        let total = 0;
                        data.products.forEach(product => {
                            const li = document.createElement('li');
                            li.classList.add('cart-item');
                            li.innerHTML = `<span>${product.name} - ${product.pivot.quantity}x</span>
                                    <span>${product.price}$</span>`;
                            cartItemsList.appendChild(li);
                            total += product.price * product.pivot.quantity;
                        });
                        checkoutItems.textContent = data.count;
                        cartTotal.textContent = total.toFixed(2);
                        openCart();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        // Cerrar el carrito cuando se hace clic en la 'x'
        closeCart.addEventListener('click', closeCartFunc);

        // Cerrar el carrito cuando se hace clic fuera del carrito
        window.addEventListener('click', event => {
            if (event.target === cartSidebar) {
                closeCartFunc();
            }
        });
    });
</script>

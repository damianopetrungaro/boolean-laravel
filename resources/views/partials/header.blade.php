<nav class="navbar navbar-expand-md navbar-principal fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/asset/del-logo.png') }}" alt="Deliveroo">
        </a>

        <div class="navbar-nav">
            <a class="btn btn-light d-none d-lg-flex" href="{{ route('register') }}">
                <i class="fas fa-home"></i>
                {{ __('Registrati') }}
            </a>

            <a class="btn btn-light d-none d-lg-flex" href="{{ route('login') }}"> 
                <i class="fas fa-sign-in-alt"></i>
                {{ __('Accedi') }}
            </a>

            <div @click="showMenu = !showMenu" class="btn btn-light desk">
                <i class="fas fa-bars"></i>
                Menu
            </div>

            <div @click="showMenu = !showMenu" id="menu-2">
                <i class="fas fa-bars"></i>
            </div>
            
            <a @click="showCart = !showCart" class="nav-link cart" href="#">
                <i class="fas fa-cart-plus"></i>
                <small v-if="counter != 0" class="onCart" for="">@{{counter}}</small>
            </a>

            {{-- Mobile --}}
            <a class="navbar-brand mobile" href="{{ url('/') }}">
                <img src="{{ asset('img/asset/fav-icon.png') }}" alt="Deliveroo">
            </a>
        </div>

        <transition name="slide-down-fade">
            <div v-if="showMenu" class="menu" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li>
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('img/asset/del-logo-2.png') }}" alt="Deliveroo">
                        </a>
                    </li>
                    <li>
                        <a @click="showMenu = !showMenu">
                            <i class="fas fa-times"></i>
                        </a>
                    </li>
                </ul>
    
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                            <li class="nav-item">
                                <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                            </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-principal" href=""><i class="far fa-question-circle"></i>FAQ</a>
                            </li>

                        @endif
                            {{-- <li class="nav-item position-relative" @click="showCart = !showCart">
                                <a class="nav-link" href="#"><i class="fas fa-cart-plus"></i></a>
                                <ul v-if='showCart' class="position-absolute mt-4" style="width: 250px">
                                    <li v-for="(product, index) in shopCart" width=100>@{{ product.name }} @{{ product.price }}</li>
                                    <li>Total: @{{ finalPrice }}</li>
                                </ul>
                                <a href="{{ route('pay') }}">Vai al pagamento</a>
                            </li> --}}
                        @else
    
                        {{-- <li class="nav-item dropdown">
                            <a href="{{route('admin.home')}}" class="nav-link">Dashboard</a>
                        </li> --}}
                        <li class="nav-item dropdown">
                            <a href="{{route('admin.restaurants.index')}}" class="btn btn-primary">I tuoi ristoranti</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="{{route('admin.restaurants.create')}}" class="btn btn-primary">Aggiungi</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
    
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>

                <ul class="navbar-nav bottom">
                    <li class="nav-item">
                        <select class="minimal" id="languages-picker" name="languages">
                            <option value="italiano">Italiano</option>
                            <option value="inglese">English</option>
                        </select>
                    </li>
                    <li class="nav-item">
                        <select class="minimal" id="languages-picker" name="languages"><option value="italy">Italy</option></select>
                    </li>
                </ul>
            </div>
        </transition>

        {{-- CART MENU--}}
        <transition name="slide-down-fade">
            <div v-if="showCart" class="menu" id="cart-menu">
                <!-- Top Side Of Navbar -->
                <ul class="navbar-nav mr-auto top">
                    <li>
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('img/asset/del-logo-2.png') }}" alt="Deliveroo">
                        </a>
                    </li>
                    <li>
                        <a @click="showCart = !showCart">
                            <i class="fas fa-times"></i>
                        </a>
                    </li>
                </ul>
                {{-- SHOW CARRELLO LATERALE --}}
                <div class="basket-content">
                    {{-- overflow cart --}}
                    <div class="over">
                        <ul class="list-group basket" style="width: 300px">
                            <li
                            class="d-flex justify-content-between list-unstyled basket-item"
                            v-for="(product, index) in shopCart" width=100>
                                <p style="width: 60%">@{{ product.name }}</p>
                                <p class="price-single-product">@{{ product.price }}</p>
                            </li>
    
                            <li class="list-unstyled total">Totale: @{{ finalPrice }} €</li>
                        </ul>
                        <ul class="navbar-nav mr-auto">
                            <li>
                                <p>Grazie per aver scelto <strong>deliveroo!</strong></p>
                                <small>Tutte le consegne sono gratuite</small>
                                <p>
                                   <a href="" class="d-flex justify-content-start">Scopri di più</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="pay">
                        <a class="d-flex justify-content-center btn btn-primary" href="{{ route('pay') }}">Vai al pagamento</a>
                        <a class="d-flex justify-content-center btn text-danger" @click="puliziaCache" href="">Svuota carrello</a>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</nav>
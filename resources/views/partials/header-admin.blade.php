<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand desk" href="{{ url('/') }}">
            <img src="{{ asset('img/asset/del-logo-2.png') }}" alt="Deliveroo">
        </a>

        <div class="navbar-nav">

                <a href="{{route('admin.restaurants.index')}}" class="btn btn-primary ml-3 d-flex align-items-center">
                    <i class="fas fa-home" style="font-size: 20px"></i>
                    I tuoi ristoranti
                </a>

                <a href="{{route('admin.restaurants.create')}}" class="btn btn-primary ml-3 d-flex align-items-center">
                    <i class="fas fa-plus-circle" style="font-size: 20px"></i>
                    Aggiungi
                </a>
           
                <a class="btn btn-primary ml-3 d-flex align-items-center" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt" style="font-size: 20px"></i>
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

        </div>
    </div>
</nav>
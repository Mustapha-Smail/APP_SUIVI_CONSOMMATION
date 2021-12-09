<div class="side-menu">
    <div class="brand-name">
        <a class="nav-link" href="{{route('dashboard')}}">
            <img src="{{URL::asset('images/logo.png')}}" alt="logo" width="80%">
        </a>
    </div>
    <ul>
        <li>
            <a href="{{route('dashboard')}}">
                <span class="material-icons" title="Dashboard">
                    dashboard
                </span>
                <span class="side-li-text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{route('profile')}}">
                <span class="material-icons" title="Profile">
                    account_circle
                </span>
                <span class="side-li-text">Profile</span>
            </a>
        </li>
        <li>
            <a href="{{route('proprietaire.maisons')}}">
                <span class="material-icons" title="Home">
                    home
                </span>
                <span class="side-li-text">Mes proprietés</span>
            </a>
        </li>
        <li>
            <a href="{{route('locataire.appartements')}}">
                <span class="material-icons">
                    apartment
                </span>
                <span class="side-li-text">Mes locations</span>
            </a>
        </li>
        <li>
            <form action="{{route('logout')}}" method="post" id="logout">
                @csrf
                <a onclick="document.getElementById('logout').submit()">
                    <span class="material-icons" title="Log out">
                        logout
                    </span>
                    <span class="side-li-text">Log out</span> 
                </a>
            </form>
        </li>
    </ul>
</div>
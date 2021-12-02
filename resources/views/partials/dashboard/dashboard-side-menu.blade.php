<div class="side-menu">
    <div class="brand-name">
        <a class="nav-link" href="#">
            <img src="{{URL::asset('images/logo.png')}}" alt="logo" width="80%">
        </a>
    </div>
    <ul>
        <li>
            <span class="material-icons" title="Dashboard">
                dashboard
            </span>
            <a href="{{route('dashboard')}}" class="side-li-text">Dashboard</a>
        </li>
        <li>
            <span class="material-icons" title="Profile">
                account_circle
            </span>
            <a href="{{route('profile')}}" class="side-li-text">Profile</a>
        </li>
        <li>
            <span class="material-icons" title="Home">
                home
            </span>
            <span class="side-li-text">Home</span>
        </li>
        <li>
            <span class="material-icons" title="Settings">
                settings
            </span>
            <span class="side-li-text">Settings</span>
        </li>
        <li>
            <span class="material-icons" title="Log out">
                logout
            </span>
            <form action="{{route('logout')}}" method="post" id="logout">
                @csrf
                <a class="side-li-text" onclick="document.getElementById('logout').submit()">
                    Log out
                </a>
            </form>
        </li>
    </ul>
</div>
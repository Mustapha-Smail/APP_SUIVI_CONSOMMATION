<div class="header">
    <div class="nav">
        <form action="#" class="search form-inline">
            <input type="text" class="form-control" name="name" id="name" placeholder="Search...">
            <button type="submit" class="btn btn-md btn-search d-flex justify-content-center align-items-center">
                <span class="material-icons">
                    search
                </span>
            </button>
        </form>
    </div>
    <div class="dropdown">
        <button class="btn user" type="button" id="dropdownMenuButton"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="material-icons profile-picture">
                account_circle
            </span>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{route('profile')}}">Profile</a>
            <a class="dropdown-item" href="#">Settings</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item" type="submit">Log out</button>
            </form>
        </div>
    </div>
</div>
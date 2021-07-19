<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow mb-5 shadow-white">
    <div class="container-fluid">
        <a class="navbar-brand mx-auto" href="#">
            <img src="{{asset('assets/images/logo.png')}}" width="32" height="32"
                 class="rounded-circle shadow border mx-2" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav pe-2">
                <li class="nav-item">
                    <a class="nav-link" href="/user">
                        <span class="">Home</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Options
                    </a>
                    <ul class="dropdown-menu shadow border" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item text-start hover-theme" href="/user/symptoms">
                                Symptoms
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-start hover-theme" href="/user/sensor-readings">
                                Sensors and Readings
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-start hover-theme" href="/user/breast-cancer">
                                Breast Cancer
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{$data['user_info']['avatar']}}"
                             width="32" height="32" class="rounded-circle shadow border mx-2"
                             alt="User {{$data['user_info']['full_name']}} Avatar">
                        <span class="mx-1">
                            {{$data['user_info']['full_name']}}
                        </span>
                    </a>
                    <ul class="dropdown-menu shadow border" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item text-start hover-theme" href="/user/profile">
                                Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-start hover-theme" href="/user/tokens">
                                Tokens
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-start hover-theme" href="/user/settings">
                                Settings
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-start hover-theme" href="/logout">
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

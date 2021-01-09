<nav class="navbar navbar-expand-md navbar-light" style="background-color:#dea8a6;">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>
            <ul class="nav navbar-nav">

                @if(isset($_SESSION["uuid"]))
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/lsp/public/"><span uk-icon="tag"></span> catalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/lsp/public/products/"><span uk-icon="thumbnails"></span> Product</a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/lsp/public/records/"><span uk-icon="history"></span> Logs</a>
                </li>

                @else

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/lsp/public/"><span uk-icon="tag"></span> catalog</a>
                </li>

                @endif
            </ul>
                    <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if(isset($_SESSION["uuid"]))

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ $_SESSION["name"] }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="/lsp/public/logout/">
                               <span uk-icon="sign-out"></span> Logout
                            </a>

                            <form id="logout-form" action="AccessController@logout" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/lsp/public/login/"><span uk-icon="sign-in"></span> Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/lsp/public/register/"><span uk-icon="user"></span> Register</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

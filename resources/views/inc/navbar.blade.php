<?php if(!isset($_SESSION)){
    session_start();
} ?>
<div class="container">
    <header class="blog-header py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">

        </div>
        <div class="col-4 text-center">
          <h3><span class="blog-header-logo text-dark">{{ config('app.name', 'LSProduct') }}</span></h3>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          @if(isset($_SESSION["name"]))
        <a id="navbarDropdown" class="dropdown-toggle  btn-sm btn-outline-secondary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ $_SESSION["name"] }} <span class="caret"></span>
            </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

               <a class="dropdown-item btn" href="/lsp/public/logout/" >
                   <span uk-icon="sign-out"></span> Logout
               </a>

               <form id="logout-form" action="AccessController@logout" method="POST" style="display: none;">
                 @csrf
               </form>
            </div>
      @else
        <a class="nav-link btn btn-sm btn-outline-secondary" href="/lsp/public/login/" ><span uk-icon="sign-in"></span> Login</a>&nbsp;
        <a class="nav-link btn btn-sm btn-outline-secondary" href="/lsp/public/register/" ><span uk-icon="user"></span> Register</a>
        @endif
        </div>
      </div>
    </header>

    <hr size=2 width="100%">

    <div class="nav-scroller py-1 mb-2 text-center">
      <nav class="nav d-flex justify-content-between ">

      @if(isset($_SESSION["name"]))
        <a class="p-2 link-secondary btn btn-sm btn-outline-info" href="/lsp/public/"><span uk-icon="tag"></span> catalog</a>
        <a class="p-2 link-secondary btn btn-sm btn-outline-info" href="/lsp/public/products/"><span uk-icon="thumbnails"></span> Product</a>
        <a class="p-2 link-secondary btn btn-sm btn-outline-info" href="/lsp/public/records/"><span uk-icon="history"></span> Logs</a>
      @endif
      </nav>
    </div>
  </div>

<!-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}"><img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
    Kuraw Cafe</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="{{ url('/') }}">Home</a>
        <a class="nav-link" href="{{ url('/about') }}">About Us</a>
        <a class="nav-link" href="{{ url('/gallery') }}">Gallery</a>
        <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
      </div>
    </div>
  </div>
</nav> -->

<style>
    header{
    position: fixed;
    width: 100%;
    top: 0;
    right: 0;
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 50px;
    }
    .logo img{
        width: 200px;
        height: auto;
    }
    .navlist{
        display: flex;
    }
    .navlist a{
        color: #051b4a;
        font-size: 14px;
        text-transform: uppercase;
        font-weight: 700;
        padding: 4px 5px;
        margin: 0 22px;
        border-bottom: 2px solid transparent;
        transition: all .42s;   
    }
    .navlist a:hover{
        color: #051b4a;
        border-bottom: 2px solid #fff;
    }
    #menu-icon{
        color: #fff;
        font-size: 35px;
        z-index: 10001;
        cursor: pointer;
        display: none;
    }
    .home-btn{
        display: inline-block;
        color: #fff;
        text-transform: uppercase;
        border: 2px solid #051b4a;
        background-color: #051b4a;
        padding: 10px 25px;
        border-radius: 30px;
        transition: all .42s;
    }
    .home-btn:hover{
        background-color: transparent;
        color: #051b4a;
        border: 2px solid #051b4a;
    }
</style>

<header>
        <a href="#" class="logo"><img src="images/logo1.png" alt=""></a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navlist">
            <li><a class="nav-link" href="{{ url('/') }}">Home</a></li>
            <li><a class="nav-link" href="{{ url('/about') }}">About Us</a></li>
            <li><a class="nav-link" href="{{ url('/menu') }}">Menu</a></li>
            <li><a class="nav-link" href="{{ url('/gallery') }}">Gallery</a></li>
            <li><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
        </ul>

        <a class="nav-link home-btn" href="{{ url('/login') }}" class="home-btn">Kuraw Now!</a>
</header>

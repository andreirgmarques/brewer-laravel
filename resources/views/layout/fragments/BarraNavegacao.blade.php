<nav class="navbar  navbar-fixed-top  navbar-default  js-sticky-reference" id="main-navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand  hidden-xs" href="#">
                <img alt="AlgaWorks" src="{{url("images/logo.png")}}"/>
            </a>

            <ul class="nav  navbar-nav">
                <li>
                    <a href="#" class="js-sidebar-toggle"><i class="fa  fa-bars"></i></a>
                </li>
            </ul>
        </div>

        <ul class="nav navbar-nav  navbar-right">
            <li><p class="navbar-text">{{\Illuminate\Support\Facades\Auth::user()->nome}}</p></li>
            <li>
                <a href="{{url("/logout")}}"><em class="fa  fa-sign-out"></em></a>
            </li>
        </ul>
    </div>
</nav>

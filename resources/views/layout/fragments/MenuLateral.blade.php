<aside class="aw-layout-sidebar js-sidebar">
    <div class="aw-layout-sidebar__content">

        <nav class="aw-menu js-menu">
            <ul class="aw-menu__list">

                <li class="aw-menu__item  @if(url()->current() ==  url("/")) is-active @endif">
                    <a href="{{url("/")}}">
                        <i class="fa fa-fw fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="aw-menu__item">
                    <a href="#">
                        <i class="fa fa-fw fa-credit-card"></i><span>Vendas</span>
                        <i class="aw-menu__navigation-icon fa"></i>
                    </a>

                    <ul class="aw-menu__list aw-menu__list--sublist">
                        <li class="aw-menu__item aw-menu__item--link @if(url()->current() ==  url("/vendas/nova")) is-active @endif">
                            <a href="{{url("/vendas/nova")}}">Cadastro de Venda</a>
                        </li>
                        <li class="aw-menu__item aw-menu__item--link @if(url()->current() ==  url("/vendas")) is-active @endif">
                            <a href="{{url("/vendas")}}">Pesquisa de Vendas</a>
                        </li>
                    </ul>
                </li>

                <li class="aw-menu__item">
                    <a href="#">
                        <i class="fa fa-fw fa-truck"></i><span>Estoque</span>
                        <i class="aw-menu__navigation-icon fa"></i>
                    </a>

                    <ul class="aw-menu__list aw-menu__list--sublist">
                        <li class="aw-menu__item aw-menu__item--link @if(strpos(url()->current(), "/estilos") > 0) is-active @endif">
                            <a href="{{url("/estilos")}}">Estilos</a>
                        </li>
                        <li class="aw-menu__item aw-menu__item--link @if(strpos(url()->current(), "/cervejas") > 0) is-active @endif">
                            <a href="{{url("/cervejas")}}">Cervejas</a>
                        </li>
                    </ul>
                </li>

                <li class="aw-menu__item">
                    <a href="#">
                        <i class="fa fa-fw fa-file-text"></i><span>Cadastros</span>
                        <i class="aw-menu__navigation-icon fa"></i>
                    </a>

                    <ul class="aw-menu__list aw-menu__list--sublist">
                        <li class="aw-menu__item aw-menu__item--link @if(strpos(url()->current(), "/cidades") > 0) is-active @endif">
                            <a href="{{url("/cidades")}}">Cidades</a>
                        </li>
                        <li class="aw-menu__item aw-menu__item--link @if(strpos(url()->current(), "/clientes") > 0) is-active @endif">
                            <a href="{{url("/clientes")}}">Clientes</a>
                        </li>
                        <li class="aw-menu__item aw-menu__item--link @if(strpos(url()->current(), "/usuarios") > 0) is-active @endif">
                            <a href="{{url("/usuarios")}}">Usuários</a>
                        </li>
                    </ul>
                </li>

                <li class="aw-menu__item">
                    <a href="#">
                        <i class="fa fa-fw fa-file-pdf-o"></i><span>Relatórios</span>
                        <i class="aw-menu__navigation-icon fa"></i>
                    </a>

                    <ul class="aw-menu__list aw-menu__list--sublist">
                        <li class="aw-menu__item aw-menu__item--link @if(strpos(url()->current(), "/relatorios") > 0) is-active @endif">
                            <a href="{{url("/relatorios/vendasEmitidas")}}">Vendas Emitidas</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <title>{{$titulo or "Brewer"}}</title>

    <link rel="stylesheet" type="text/css" href="{{url("layout/stylesheets/vendors.min.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{url("layout/stylesheets/algaworks.min.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{url("layout/stylesheets/application.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{url("stylesheets/vendors/bootstrap-datepicker.standalone.min.css}")}}"/>
    <link rel="stylesheet" type="text/css" href="{{url("stylesheets/brewer.css")}}" />
    @stack("stylesheet-extra")

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="aw-layout-page">
        @include("layout.fragments.BarraNavegacao")

        @include("layout.fragments.MenuLateral")

        <section class="aw-layout-content  js-content">
            @yield("conteudo")
        </section>

        @include("layout.fragments.Footer")
    </div>

    <script src="{{url("layout/javascripts/vendors.min.js")}}"></script>
    <script src="{{url("layout/javascripts/algaworks.min.js")}}"></script>
    <script src="{{url("javascripts/vendors/jquery.mask.min.js")}}"></script>
    <script src="{{url("javascripts/vendors/jquery.maskMoney.min.js")}}"></script>
    <script src="{{url("javascripts/vendors/jquery.masknumber.min.js")}}"></script>

    <script src="{{url("javascripts/vendors/bootstrap-datepicker.min.js")}}"></script>
    <script src="{{url("javascripts/vendors/bootstrap-datepicker.pt-BR.min.js")}}"></script>
    <script src="{{url("javascripts/vendors/numeral.min.js}")}}"></script>
    <script src="{{url("javascripts/vendors/pt-br.min.js")}}"></script>

    <script src="{{url("javascripts/brewer.js")}}"></script>

    @stack("javascript-extra")
</body>
</html>
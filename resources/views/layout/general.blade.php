<!DOCTYPE html>
<html lang="es" class="h-100">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REPORTES DE SERVICIO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel='stylesheet' href='{{ asset('css/app.css') }}'>
    @yield('css')
</head>
<body class="d-flex flex-column h-100" >
       <!-- Begin page content -->
    <main role="main">
        <header class="row text-center" id="header">
            <div class="col-sm-2 d-none d-sm-block">
                <img class="img-thumbnail border-0" src='{{ asset('images/unam.jpg') }}'  width="130" height="120 ">
            </div>
            <div class="col-sm-8 text-center">
                    <br>
                    <h4 class="align-middle d-none d-sm-block" id='card_computo'>UNIVERSIDAD NACIONAL AUT&Oacute;NOMA DE M&Eacute;XICO</h4>
                    <h4 class="align-middle d-block d-sm-none" id='card_computo'>UNAM</h4>
                    <br>
                    <h4 class="align-middle d-none d-sm-block" id='card_computo'>DIRECCI&Oacute;N GENERAL DE INCORPORACI&Oacute;N Y REVALIDACI&Oacute;N DE ESTUDIOS</h4>
                    <h4 class="align-middle d-block d-sm-none" id='card_computo'>DGIRE</h4>
                    <div class="linea"></div>
                    <p><h4 class="align-middle" id="card_computo">REPORTES DE SERVICIO</h4></p>
            </div>
            <div class="col-sm-2 d-none d-sm-block">
                <img class="img-thumbnail border-0"  src='{{ asset('images/dgire.png') }}'  width="100" height="90">
            </div>

        </header>
        <div class="container p-3">
          @if (session('success'))
                <div class="alert alert-success text-center">
                    {!! session('success') !!}
                </div>
            @endif
            @if (session('failure'))
                <div class="alert alert-danger">
                    {!! session('failure') !!}
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-info">
                    {!! session('status') !!}
                </div>
            @endif
            @yield('content')
        </div>
        <div class="footer text-center">
            <span class="align-middle" id="card_computo">&copy; 2022 DGIRE</span>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    @yield('script')
</body>
</html>

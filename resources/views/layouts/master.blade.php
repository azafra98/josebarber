<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="-l8OkneJnbM1cUPUGYEaajz3nQS7Ixu2qA5-ZFu2EQQ" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{url('css/home.css')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
    <title>JOSEABARBER</title>
    <link rel="shortcut icon" href="{{asset("img/logoJose.png")}}" />

</head>
<body>
@include('partials.navbar')
<div class="container-fluid">
    @yield('content')
</div>
@include('partials.footer')
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script src="{{url("js/AjaxCalendario.js")}}"></script>
<script src="{{url("js/updateCitasCalendario.js")}}"></script>
<script src="{{url("js/newAjaxCalendario.js")}}"></script>
<script src="{{url("js/vips.js")}}"></script>
<script>
    document.getElementById('imagenusuario').addEventListener('change', function(e) {
        var file = e.target.files[0];

        if (file) {
            var fileType = file.type;
            var fileSize = file.size;

            // Lista de tipos de imagen permitidos
            var validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

            // Comprobamos si el archivo es una imagen válida
            if (!validImageTypes.includes(fileType)) {
                alert('El archivo seleccionado no es una imagen válida. Solo se permiten formatos JPG, PNG, GIF o WEBP.');
                e.target.value = ""; // Limpiar el campo
                return;
            }

            // Comprobamos si el tamaño del archivo es menor a 0.5MB (512000 bytes)
            if (fileSize > 512000) {
                alert('La imagen debe pesar menos de 0.5MB.');
                e.target.value = ""; // Limpiar el campo
                return;
            }
        }
    });
</script>
<!--<script src="https://cdn.tiny.cloud/1/tinypng.js"></script>-->
</body>
</html>

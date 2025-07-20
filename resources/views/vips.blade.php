@extends('layouts.master')
@section('content')




<div class="row mt-5">
    <div class="col-sm-12">
        <h1 class="text-center text-title">Club de vips de JoseaBarber</h1>
    </div>
</div>
<div class="row mt-3 mb-5 text-center" style="justify-content: center;">
    <div>
        <div class="card vip_card">
            <div class="vip_card__face vip_card__face--front"><img src="{{asset('img/Tarjeta-Vip-Delante.jpg')}}" alt="Tarjeta Vip Delante" style="width: 300px;
                height: 200px;;"></div>
            <div class="vip_card__face vip_card__face--back"><img src="{{asset('img/Tarjeta-Vip-Trasera.jpg')}}" alt="Tarjeta Vip Trasera" style="width: 300px;
                height: 200px;;"></div>
        </div>
    </div>
</div>

<div class="row mt-3 mb-5" style="padding-left: 20%; padding-right: 20%">
    <p class="text-justify">
        ¡Bienvenido a JoseaBarber! Queremos agradecer a nuestros clientes leales ofreciendo una promoción increíble. Por cada diez cortes de pelo que reciba en nuestro establecimiento durante un año, el siguiente corte será totalmente gratuito.

        Nos enorgullece ofrecer un servicio de alta calidad y excelencia en cada corte. Nuestros barberos son expertos en el arte de la barbería y están comprometidos en proporcionar a nuestros clientes un corte de pelo excepcional. Además, ofrecemos un ambiente acogedor y amigable para asegurarnos de que su visita sea siempre una experiencia agradable.
        
        En JoseaBarber valoramos a nuestros clientes y estamos comprometidos a hacer todo lo posible para satisfacer sus necesidades. Con nuestra promoción de fidelización, no solo ahorrará dinero, sino que también podrá disfrutar de la comodidad y la tranquilidad de saber que su próxima visita a nuestra barbería será aún más gratificante.
        
        Así que, ¿a qué está esperando? ¡Visite JoseaBarber hoy mismo y comience a disfrutar de nuestro excepcional servicio de corte de pelo y nuestra promoción de fidelización! Estamos ansiosos por verle pronto y asegurarnos de que se vea y se sienta mejor que nunca.
    </p>

    <h3 style="color: #edde66">¿Cómo puedo unirme al club vip de JoseaBarber?</h3>

    <p class="text-justify">
        Para unirte al club VIP de JoseaBarber, necesitarás solicitar la tarjeta VIP al propio JoseaBarber. Una vez que tengas la tarjeta, podrás comenzar a acumular citas para obtener tu próxima sesión de pelado gratis.

        Cada vez que visites JoseaBarber para recibir un servicio de pelado, él se encargará de marcar tu tarjeta VIP para indicar que has asistido a una cita. Después de haber acumulado 10 citas, recibirás una sesión de pelado completamente gratis como recompensa por tu lealtad.

        La tarjeta VIP es una gran manera de obtener beneficios adicionales por tu fidelidad a JoseaBarber. Además de la oportunidad de obtener una sesión de pelado gratis, también recibirás promociones exclusivas y ofertas especiales solo para miembros del club VIP.

        Así que si quieres unirte al club VIP de JoseaBarber, asegúrate de pedir tu tarjeta VIP y comenzar a acumular citas para obtener tu próxima sesión de pelado gratis. ¡Disfruta de los beneficios de ser un miembro VIP!
    </p>
</div>



@endsection

<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Corte;
use App\DiasNoDisponibles;
use App\Horario;
use App\Mail\MensajeConfirmacion;
use App\Reserva;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', array('img' => Banner::all()));
    }

    public function citas(){
        if (Auth::user()->rol != "baneado") {
            date_default_timezone_set("Europe/Madrid");
            $fechaActual = date("Y-m-d");
            $horaActual = date("H:i:sa");
            $contador = 0;

            $contador+=count(Reserva::join('horarios','idHorario','=','horarios.id')
                ->where('reservas.idCliente','=', auth()->id())
            ->where('reservas.dia','=', $fechaActual)
            ->where('horarios.horaComienzo','>',$horaActual)->get());

            $contador+=count(Reserva::join('horarios','idHorario','=','horarios.id')
                ->where('reservas.idCliente','=', auth()->id())
                ->where('reservas.dia','>', $fechaActual)->get());

            if ($contador >= 1) {
                return redirect('/miPerfil')->withInput()->withErrors('No se pueden pedir más de dos citas.');
            }
            else {
                $cortes = Corte::all();
                return view ('citas', array("cortes" => $cortes));
            }
        }
        else {
            /*return redirect('/miPerfil')->withInput()->withErrors('Su perfil cuenta con una restrición impuesta por Joseabarber para pedir más citas, 
            algunos de los motivos más habituales pueden ser varios retrasos acumulados en las citas, falta de asistencia o incluso impagos de las 
            mismas. Para más información puede consultarlo con él directamente a traves del correo joseabarberlucena@gmail.com o el número +34 689 84 54 65');*/

            //return redirect('/control/usuarios')->with('error', 'Error al eliminar el usuario: Problema en la base de datos.');
            return redirect('/miPerfil')->with('error', 'Su perfil cuenta con una restrición impuesta por Joseabarber para pedir más citas, 
            algunos de los motivos más habituales pueden ser varios retrasos acumulados en las citas, falta de asistencia o incluso impagos de las 
            mismas. Para más información puede consultarlo con él directamente a traves del correo joseabarberlucena@gmail.com o el número +34 689 84 54 65');
        }
    }

    public function getVip(){
        return view ('vips');
    }

    public function getMapa(){
        return view ('localizanos');
    }

    public function getRedesSociales(){
        return view('redesSociales');
    }

    public function getBiografia() {
        return view('biografia');
    }

    public function getAyuda() {
        return view('ayuda');
    }

    public function getNovedades() {
        return view('novedades');
    }

    public function getEntradas() {
        return view('entradas');
    }

    public function getPerfil()
    {
        $user = Auth::user();
        return view('miPerfil', array('user'=> $user));
    }

    public function editarPerfil(){
        $user = User::find(auth()->id());
        return view('editarPerfil', array('u' => $user));
    }

    public function postEditarPerfil(Request $request){
        // Ejecutamos el código: validamos que 'imagenusuario' sea una imagen y pese como máximo 0.5MB
        // >>> LÍNEA MODIFICADA: Agregamos validación para 'imagenusuario'
        $request->validate([
            'imagenusuario' => 'nullable|image|max:512',
        ]);

        $usuario = User::find(auth()->id());

        $usuario->nombre = $request->input('nombre');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->email = $request->input('email');
        $usuario->telefono = $request->input('telefono');
        $usuario->insta_user = $request->input('insta_user');

        if($request->input('password') != '') {
            $usuario->password = bcrypt($request->input('password'));
        }

        if ($request->hasFile('imagenusuario')) {
            // Ejecutamos el código: generamos un nombre único y movemos el archivo a la carpeta 'img'
            $file = $request->file('imagenusuario');
            $fich_unic = time() . "-" . $file->getClientOriginalName();
            $file->move('img', $fich_unic);
            $usuario->imagenusuario = 'img/' . $fich_unic;
        } else {
            $usuario->imagenusuario = $request->input('imagenAntigua');
        }

        $usuario->save();
        return redirect('/miPerfil');
    }

    function action(Request $request){
        $mañana = '';
        $tarde = '';
        $query = $request->get('query');

        date_default_timezone_set("Europe/Madrid");
        $fechaActual = date("Y-m-d");
        $fechaEntrada = date($query);
        $horaActual = date("H:i:sa");

        if ($fechaActual == $fechaEntrada){
            $data = Horario::whereNotExists(function($q) use ($query)
            {
                $q->select(DB::raw(1))
                    ->from('reservas')
                    ->whereRaw('horarios.id = reservas.idHorario')
                    ->where('reservas.dia','=',date("$query"));
            })->where('horarios.horaComienzo','>', $horaActual)->get();
        } else {
            $data = Horario::whereNotExists(function($q) use ($query)
            {
                $q->select(DB::raw(1))
                    ->from('reservas')
                    ->whereRaw('horarios.id = reservas.idHorario')
                    ->where('reservas.dia','=',date("$query"));
            })->get();
        }

        $total_row = $data->count();
        if($total_row>0){
            $diasNoDisponibles = DiasNoDisponibles::all();
            $totalDiasNoDisponibles = $diasNoDisponibles->count();

            $citasMañana = 0;
            $citasTarde = 0;
            for($i = 0; $i< $data->count();$i++){
                if ($data[$i]->turno == "mañana"){
                    $citasMañana++;
                } else if($data[$i]->turno = "tarde"){
                    $citasTarde++;
                }
            }
            if ($citasMañana == 0)
                $mañana.= "<p  class='text-center'>No disponible</p>";
            if ($citasTarde == 0)
                $tarde .= "<p  class='text-center'>No disponible</p>";

            if ($fechaActual > $fechaEntrada){
                $mañana.= "<p  class='text-center'>Elige una fecha válida</p>";
                $tarde.= "<p  class='text-center'>Elige una fecha válida</p>";
            } else{
                if ($totalDiasNoDisponibles > 0){
                    $diaActual = false;
                    foreach ($diasNoDisponibles as $dia){
                        if ($dia->dia == $query){
                            $diaActual = true;
                        }
                    }
                    if ($diaActual){
                        $mañana.= "<p  class='text-center'>Cerrado</p>";
                        $tarde.= "<p  class='text-center'>Cerrado</p>";
                    } else if (date('w', strtotime($query)) == 0){
                        //Si es domingo se cierra
                        $mañana.= "<p  class='text-center'>Cerrado</p>";
                        $tarde.= "<p  class='text-center'>Cerrado</p>";
                    } else if(date('w', strtotime($query)) == 6){
                        //Si es sabado cerramos por la tarde
                        foreach ($data as $datos){
                            if ($datos->turno == "mañana"){
                                $mañana.= "<div class='col-xl-2 col-md-3 col-sm-6 p-1'><label class='btn btn-primary btn-citas'>
                            <input type='radio' class='radio-horario' name='idHorario' required value='".$datos->id."' autocomplete='off'> ".date("H:i", strtotime($datos->horaComienzo))."
                       </label></div>";
                            }
                        }
                        $tarde.= "<p  class='text-center'>Cerrado</p>";
                    }else {
                        foreach ($data as $datos) {
                            if ($datos->turno == "mañana") {

                                $mañana .= "<div class='col-xl-2 col-md-3 col-sm-6 p-1'><label class='btn btn-primary btn-citas'>
                                <input type='radio' name='idHorario' class='radio-horario' required value='" . $datos->id . "' autocomplete='off'>" . date("H:i", strtotime($datos->horaComienzo)) . "
                            </label></div>";


                            } else {

                                $tarde .= "<div class='col-xl-2 col-md-3 col-sm-6 p-1'><label class='btn btn-primary btn-citas'>
                                                    <input type='radio' name='idHorario' class='radio-horario' required value='" . $datos->id . "' autocomplete='off'>" . date("H:i", strtotime($datos->horaComienzo)) . "
                                                  </label></div>";

                            }
                        }
                    }
                }
                 else{
                    if (date('w', strtotime($query)) == 0){
                        //Si es domingo se cierra
                        $mañana.= "<p  class='text-center'>Cerrado</p>";
                        $tarde.= "<p  class='text-center'>Cerrado</p>";
                    } else if(date('w', strtotime($query)) == 6){
                        //Si es sabado cerramos por la tarde
                        foreach ($data as $datos){
                            if ($datos->turno == "mañana"){
                                $mañana.= "<div class='col-xl-2 col-md-3 col-sm-6 p-1'><label class='btn btn-primary btn-citas'>
                                <input type='radio' name='idHorario' class='radio-horario' required value='".$datos->id."' autocomplete='off'> ".date("H:i", strtotime($datos->horaComienzo))."
                           </label></div>";
                            }
                        }
                        $tarde.= "<p  class='text-center'>Cerrado</p>";
                    } else{
                        foreach ($data as $datos){
                            if ($datos->turno == "mañana"){
                                $mañana.= "<div class='col-xl-2 col-md-3 col-sm-6 p-1''><label class='btn btn-primary btn-citas'>
                                    <input type='radio' name='idHorario' class='radio-horario' required value='".$datos->id."' autocomplete='off'>".date("H:i", strtotime($datos->horaComienzo))."
                                </label></div>";
                            } else {
                                $tarde.= "<div class='col-xl-2 col-md-3 col-sm-6 p-1''><label class='btn btn-primary btn-citas'>
                                    <input type='radio' name='idHorario' class='radio-horario' required value='".$datos->id."' autocomplete='off'>".date("H:i", strtotime($datos->horaComienzo))."
                                 </label></div>";
                            }
                        }
                    }
                }
            }

        }else{
            $mañana.= "<p  class='text-center'>No hay citas disponibles por la mañana</p>";
            $tarde.= "<p  class='text-center'>No hay citas disponibles por la tarde</p>";
        }

        $datos = array(
            'mañana'  => $mañana,
            'tarde' => $tarde
        );
        echo json_encode($datos);
    }

    public function addReserva(Request $request){
        if(count(Reserva::where('idHorario', '=', $request->input('idHorario'))->where('dia', '=', $request->input('dia'))->get()) > 0) {
            return redirect()->back()->withInput()->withErrors('Acabamos de recibir una reserva para esa hora. Por favor, elija otra');
        } else if($request->input('idHorario') == null){
            return redirect()->back()->withInput()->withErrors('Por favor, elija una hora para la cita.');
        }else {
            // Guardar la reserva
            $reserva= new Reserva();
            $reserva->idCliente=auth()->id();
            $reserva->idCorte=$request->input("idCorte");
            $reserva->idHorario=$request->input("idHorario");
            $reserva->dia=$request->input('dia');
            $reserva->save();

            // Obtener información del corte y horario
            $tipoCorte = Corte::where('id','=',$reserva->idCorte)->first();
            $tramoHorario = Horario::where('id','=',$reserva->idHorario)->first();

            // Antigua versión
            /*
            $data = array(
                'email_address'=> Auth::user()->email,
                'cc'=>null,
                'subject'=>'Confirmación de reserva',
                'nombre' => Auth::user()->nombre,
                'dia' => date('d-m-Y', strtotime($request->input('dia'))),
                'horaComienzo' => date('H:i', strtotime($tramoHorario->horaComienzo)),
                'tipoPelado' => $tipoCorte->tipoPelado,
            );
            */

            // Calcular hora de inicio y fin
            $horaInicio = date('Ymd\THis', strtotime($request->input('dia') . ' ' . $tramoHorario->horaComienzo));
            $horaFin = date('Ymd\THis', strtotime($request->input('dia') . ' ' . $tramoHorario->horaComienzo . '+ 30 minutes'));

            // Guardar las variables en la sesión
            session()->flash('reserva_exitosa', true);
            session()->flash('hora_inicio', $horaInicio);
            session()->flash('hora_fin', $horaFin);

            // Enviar el correo
            $data = array(
                'email_address'=> Auth::user()->email,
                'cc'=>null,
                'subject'=>'Confirmación de reserva',
                'nombre' => Auth::user()->nombre,
                'dia' => date('d-m-Y', strtotime($request->input('dia'))),
                'horaComienzo' => date('H:i', strtotime($tramoHorario->horaComienzo)),
                'horaInicio' => date('Ymd\THis', strtotime($request->input('dia') . ' ' . $tramoHorario->horaComienzo)),
                'horaFin' => date('Ymd\THis', strtotime($request->input('dia') . ' ' . $tramoHorario->horaComienzo . '+ 30 minutes')),
                'tipoPelado' => $tipoCorte->tipoPelado,
            );

            try {
                Mail::send('emails.mensajeConfirmacion', $data, function($message) use($data) {
                    $message->from('microdiskInformatica20@gmail.com', 'JoseaBarber');
                    $message->to($data['email_address']);
                    if($data['cc'] != null){
                        $message->cc($data['cc']);
                    }
                    $message->subject($data['subject']);
                });
    
                return redirect('/miPerfil')->with('mensaje', 'Reserva con éxito, recuerda añadirla al calendario');
    
            } catch (\Swift_TransportException $e) {
                // Captura errores específicos del transporte SMTP (como problemas de autenticación).
                return redirect()->back()->withInput()->withErrors('Error al enviar el correo de confirmación. Las credenciales SMTP del correo se cambiaron.');
    
            } catch (\Exception $e) {
                // Captura cualquier otro tipo de error que pudiera ocurrir.
                return redirect()->back()->withInput()->withErrors('Ocurrió un error inesperado. Por favor, inténtalo de nuevo.');
            }
        }
    }

    public function cancelarReserva(Request $request) {
        $reserva = Reserva::find($request->input('id'));
        $tipoCorte = Corte::where('id','=',$reserva->idCorte)->first();
        $tramoHorario = Horario::where('id','=',$reserva->idHorario)->first();
        $dia = $reserva->dia;
        $reserva->delete();


        $data = array(
            'email_address'=> Auth::user()->email,
            'cc'=>null,
            'subject'=>'Confirmación de anulación reserva',
            'nombre' => Auth::user()->nombre,
            'dia' => date('d-m-Y', strtotime($dia)),
            'horaComienzo' => date('H:i', strtotime($tramoHorario->horaComienzo)),
            'tipoPelado' => $tipoCorte->tipoPelado

        );

        try {
            Mail::send('emails.mensajeAnularReserva', $data, function($message) use($data) {
                $message->from('microdiskInformatica20@gmail.com', 'JoseaBarber');
                $message->to($data['email_address']);
                if($data['cc'] != null){
                    $message->cc($data['cc']);
                }
                $message->subject($data['subject']);
            });
    
            return redirect('/miPerfil')->with('mensaje', 'Reserva cancelada');

        } catch (\Swift_TransportException $e) {
            // Captura errores específicos del transporte SMTP (como problemas de autenticación).
            return redirect()->back()->withInput()->withErrors('Error al enviar el correo de cancelación. Las credenciales SMTP del correo se cambiaron.');

        } catch (\Exception $e) {
            // Captura cualquier otro tipo de error que pudiera ocurrir.
            return redirect()->back()->withInput()->withErrors('Ocurrió un error inesperado. Por favor, inténtalo de nuevo.');
        }
    }

    public function politicas() {
        return view('politicas');
    }

    /*
    public function guardarImagen(Request $request) {
        $imagen = $request->file('image');

        // Guarda la imagen comprimida
        $ruta = $imagen->storeAs('imagenes', 'imagen-comprimida.png');

        // Continúa con el resto de la lógica de tu aplicación
    }
    */

}

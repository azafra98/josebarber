<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Corte;
use App\Models\DiasNoDisponibles;
use App\Models\Field;
use App\Models\Horario;
use App\Models\NomCliente;
use App\Models\Rent;
use App\Models\Reserva;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function users(Request $request) {
        //$users = User::apellidos($request->get('apellidos'))->email($request->get('email'))->paginate(4);
        $users = User::apellidos($request->get('apellidos'))->email($request->get('email'))->rol($request->get('rol'))->paginate(4);

        return view('control.users.users', array('users' => $users));
    }

    public function addUser() {
        return view('control.users.addUser');
    }

    public function postAddUser(Request $request) {
        // Ejecutamos el código: validamos que el archivo sea una imagen y no pese más de 0.5MB
        // >>> LÍNEA MODIFICADA: Agregamos la validación para 'imagenusuario'
        $request->validate([
            'imagenusuario' => 'nullable|image|max:512',
        ]);
        
        $error = DB::table('users')->where('email', '=', $request->input('email'))->get();
        if(count($error) > 0) {
            return redirect()->back()->withInput()->withErrors('El email ya existe.');
        }
        
        if($request->hasFile('imagenusuario')) {
            $file = $request->file('imagenusuario');
            $fich_unic = time() . "-" . $file->getClientOriginalName();
            $img = "img/" . $fich_unic;
            // Ejecutamos el código: movemos el archivo a la carpeta "img"
            $file->move('img', $fich_unic);
        } else {
            $img = "img/defecto.png";
        }
        
        $user = new User();
        $user->nombre = $request->input('nombre');
        $user->apellidos = $request->input('apellidos');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->rol = $request->input('rol');
        $user->imagenusuario = $img;
        $user->telefono = $request->input('telefono');
        $user->insta_user = $request->input('insta_user');
        $user->save();

        return redirect('/control/usuarios');
    }

    public function updateUser($id) {
        $usuario = User::find($id);
        return view('control.users.updateUser',array("u" => $usuario));
    }

    public function postUpdateUser(Request $request){
        // Ejecutamos el código: validamos que el archivo sea una imagen y no pese más de 0.5MB
        // >>> LÍNEA MODIFICADA: Agregamos la validación para 'imagenusuario'
        $request->validate([
            'imagenusuario' => 'nullable|image|max:512',
        ]);
        
        $usuario = User::find($request->input('id'));

        $usuario->nombre = $request->input('nombre');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->email = $request->input('email');
        $usuario->telefono = $request->input('telefono');
        
        if($request->input('password') != '') {
            $usuario->password = bcrypt($request->input('password'));
        }

        if ($request->hasFile('imagenusuario')) {
            $file = $request->file('imagenusuario');
            $fileName = time() . "-" . $file->getClientOriginalName();
            // Ejecutamos el código: movemos el archivo y asignamos el nombre a 'imagenusuario'
            $file->move('img', $fileName);
            $usuario->imagenusuario = 'img/' . $fileName;
        } else {
            $usuario->imagenusuario = $request->input('imagenAntigua');
        }
        
        $usuario->rol = $request->input('rol');
        $usuario->insta_user = $request->input('insta_user');
        $usuario->save();
        
        return redirect('/control/usuarios/');
    }

    public function deleteUser(Request $request) {
        //User::find($request->input('id'))->delete();
        //return redirect('/control/usuarios');

        try {
            // Buscar el usuario por ID
            $user = User::find($request->input('id'));
    
            // Verificar si el usuario existe
            if (!$user) {
                return redirect('/control/usuarios')->with('error', 'Usuario no encontrado.');
            }
    
            // Eliminar todas las reservas del cliente antes de eliminar el usuario
            \DB::table('reservas')->where('idCliente', $user->id)->delete();

            // Eliminar el usuario si existe
            $user->delete();
    
            // Redirigir con un mensaje de éxito
            return redirect('/control/usuarios')->with('success', 'Usuario y sus reservas eliminados correctamente.');
            
        } catch (\Illuminate\Database\QueryException $e) {
            // Capturar errores relacionados con la base de datos (SQL)
            return redirect('/control/usuarios')->with('error', 'Error al eliminar el usuario: Problema en la base de datos.');
            
        } catch (\Exception $e) {
            // Capturar errores generales
            return redirect('/control/usuarios')->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }

    public function diasNoDisponibles(Request $request) {
        $dias = DiasNoDisponibles::all();

        return view('control.diasnodisponibles.dias', array('dias' => $dias));
    }

    public function addDiaNoDisponible(Request $request) {
        return view('control.diasnodisponibles.addDia');
    }

    public function postAddDiaNoDisponible(Request $request) {
        $error = DB::table('dias_no_disponibles')->where('dia', '=', $request->input('dia'))->get();
        if(count($error) > 0) {
            return redirect()->back()->withInput()->withErrors('El día ya existe como no disponible.');
        }

        $dia = new DiasNoDisponibles();
        $dia->dia = $request->input('dia');
        $dia->save();

        $reservas = DB::table('reservas')->where('dia', '=', $request->input('dia'))->get();
        foreach ($reservas as $r) {
            $reserva = Reserva::find($r->id);

            $data = array(
                'email_address'=> $reserva->user->email,
                'cc'=>null,
                'subject'=>'Cancelación de reserva',
                'nombre' => $reserva->user->nombre,
                'dia' => date('d-m-Y', strtotime($reserva->dia)),
                'horaComienzo' => date('H:i', strtotime($reserva->horario->horaComienzo)),

            );

            Mail::send('emails.mensajeEliminarReserva', $data, function($message) use($data) {
                $message->from('microdiskInformatica20@gmail.com', 'JoseaBarber');
                $message->to($data['email_address']);
                if($data['cc'] != null){
                    $message->cc($data['cc']);
                }
                $message->subject($data['subject']);
            });

            $reserva->delete();

        }

        return redirect('/control/dias-no-disponibles');
    }

    public function deleteDia(Request $request) {
        DiasNoDisponibles::find($request->input('id'))->delete();
        return redirect('/control/dias-no-disponibles');
    }

    public function horarios(Request $request) {
        $horarios = Horario::orderBy('horaComienzo')->get();
        return view('control.horarios.horarios', array('horarios' => $horarios));
    }

    public function addHorario() {
        return view('control.horarios.addHorario');
    }

    public function postAddHorario(Request $request) {
        $error = DB::table('horarios')->where('horaComienzo', '=', $request->input('horaComienzo'))->get();
        if(count($error) > 0) {
            return redirect()->back()->withInput()->withErrors('Ese tramo ya existe.');
        }

        $horario = new Horario();
        $horario->turno = $request->input('turno');
        $horario->horaComienzo = $request->input('horaComienzo');
        $horario->save();

        return redirect('/control/horarios');
    }

    public function deleteHorario(Request $request) {
        Horario::find($request->input('id'))->delete();
        return redirect('/control/horarios');
    }

    public function reservas(Request $request) {
        $reservas = Reserva::join('horarios', 'idHorario', '=', 'horarios.id')
            ->select('reservas.*', 'reservas.id as id')
            ->dia($request->get('fecha1'), $request->get('fecha2'))->email($request->get('email'))->where('dia','>=',date("Y-m-d"))->orderBy('dia', 'ASC')->orderBy('horarios.horaComienzo', 'ASC')->paginate(10);
        return view('control.reservas.reservas', array('reservas' => $reservas, 'fecha1' => $request->get('fecha1'), 'fecha2' => $request->get('fecha2'), 'email' => $request->get('email')));
    }

    public function addReserva() {
        return view('control.reservas.addReserva', array('cortes' => Corte::all()));
    }

    public function postAddReserva(Request $request) {
        if(count(DB::table('users')->where('email', '=', $request->input('email'))->get()) <= 0) {
            return redirect()->back()->withInput()->withErrors('Ese email no existe.');
        } else if($request->input('idHorario') == null){
            return redirect()->back()->withInput()->withErrors('Por favor, elija una hora para la cita.');
        }else {
            $user = DB::table('users')->where('email', $request->input('email'))->first();
            $user_id = $user->id;
            $corte_id = $request->input('idCorte');
            $dia = $request->input('newDia');
            $horario_id = $request->input('idHorario');

            //Guardar reserva
            $reserva = new Reserva();
            $reserva->idCliente = $user_id;
            $reserva->idCorte = $corte_id;
            $reserva->idHorario = $horario_id;
            $reserva->dia = $dia;
            $reserva->save();

            // Obtener información del corte y horario
            $tipoCorte = Corte::where('id','=',$request->input('idCorte'))->first();
            $tramoHorario = Horario::where('id','=',$request->input('idHorario'))->first();

            // Cálculo de la hora de inicio y fin basados en `newDia`
            $horaInicio = date('Ymd\THis', strtotime($dia . ' ' . $tramoHorario->horaComienzo));
            $horaFin = date('Ymd\THis', strtotime($dia . ' ' . $tramoHorario->horaComienzo . '+ 30 minutes'));
 
            // Si es el usuario admin, guarda el nombre del cliente
            if($user_id == 1){
                $nomCliente = new NomCliente();
                if(empty($request->input('cliente'))){
                    return redirect()->back()->withInput()->withErrors('No puedes dejar el nombre vacío si el correo es el tuyo propio.');
                }
                $nomCliente->nombre = $request->input('cliente');
                $nomCliente->idReserva = Reserva::where('idCorte', '=', $corte_id)->where('idCliente', '=', $user_id)->where('idHorario', '=', $horario_id)->where('dia', '=', $dia)->first()->id;
                $nomCliente->save();
            }

            // Antigua versión
            /*
            $data = array(
                'email_address'=> $user->email,
                'cc'=>null,
                'subject'=>'Confirmación de reserva',
                'nombre' => $user->nombre,
                'dia' => date('d-m-Y', strtotime($dia)),
                'horaComienzo' => date('H:i', strtotime($tramoHorario->horaComienzo)),
                'tipoPelado' => $tipoCorte->tipoPelado

            );
            */

            // Guardar datos de la reserva en el correo
            $data = array(
                'email_address'=> $user->email,
                'cc'=>null,
                'subject'=>'Confirmación de reserva',
                'nombre' => $user->nombre,
                'dia' => date('d-m-Y', strtotime($dia)),
                'horaComienzo' => date('H:i', strtotime($tramoHorario->horaComienzo)),
                'horaInicio' => date('Ymd\THis', strtotime($request->input('dia') . ' ' . $tramoHorario->horaComienzo)),
                'horaFin' => date('Ymd\THis', strtotime($request->input('dia') . ' ' . $tramoHorario->horaComienzo . '+ 30 minutes')),
                'tipoPelado' => $tipoCorte->tipoPelado

            );

            // Guardar en la sesión las variables `horaInicio` y `horaFin`
            session()->flash('reserva_exitosa', true);
            session()->flash('hora_inicio', $horaInicio);
            session()->flash('hora_fin', $horaFin);
            
            try {
                Mail::send('emails.mensajeConfirmacion', $data, function($message) use($data) {
                    $message->from('microdiskInformatica20@gmail.com', 'JoseaBarber');
                    $message->to($data['email_address']);
                    if($data['cc'] != null){
                        $message->cc($data['cc']);
                    }
                    $message->subject($data['subject']);
                });
    
                return redirect('/control/reservas');
            } catch (\Swift_TransportException $e) {
                // Puedes capturar y manejar la excepción de SwiftMailer aquí.
                return redirect()->back()->withInput()->withErrors('Error al enviar el correo de confirmación. Las credenciales SMTP del correo se cambiaron.');
            } catch (\Exception $e) {
                // Captura cualquier otra excepción que pueda ocurrir.
                return redirect()->back()->withInput()->withErrors('Ocurrió un error inesperado. Por favor, inténtalo de nuevo.');
            }
        }
    }

    public function actionNuevo(Request $request){
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
                                    $mañana.= "<div class='col-xl-1 col-md-3'><label class='btn btn-primary btn-citas'>
                                <input type='radio' class='radio-horario' name='idHorario' required value='".$datos->id."' autocomplete='off'> ".date("H:i", strtotime($datos->horaComienzo))."
                           </label></div>";
                                }
                            }
                            $tarde.= "<p  class='text-center'>Cerrado</p>";
                        }else{
                            foreach ($data as $datos){
                                if ($datos->turno == "mañana"){

                                    $mañana.= "<div class='col-xl-1 col-md-3'><label class='btn btn-primary btn-citas'>
                                    <input type='radio' name='idHorario' class='radio-horario' required value='".$datos->id."' autocomplete='off'>".date("H:i", strtotime($datos->horaComienzo))."
                                </label></div>";


                                } else {

                                    $tarde.= "<div class='col-xl-1 col-md-3'><label class='btn btn-primary btn-citas'>
                                                        <input type='radio' name='idHorario' class='radio-horario' required value='".$datos->id."' autocomplete='off'>".date("H:i", strtotime($datos->horaComienzo))."
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
                                $mañana.= "<div class='col-xl-1 col-md-3'><label class='btn btn-primary btn-citas'>
                                <input type='radio' name='idHorario' class='radio-horario' required value='".$datos->id."' autocomplete='off'> ".date("H:i", strtotime($datos->horaComienzo))."
                           </label></div>";
                            }
                        }
                        $tarde.= "<p  class='text-center'>Cerrado</p>";
                    } else{
                        foreach ($data as $datos){
                            if ($datos->turno == "mañana"){
                                $mañana.= "<div class='col-xl-1 col-md-3'><label class='btn btn-primary btn-citas'>
                                    <input type='radio' name='idHorario' class='radio-horario' required value='".$datos->id."' autocomplete='off'>".date("H:i", strtotime($datos->horaComienzo))."
                                </label></div>";
                            } else {
                                $tarde.= "<div class='col-xl-1 col-md-3'><label class='btn btn-primary btn-citas'>
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

    public function updateReserva($id){
        $reserva = Reserva::find($id);
        $cortes = Corte::all();
        return view('control.reservas.updateReserva',array('reserva' => $reserva, 'cortes' => $cortes));
    }

    public function postUpdateReserva(Request $request){
        if(count(DB::table('users')->where('email', '=', $request->input('email'))->get()) <= 0) {
            return redirect()->back()->withInput()->withErrors('Ese email no existe.');
        } else if($request->input('hora') == null){
            return redirect()->back()->withInput()->withErrors('Por favor, elija una hora para la cita.');
        }else {
            $reserva = Reserva::find($request->input('id'));
            $user = User::where('email','=',$request->input('email'))->first();
            $reserva->idCliente = $user->id;
            $reserva->idCorte = $request->input('idCorte');
            $reserva->dia = $request->input('updateDia');
            $reserva->idHorario = $request->input('hora');
            $reserva->save();

            $tipoCorte = Corte::where('id','=',$request->input('idCorte'))->first();
            $tramoHorario = Horario::where('id','=',$request->input('hora'))->first();
            $dia = $request->input('updateDia');

            $data = array(
                'email_address'=> $user->email,
                'cc'=>null,
                'subject'=>'Modificación de reserva',
                'nombre' => $user->nombre,
                'dia' => date('d-m-Y', strtotime($dia)),
                'horaComienzo' => date('H:i', strtotime($tramoHorario->horaComienzo)),
                'tipoPelado' => $tipoCorte->tipoPelado

            );

            Mail::send('emails.mensajeModificarReserva', $data, function($message) use($data) {
                $message->from('microdiskInformatica20@gmail.com', 'JoseaBarber');
                $message->to($data['email_address']);
                if($data['cc'] != null){
                    $message->cc($data['cc']);
                }
                $message->subject($data['subject']);
            });

            return redirect('/control/reservas');
        }
    }

    public function actionUpdate(Request $request){
        $query = $request->get('query');

        $output = "<label for='hora'>Horas disponibles</label><select id='hora' name='hora' class='form-control'>";

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

            if ($fechaActual > $fechaEntrada){
                $output.="<option>No hay citas disponibles</option></select>";
            } else{
                if ($totalDiasNoDisponibles > 0){
                    $diaActual = false;
                    foreach ($diasNoDisponibles as $dia){
                        if ($dia->dia == $query){
                            $diaActual = true;
                        }
                    }
                    if ($diaActual){
                        $output.="<option>No hay citas disponibles</option></select>";
                    } else if (date('w', strtotime($query)) == 0){
                        //Si es domingo se cierra
                        $output.="<option>No hay citas disponibles</option></select>";
                    } else if(date('w', strtotime($query)) == 6){
                        //Si es sabado cerramos por la tarde
                        foreach ($data as $datos){
                            if ($datos->turno = "mañana")
                                $output.="<option value='$datos->id'>".date("H:i",strtotime($datos->horaComienzo))."</option>";
                        }
                        $output.="</select>";
                    }else{
                        foreach ($data as $datos){
                            $output.="<option value='$datos->id'>".date("H:i",strtotime($datos->horaComienzo))."</option>";
                        }
                        $output.="</select>";
                    }
                }
                else{
                    if (date('w', strtotime($query)) == 0){
                        //Si es domingo se cierra
                        $output.="<option>No hay citas disponibles</option></select>";
                    } else if(date('w', strtotime($query)) == 6){
                        //Si es sabado cerramos por la tarde
                        foreach ($data as $datos){
                            if ($datos->turno == "mañana"){
                                $output.="<option value='$datos->id'>".date("H:i",strtotime($datos->horaComienzo))."</option>";
                            }
                        }
                        $output.="</select>";
                    } else{
                        foreach ($data as $datos){
                            $output.="<option value='$datos->id'>".date("H:i",strtotime($datos->horaComienzo))."</option>";
                        }
                        $output.="</select>";
                    }
                }
            }

        }else{
            $output.="<option>No hay citas disponibles</option></select>";
        }

        $datos = array(
            'datos' => $output
        );
        echo json_encode($datos);
    }

    public function deleteReserva(Request $request){
        $reserva = Reserva::find($request->input('id'));

        $data = array(
            'email_address'=> $reserva->user->email,
            'cc'=>null,
            'subject'=>'Cancelación de reserva',
            'nombre' => $reserva->user->nombre,
            'dia' => date('d-m-Y', strtotime($reserva->dia)),
            'horaComienzo' => date('H:i', strtotime($reserva->horario->horaComienzo)),

        );

        Mail::send('emails.mensajeEliminarReserva', $data, function($message) use($data) {
            $message->from('microdiskInformatica20@gmail.com', 'JoseaBarber');
            $message->to($data['email_address']);
            if($data['cc'] != null){
                $message->cc($data['cc']);
            }
            $message->subject($data['subject']);
        });

        if (isset($reserva->nomcliente)){
            $reserva->nomcliente->delete();
        }
        $reserva->delete();

        return redirect('/control/reservas');
    }

    public function banner() {
        return view('control.banner.banner', array('img' => Banner::all()));
    }
    public function updateBanner(Request $request) {
        // Ejecutamos el código: validamos que 'banner' sea una imagen y pese como máximo 0.5MB
        $request->validate([
            'banner' => 'required|image|max:512',
        ]);

        // Obtenemos el archivo subido y generamos un nombre único
        $file = $request->file('banner');
        $fileName = time() . "-" . $file->getClientOriginalName();

        if (Banner::all()->count() > 0) {
            $banner = Banner::all()->first();
            if (file_exists(public_path($banner->img))) {
                unlink(public_path($banner->img));
            }
            // Ejecutamos el código: movemos el archivo a 'img/banner' y actualizamos la ruta en el banner existente
            $file->move('img/banner', $fileName);
            $banner->img = 'img/banner/' . $fileName;
            $banner->save();
        } else {
            $banner = new Banner();
            // Ejecutamos el código: movemos el archivo a 'img/banner' y asignamos la ruta al nuevo banner
            $file->move('img/banner', $fileName);
            $banner->img = 'img/banner/' . $fileName;
            $banner->save();
        }
        
        return redirect('/');
    }

 

    // Cortes
    
    public function cortes(Request $request) {
        //$cortes = Corte::tipoPelado($request->get('tipoPelado'))->precio($request->get('precio'));
        $cortes = Corte::all();

        return view('control.cortes.cortes', array('cortes' => $cortes));
    }

    public function addCorte() {
        return view('control.cortes.addCorte');
    }

    public function postAddCorte(Request $request) {
        
        //$error = DB::table('users')->where('email', '=', $request->input('email'))->get();
        //if(count($error) > 0) {
        //    return redirect()->back()->withInput()->withErrors('El email ya existe.');
        //}
        //if($request->file('imagenusuario') != null) {
        //    $fich_unic = time() . "-" . $request->file('imagenusuario')->getClientOriginalName();
            //para que no se repita el nombre del fichero se concatena el tiempo unix
        //    $img = "img/" . $fich_unic;
        //    move_uploaded_file($request->file('imagenusuario'), $img);
        //} else {
        //    $img = "img/defecto.png";
        //}
        
        $corte = new Corte();
        $corte->tipoPelado = $request->input('tipoPelado');
        $corte->precio = $request->input('precio');
        $corte->save();

        return redirect('/control/cortes');
    }

    public function updateCorte($id) {
        $corte = Corte::find($id);
        return view('control.cortes.updateCorte',array("c" => $corte));
    }

    public function postUpdateCorte(Request $request){
        $corte = Corte::find($request->input('id'));

        $corte->tipoPelado = $request->input('tipoPelado');
        $corte->precio = $request->input('precio');
        $corte->save();
        return redirect('/control/cortes/');
    }

    public function deleteCorte(Request $request) {
        Corte::find($request->input('id'))->delete();
        return redirect('/control/cortes');
    }
}

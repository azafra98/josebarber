<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    public function user() {
        return $this->belongsTo(User::class,"idCliente");
    }

    public function horario() {
        return $this->belongsTo(Horario::class, "idHorario");
    }

    public function corte() {
        return $this->belongsTo(Corte::class, "idCorte");
    }

    public function nomcliente() {
        return $this->hasOne(NomCliente::class, 'idReserva','id');
    }

    public function scopeDia($query, $day1, $day2) {
        if($day1 && $day2) {
            return $query->where('dia', '>=', "$day1")->where('dia', '<=', "$day2");
        } else {
            if($day1) {
                return $query->where('dia', '=', "$day1");
            }
        }
    }
    public function scopeEmail($query, $email) {
        if($email) {
            return $query->whereHas('user', function ($query) use ($email) {
                $query->where('users.email', 'like',  "%$email%");
            });
        }
    }
}

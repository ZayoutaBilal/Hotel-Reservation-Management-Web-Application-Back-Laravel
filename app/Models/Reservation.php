<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['fullname', 'phone','type_chambre', 'date_debut','date_fin','total',"id_user","id_chambre"];
}

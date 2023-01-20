<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'e_staff';
    //protected $primarykey = 'staff_id';
    public $incrementing = false;

    protected $fillable = [
        'staff_id',
        'staff_nombre',
        'staff_gpo',
        'staff_subgpo',
        'staff_sda',
        'staff_login',
        'staff_pass',
        'staff_atrib',
        'staff_email'
    ];

    protected $hidden = [
        'staff_pass'
    ];

    }

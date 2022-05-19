<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DBSpending extends Model
{
    protected $table = "spendings";

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'home_id', 'user_id', 'transport_id', 'food_id', 'servant'
    ];

}

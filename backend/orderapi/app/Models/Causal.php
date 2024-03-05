<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; //
use Illuminate\Database\Eloquent\Model;

class Causal extends Model
{
    use HasFactory;

    protected $table = 'causal'; 
    // Public: Todo el mundo lo puede ver y clonar , private: No se pueden ver, protected: Solo los puede ver los que hereden de la clase

    protected $fillable = ['description'] ;

    public function orders()
    {
        return $this->hasMany(Order::class);

    }

}

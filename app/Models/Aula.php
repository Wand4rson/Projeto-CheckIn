<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $table = 'tb_aulas';


    //Uma Aula pode ter Somente um usuario que a criou
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}

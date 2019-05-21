<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
//     /**
//      * Indica os atributos para definição de dados em massa
//      */
//     protected $fillable = ['name', 'birth', 'gender', 'classroom_id'];


//     /**
//      * Faz a conversão na hora da serialização
//      */
//     protected $casts = [
//         'birth' => 'date:d/m/Y'
//     ];

//    /**
//     *  Define atributos não mostrados depois da serializaçao
//     */
//     //protected $hiddend = ['created_at', 'updated_at'];

//     /**
//     *  Define atributos visiveis depois da serializaçao
//     */
//     protected $visible = ['name', 'gender', 'birth', 'classroom_id', 'is_accepted'];


//     /**
//     *  Define atributos dinamicos anexos a serialização
//     */
//     protected $appends = ['is_accepted'];

    /**
     * Mapeamento do relacionamento com salas de aula
     * 
     * @return 
     */
    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom');
    }

    // /**
    // *  Cria um accessor no model de student chamado is_accepted
    // */
    // public function getIsAcceptedAttribute()
    // {
    //     return $this->attributes['birth'] > "2002-01-01" ? "aceito" : "não foi aceito";
    // }
}

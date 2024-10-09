<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use Response;

class Contratista extends Model
{
    protected $table = 'contratistas';
    public $timestamps = false;

    public static function tiposSelect($id) {

    	$tipos = DB::table('tipos')
        ->where('fk_tipos_padre', $id)
        ->where('estado', 1)
        ->get();

        return $tipos;

    }

}

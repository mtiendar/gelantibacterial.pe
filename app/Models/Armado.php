<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Armado extends Model{
  use SoftDeletes;
  protected $table='armados';
  protected $primaryKey='id';
  // Define si vera todos los registros de la tabla o solo los que se le asignaron o los que usuario registro (on = todos los registros null = solo sus registros)
  public function scopeAsignado($query, $opcion_asignado, $usuario) {
    if($opcion_asignado == null){
      return $query->where('asignado_arm', $usuario);
    }
  }
  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  public function imagenes(){
    return $this->hasMany('App\Models\ArmadoImagen')->orderBy('id', 'DESC');
  } 
  public function productos(){
    return $this->belongsToMany('App\Models\Producto', 'armado_tiene_productos')->withPivot('id', 'cant')->withTimestamps()->orderBy('armado_tiene_productos.id', 'DESC');
  }    
}
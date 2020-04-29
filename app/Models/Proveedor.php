<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model {
  use SoftDeletes; // Permite habilitar el campo deleted_at en la BD para no eliminar el registro directamente y trabajar sobre una papelera de reciclaje
  protected $table = 'proveedores';
  protected $primaryKey = 'id';

  // Define si vera todos los registros de la tabla o solo los que se le asignaron o los que usuario registro (1 = todos 0 = solo sus registros)
  public function scopeAsignado($query, $opcion_asignado, $usuario) {
    if($opcion_asignado == null) {
      return $query->where('asignado_prov', $usuario);
    }
  }
  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  public function contactos() {
    return $this->hasMany('App\Models\ContactoProveedor')->orderBy('id', 'DESC');
  }
  public function productos(){
    return $this->belongsToMany('App\Models\Producto', 'producto_tiene_proveedores')->withPivot('id', 'prec_prove', 'utilid', 'prec_clien')->withTimestamps()->orderBy('producto_tiene_proveedores.id', 'DESC');
  }
}
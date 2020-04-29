<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// Repositories
use App\Repositories\sistema\sistema\SistemaRepositories;

class Sistema extends Model {
  use SoftDeletes; // Permite habilitar el campo deleted_at en la BD para no eliminar el registro directamente y trabajar sobre una papelera de reciclaje
  protected $table = 'sistema';
  protected $primaryKey = 'id';
  protected $sistemaRepo;

  public static function datos() {
    return new SistemaRepositories; // Retorna la información del sistema
  }
}
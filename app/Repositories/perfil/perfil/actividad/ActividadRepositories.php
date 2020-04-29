<?php
namespace App\Repositories\perfil\perfil\actividad;
// Models
use App\Models\Actividades;
// Otros
use Illuminate\Support\Facades\Auth;

class ActividadRepositories implements ActividadInterface {
  public function getPagination($request) {
    return Actividades::where('usu', Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
}
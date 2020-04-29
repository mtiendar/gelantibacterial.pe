<?php
namespace App\Http\Requests\rol;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateRolRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_rol = Crypt::decrypt($this->id_rol);
    return [
      'nombre_del_rol'  => 'required|max:40|string|unique:roles,nom,' . $id_rol,
      'permisos'        => 'required|exists:permissions,id|array',
      'descripcion'     => 'nullable|max:65500|string',
    ];
  }
}
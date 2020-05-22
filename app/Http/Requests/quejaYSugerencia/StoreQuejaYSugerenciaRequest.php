<?php
namespace App\Http\Requests\quejaYSugerencia;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuejaYSugerenciaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'departamento'  => 'required|in:Ventas,Producción,Logística,Facturación,Sistema,Otro',
      "archivos.*"    => "required|image|max:1024",
      'observaciones' => 'required|max:65500|string',
    ];
  }
}
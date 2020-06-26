<?php
namespace App\Http\Requests\costoDeEnvio;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCostoDeEnvioRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'estado'            => 'required|in:Aguascalientes,Baja California,Baja California Sur,Campeche,Ciudad de México,Chihuahua,Chiapas,Coahuila de Zaragoza,Colima,Durango,Estado de México,Guanajuato,Guerrero,Hidalgo,Jalisco,Michoacán de Ocampo,Morelos,Nayarit,Nuevo León,Oaxaca,Puebla,Querétaro,Quintana Roo,San Luis Potosí,Sinaloa,Sonora,Tabasco,Tamaulipas,Tlaxcala,Veracruz,Yucatán,Zacatecas',
      'metodo_de_entrega' => 'required|in:En bodega,Gratis,Paquetería,Transporte interno de la empresa,Transportes ferro,Viaje metropolitano',
      'foraneo_o_local'   => 'required|in:Foráneo,Local',
      'tipo_de_envio'     => 'required|in:Normal,Express',
      'costo_por_envio'   => 'required|min:0|numeric|alpha_decimal15',
    ];
  }
}
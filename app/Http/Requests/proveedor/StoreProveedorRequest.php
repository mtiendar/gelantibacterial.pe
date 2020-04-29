<?php
namespace App\Http\Requests\proveedor;
use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'razon_social'                    => 'required|max:60|unique:proveedores,raz_soc',
      'nombre_comercial'                => 'required|max:100|unique:proveedores,nom_comerc',
      'fabricante_distribuidor'         => 'required|in:Fabricante,Distribuidor',
      'rfc'                             => 'required|max:40',
      'nombre_del_representante_legal'  => 'max:80',
      'pagina_web'                      => 'nullable|max:100|active_url',
      'lada_telefono_fijo'              => 'nullable|max:9999|min:1|numeric|required_with:telefono_fijo',
      'telefono_fijo'                   => 'nullable|max:15|alpha_solo_numeros_guiones|required_with:lada_telefono_fijo',
      'extension'                       => 'max:10',
      'lada_telefono_movil'             => 'required|max:9999|min:1|numeric',
      'telefono_movil'                  => 'required|max:15|alpha_solo_numeros_guiones',
      'observaciones'                   => 'nullable|max:65500|string',
      'calle'                           => 'required|max:45',
      'no_ext'                          => 'required|max:8',
      'no_int'                          => 'max:30',
      'pais'                            => 'max:40',
      'ciudad'                          => 'required|max:50',
      'colonia'                         => 'required|max:40',
      'delegacion_o_municipio'          => 'required|max:50',
      'codigo_postal'                   => 'required|max:6',
      'referencias'                     => 'nullable|max:65500|string',
      'archivo'                         => 'nullable|max:1024|file',
    ];
  }
}
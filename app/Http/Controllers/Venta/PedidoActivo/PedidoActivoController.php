<?php
namespace App\Http\Controllers\Venta\PedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\venta\pedidoActivo\StorePedidoRequest;
use App\Http\Requests\venta\pedidoActivo\UpdatePedidoRequest;
use App\Http\Requests\venta\pedidoActivo\UpdateTotalDeArmadosRequest;
use App\Http\Requests\venta\pedidoActivo\UpdateMontoTotalRequest;
// Notifications
// use App\Notifications\cliente\NotificacionBienvenidaCliente;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\usuario\UsuarioRepositories;
use App\Repositories\sistema\serie\SerieRepositories;
use App\Repositories\sistema\plantilla\PlantillaRepositories;
use App\Repositories\sistema\sistema\SistemaRepositories;

class PedidoActivoController extends Controller {
  protected $serviceCrypt;
  protected $pedidoActivoRepo;
  protected $usuarioRepo;
  protected $serieRepo;
  protected $plantillaRepo;
  protected $sistemaRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PedidoActivoRepositories $pedidoActivoRepositories, UsuarioRepositories $usuarioRepositories, SerieRepositories $serieRepositories, PlantillaRepositories $plantillaRepositories, SistemaRepositories $sistemaRepositories) {
    $this->serviceCrypt     = $serviceCrypt;
    $this->pedidoActivoRepo = $pedidoActivoRepositories;
    $this->usuarioRepo      = $usuarioRepositories;
    $this->serieRepo        = $serieRepositories;
    $this->plantillaRepo    = $plantillaRepositories;
    $this->sistemaRepo      = $sistemaRepositories;
  }
  public function index(Request $request) {
    $pedidos = $this->pedidoActivoRepo->getPagination($request);
    return view('venta.pedido_activo.ven_pedAct_index', compact('pedidos'));
  }
  public function create() {
    $series_list = $this->serieRepo->getAllInputSeriesPlunk('Pedidos (Serie)');
    $clientes_list = $this->usuarioRepo->getAllClientesIdPlunk();
    $plantillas = $this->plantillaRepo->getAllPlantillasModuloPluck('Ventas');
    $plantilla_default = $this->sistemaRepo->datos('plant_vent');
    return view('venta.pedido_activo.ven_pedAct_create', compact('clientes_list', 'series_list', 'plantillas', 'plantilla_default'));
  }
  public function store(StorePedidoRequest $request) {
    $pedido = $this->pedidoActivoRepo->store($request);
    if(auth()->user()->can('venta.pedidoActivo.edit')) {
      toastr()->success('¡Pedido registrado exitosamente ahora puedes completar la información faltante!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('venta.pedidoActivo.edit', $this->serviceCrypt->encrypt($pedido->id))); 
    }
    toastr()->success('¡Pedido registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_pedido) {
    $pedido = $this->pedidoActivoRepo->pedidoAsignadoFindOrFailById($id_pedido);
    $armados = $this->pedidoActivoRepo->getArmadosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $pagos = $this->pedidoActivoRepo->getPagosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    return view('venta.pedido_activo.ven_pedAct_show', compact('pedido', 'armados', 'pagos'));
  }
  public function edit($id_pedido) {
    $pedido = $this->pedidoActivoRepo->pedidoAsignadoFindOrFailById($id_pedido);
    $armados = $this->pedidoActivoRepo->getArmadosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $pagos = $this->pedidoActivoRepo->getPagosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    return view('venta.pedido_activo.ven_pedAct_edit', compact('pedido', 'armados', 'pagos'));
  }
  public function update(UpdatePedidoRequest $request, $id_pedido) {
    $pedido = $this->pedidoActivoRepo->update($request, $id_pedido);
    toastr()->success('¡Pedido actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function updateTotalDeArmados(UpdateTotalDeArmadosRequest $request, $id_pedido) {
    $this->pedidoActivoRepo->updateTotalDeArmados($request, $id_pedido);
    toastr()->success('¡Total de armados actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function updateMontoTotal(UpdateMontoTotalRequest $request, $id_pedido) {
    $pedido = $this->pedidoActivoRepo->updateMontoTotal($request, $id_pedido);
    toastr()->success('¡Monto total actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_pedido) {
    $this->pedidoActivoRepo->destroy($id_pedido);
    toastr()->success('¡Pedido eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }

}
<?php
namespace App\Exports\almacen\producto;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
// Models
use App\Models\Producto;

class generarReporteDeCompraExport implements FromView, ShouldQueue {
    use Exportable;
    public function view(): View {
        return view('almacen.producto.exports.alm_pro_exp_generarReporteDeCompra', [
            'productos' => Producto::with('sustitutos')->orderBy('id', 'DESC')->get()
        ]);
    }
}

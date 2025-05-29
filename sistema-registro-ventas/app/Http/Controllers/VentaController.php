<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:crear ventas')->only(['create', 'store']);
        $this->middleware('permission:ver ventas propias')->only(['index']);
    }

    public function index()
    {
        $ventas = Venta::where('user_id', auth()->user()->id)->with('detalles.producto')->get();

        return view('ventas.index', compact('ventas'));
    }
    public function show(Venta $venta)
    {
        $venta->load('detalles.producto');
        return view('ventas.show', compact('venta'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('ventas.create', compact('productos'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();

        try {
            $idAuth = auth()->user()->id;
            $venta = Venta::create(['total' => 0, 'user_id' => $idAuth]);

            $total = 0;

            foreach ($request->productos as $item) {
                $producto = Producto::find($item['producto_id']);

                if ($producto->stock < $item['cantidad']) {
                    DB::rollback();
                    return back()->with('danger', 'No hay suficiente stock para el producto: ' . $producto->nombre);
                }

                $subtotal = $producto->precio * $item['cantidad'];

                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $item['cantidad'],
                    'precio' => $producto->precio
                ]);

                $total += $subtotal;

                // Reduce stock
                $producto->stock -= $item['cantidad'];
                $producto->save();
            }

            $venta->update(['total' => $total]);

            DB::commit();

            return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('danger', 'Error al registrar la venta: ' . $e->getMessage());
        }
    }

    public function edit(Venta $venta)
    {
        $venta->load('detalles.producto');
        return view('ventas.edit', compact('venta'));
    }

    public function update(Request $request, Venta $venta)
    {
        $total = 0;

        foreach ($request->productos as $item) {
            $detalle = DetalleVenta::find($item['detalle_id']);
            $producto = $detalle->producto;

            // Actualiza el stock (opcionalmente puedes recalcularlo)
            $stockChange = $item['cantidad'] - $detalle->cantidad;
            $producto->stock -= $stockChange;
            $producto->save();

            $detalle->cantidad = $item['cantidad'];
            $detalle->save();

            $total += $detalle->precio * $item['cantidad'];
        }

        $venta->total = $total;
        $venta->save();

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada');
    }

    public function destroy(Venta $venta)
    {
        // Elimina detalles primero (si hay relaciones en cascada, se puede omitir)
        $venta->detalles()->delete();
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }
}

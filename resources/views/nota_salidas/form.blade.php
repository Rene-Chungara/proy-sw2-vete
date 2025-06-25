@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="notaSalida()">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Nueva Nota de Salida</h2>

        {{-- Mostrar error general si hay --}}
        @if ($errors->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">
            {{ $errors->first('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('nota_salidas.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Fecha</label>
                    <input type="datetime-local" name="fecha" class="w-full border rounded-xl p-2" value="{{ old('fecha') }}" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Proveedor</label>
                    <select name="proveedor_id" class="w-full border rounded-xl p-2" required>
                        <option value="">Seleccione...</option>
                        @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                            {{ $proveedor->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded-xl p-2" required>{{ old('descripcion') }}</textarea>
            </div>

            <div class="mt-6">
                <h3 class="text-lg font-bold mb-2 text-gray-700">Productos</h3>
                <table class="w-full border rounded-xl">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2">Producto</th>
                            <th class="p-2">Cantidad</th>
                            <th class="p-2">Precio U.</th>
                            <th class="p-2">Subtotal</th>
                            <th class="p-2">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(item, index) in items" :key="index">
                            <tr>
                                <td class="p-2">
                                    <select :name="`productos[${index}][producto_id]`" class="w-full border rounded-xl p-1" required>
                                        <option value="">Seleccione...</option>
                                        @foreach($productos as $producto)
                                        <option value="{{ $producto->id }}">
                                            {{ $producto->nombre }} (Stock: {{ $producto->stock }})
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="p-2">
                                    <input type="number" min="1" class="w-full border rounded-xl p-1"
                                        :name="`productos[${index}][cantidad]`"
                                        x-model.number="item.cantidad"
                                        @input="updateSubtotal(index)">
                                </td>
                                <td class="p-2">
                                    <input type="number" min="0" step="0.01" class="w-full border rounded-xl p-1"
                                        :name="`productos[${index}][precio_unitario]`"
                                        x-model.number="item.precio_unitario"
                                        @input="updateSubtotal(index)">
                                </td>
                                <td class="p-2 text-center" x-text="item.subtotal.toFixed(2)"></td>
                                <td class="p-2 text-center">
                                    <button type="button" class="text-red-600 hover:text-red-900" @click="removeItem(index)">Eliminar</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <button type="button" class="mt-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-1 px-3 rounded-xl" @click="addItem()">Agregar Producto</button>
            </div>

            <div class="mt-4 text-right">
                <strong class="text-gray-700">Monto Total: </strong>
                <span x-text="montoTotal.toFixed(2)"></span>
                <input type="hidden" name="monto" :value="montoTotal.toFixed(2)">
            </div>

            <div class="mt-6 flex justify-end space-x-2">
                <a href="{{ route('nota_salidas.index') }}" class="px-4 py-2 bg-gray-300 rounded-xl">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
function notaSalida() {
    return {
        items: [],
        montoTotal: 0,
        addItem() {
            this.items.push({ cantidad: 1, precio_unitario: 0, subtotal: 0 });
        },
        removeItem(index) {
            this.items.splice(index, 1);
            this.calculateTotal();
        },
        updateSubtotal(index) {
            const item = this.items[index];
            item.subtotal = item.cantidad * item.precio_unitario;
            this.calculateTotal();
        },
        calculateTotal() {
            this.montoTotal = this.items.reduce((sum, item) => sum + item.subtotal, 0);
        }
    }
}
</script>
@endsection

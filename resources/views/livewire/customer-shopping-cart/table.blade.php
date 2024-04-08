<div class="mt-4">
    <div class="d-flex align-items-center justify-content-between">
        <div class="fs-4 fw-semibold">Mi carrito</div>
    </div>
    <div class="table-responsive my-3 rounded-4 shadow-lg">
        <table class="table table-sm table-striped align-middle text-center mb-0">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Imagen</th>
                    <th>Categoría</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>

                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($shoppingCartDetails as $shoppingCartDetail)
                    <tr wire:key="{{ $shoppingCartDetail->id }}">
                        <th>{{ $shoppingCartDetail->item->id }}</th>
                        <th><img style="width: 50px"
                                src="{{ asset($shoppingCartDetail->item->itemPics->first()?->url) }}" />
                        </th>
                        <th>{{ $shoppingCartDetail->item->category->name }}</th>
                        <th>{{ $shoppingCartDetail->item->name }}</th>
                        <th>{{ $shoppingCartDetail->item->description }}</th>
                        <th>{{ $shoppingCartDetail->item->stock }}</th>
                        <th>{{ $shoppingCartDetail->item->owner == 'Cliente' ? '-' : '+' }}{{ $shoppingCartDetail->item->price }}
                        </th>
                        <td>
                            <button wire:click="deleteConfirmation({{ $shoppingCartDetail->id }})" type="button"
                                class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash-can"></i></button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10"> No hay registros</td>

                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $shoppingCartDetails->onEachSide(0)->links() }}

    <div class="d-flex justify-content-end mt-5">
        <p class="d-inline-block fs-4 fw-bold">Total: {{ $shoppingCart->total_price }}</p>
    </div>

</div>

<div class="mt-4">
    <div class="d-flex align-items-center justify-content-between">
        <div class="fs-4 fw-semibold">Mis productos</div>
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
                        <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#add-modal-customer-item"><i class="fa-solid fa-plus"></i></button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customerItems as $customerItem)
                    <tr wire:key="{{ $customerItem->id }}">
                        <th>{{ $customerItem->item->id }}</th>
                        <th>
                            @if ($customerItem->item->itemPics->first()?->url)
                                <img style="width: 50px"
                                    src="{{ asset('storage/photos/' . $customerItem->item->itemPics->first()?->url) }}" />
                            @else
                                <img style="width: 50px" src="{{ asset('img/not-found.jpeg') }}" class="card-img-top" alt="...">
                            @endif
                        </th>
                        <th>{{ $customerItem->item->category->name }}</th>
                        <th>{{ $customerItem->item->name }}</th>
                        <th>{{ $customerItem->item->description }}</th>
                        <th>{{ $customerItem->item->stock }}</th>
                        <th>{{ $customerItem->item->price }}</th>
                        <td>
                            <button wire:click="addCart({{ $customerItem->id }})" type="button"
                                class="btn btn-sm btn-outline-warning"><i class="fa-solid fa-cart-plus"></i></button>
                            <button data-bs-toggle="modal"
                                data-bs-target="#edit-modal-customer-item-{{ $customerItem->id }}" type="button"
                                class="btn btn-sm btn-outline-primary"><i
                                    class="fa-regular fa-pen-to-square"></i></button>

                            <button wire:click="deleteConfirmation({{ $customerItem->id }})" type="button"
                                class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash-can"></i></button>
                        </td>

                        <livewire:customer-item.edit-modal :$customerItem :key="'edit-' . $customerItem->id"
                            @customer-item-saved="$refresh" />
                    </tr>
                @empty
                    <tr>
                        <td colspan="10"> No hay registros</td>

                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $customerItems->onEachSide(0)->links() }}

    <livewire:customer-item.add-modal @customer-item-saved="$refresh" />
</div>

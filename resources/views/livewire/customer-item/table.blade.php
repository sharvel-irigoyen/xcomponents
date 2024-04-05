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
                            data-bs-target="#add-modal-customer"><i class="fa-solid fa-plus"></i></button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customerItems as $customerItem)
                    <tr wire:key="{{ $customerItem->id }}">
                        <th>{{ $customerItem->item->id }}</th>
                        <th><img style="width: 50px" src="{{ asset($customerItem->item->itemPics->first()?->url) }}" /></th>
                        <th>{{ $customerItem->item->category->name }}</th>
                        <th>{{ $customerItem->item->name }}</th>
                        <th>{{ $customerItem->item->description }}</th>
                        <th>{{ $customerItem->item->stock }}</th>
                        <th>{{ $customerItem->item->price }}</th>
                        <td> <button data-bs-toggle="modal" data-bs-target="#edit-modal-{{ $customerItem->id }}"
                                type="button" class="btn btn-sm btn-outline-primary"><i
                                    class="fa-regular fa-pen-to-square"></i></button>

                            <button wire:click="deleteConfirmation({{ $customerItem->id }})" type="button"
                                class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash-can"></i></button>
                        </td>

                        {{-- <livewire:customer.edit-modal :$customer :key="$customer->id" @customer-saved="$refresh" /> --}}
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

    {{-- <livewire:customer.add-modal @customer-saved="$refresh" /> --}}
</div>

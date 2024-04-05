<div>
    <x-bs.modal id="edit-modal-customer-item-{{ $customerItem->id }}" ref="editModalCustomerItem{{ $customerItem->id }}"
        @customer-item-saved.window="editModalCustomerItem{{ $customerItem->id }}.hide()" :footer="false">
        <x-slot name="header">
            Editar producto
        </x-slot>

        <x-slot name="body">
            <form wire:submit='edit'>
                <x-bs.select wire:model.blur="categoryId" :key="$categories" label="Categoría:"
                    for="edit-category-{{ $customerItem->id }}" :error="$errors->first('categoryId')" option_title="Seleccione una categoría" />
                <x-bs.input autofocus autocomplete="on" wire:model.blur='name' label="Nombre:"
                    for="edit-description-{{ $customerItem->id }}" :error="$errors->first('name')" />
                <x-bs.input autofocus autocomplete="on" wire:model.blur='description' label="Descripción:"
                    for="edit-description-{{ $customerItem->id }}" :error="$errors->first('description')" />
                <x-bs.input autofocus autocomplete="on" wire:model.blur='stock' label="Stock:"
                    for="edit-stock-{{ $customerItem->id }}" :error="$errors->first('stock')" />
                <x-bs.input autofocus autocomplete="on" wire:model.blur='price' label="Precio:"
                    for="edit-price-{{ $customerItem->id }}" :error="$errors->first('price')" />
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-primary btn-sm">
                        <span wire:loading wire:target='edit' class="spinner-border spinner-border-sm"
                            aria-hidden="true"></span>
                        Editar</button>
                </div>

            </form>
        </x-slot>
    </x-bs.modal>
</div>

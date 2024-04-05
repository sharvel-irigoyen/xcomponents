<div>
    <x-bs.modal id="add-modal-customer-item" ref="addModalCustomerItem" @customer-item-saved.window="addModalCustomerItem.hide()" :footer="false">
        <x-slot name="header">
            Nuevo producto
        </x-slot>

        <x-slot name="body">
            <form wire:submit='add'>
                <x-bs.select wire:model.blur="categoryId" :key="$categories" label="Categoría:" for="select-category"
                    :error="$errors->first('categoryId')" option_title="Seleccione una categoría" />
                <x-bs.input autofocus autocomplete="on" wire:model.blur='name' label="Nombre:"
                    for="name" :error="$errors->first('name')" />
                <x-bs.input autofocus autocomplete="on" wire:model.blur='description' label="Descripción:"
                    for="description" :error="$errors->first('description')" />
                <x-bs.input autofocus autocomplete="on" wire:model.blur='stock' label="Stock:" for="stock"
                    :error="$errors->first('stock')" />
                <x-bs.input autofocus autocomplete="on" wire:model.blur='price' label="Precio:" for="price"
                    :error="$errors->first('price')" />
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-success btn-sm">
                        <span wire:loading wire:target='add' class="spinner-border spinner-border-sm"
                            aria-hidden="true"></span>
                        Agregar</button>
                </div>
            </form>
        </x-slot>
    </x-bs.modal>
</div>

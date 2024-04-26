<x-bs.container class="my-5">
    <div class="col-12 col-lg-2">
        <label class="fw-bold">Categorias:</label>
        @foreach ($categories as $category)
            <div class="form-check">
                <input wire:model.live="filters.category" class="form-check-input" type="checkbox"
                    value="{{ $category->id }}" id="{{ $category->name }}_{{ $category->id }}">
                <label class="form-check-label" for="{{ $category->name }}_{{ $category->id }}">
                    {{ $category->name }}
                </label>
            </div>
        @endforeach
        <label class="fw-bold">Precio min:</label>
        <x-bs.input wire:model.live="filters.priceMin" type="number" class="input-min" value="0" for="price_min"/>
        <label class="fw-bold">Precio max:</label>
        <x-bs.input wire:model.live="filters.priceMax" type="number" class="input-max" value="0" for="price_max"/>

        <label class="fw-bold">Nombre:</label>
        <x-input.textarea wire:model.live="filters.name"/>

        <label class="fw-bold">Descripción:</label>
        <x-input.textarea wire:model.live="filters.description"/>
    </div>
    <div class="col-12 col-lg-10">
        <div class="row">
            @foreach ($items as $item)
                <div wire:key='{{ $item->id }}' class="col-12 col-md-6 col-lg-4 col-xxl-4 mb-3">
                    <div class="card text-center d-block">
                        @if ($item->itemPics->first()?->url)
                            <img src="{{ asset('storage/photos/' . $item->itemPics->first()?->url) }}"
                                class="m-auto p-3" style="max-height: 200px; max-width: 100%;" alt="...">
                        @else
                            <img src="{{ asset('img/not-found.jpeg') }}" class="card-img-top" alt="...">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $item->category->name }}</h5>
                            <h6 class="truncate-2">{{ $item->name }}</h6>
                            <p class="card-text truncate-5">{{ $item->description }}.</p>


                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-secondary">Stock: {{ $item->stock }}</span>
                                <span class="text-danger fs-4 fw-bold">USD {{ $item->price }}</span>
                            </div>

                            <button data-bs-toggle="modal" data-bs-target="#show-modal-item-{{ $item->id }}"
                                type="button" class="btn btn-primary">Ver detalles</button>
                        </div>
                    </div>
                    <livewire:item.show-modal :$item :key="'show-' . $item->id" @show-modal="$refresh" />
                </div>
            @endforeach
        </div>
        {{ $items->onEachSide(0)->links() }}
    </div>
</x-bs.container>

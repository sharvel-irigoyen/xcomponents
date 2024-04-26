<div>
    <x-bs.modal class="modal-lg" id="show-modal-item-{{ $item->id }}" ref="showModalItem{{ $item->id }}"
        @show-modal.window="showModalItem{{ $item->id }}.hide()" :footer="false">
        <x-slot name="header">
            <h3 class="fs-2 fw-bold">{{ $item->name }}</h3>
        </x-slot>
        <x-slot name="body">
            <div class="row align-items-center">
                <div class="col-lg-6 fs-6">
                    <p><b>Categoría:</b> {{ $item->category->name }}</p>
                    <p><b>Descripción: </b>{{ $item->description }}</p>
                    <p><b>Stock:</b> {{ $item->stock }}</p>
                    <p><b>Precio:</b> USD {{ $item->price }}</p>
                    @auth
                        <div class="text-center mt-5 mb-3 mb-lg-0">
                            <button wire:click='addCart({{ $item->id }})' type="button" class="btn btn-success"><i
                                    class="fa-solid fa-cart-plus"></i>Agregar al
                                carrito</button>
                        </div>
                    @endauth
                </div>
                <div class="col-lg-6">
                    <div id="carousel-{{ $item->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner shadow rounded-4">
                            @forelse ($item->itemPics as $itemPic)
                                <div class="carousel-item bg-white {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{'storage/photos/' . $itemPic->url }}" class="d-block w-100 p-5" alt="...">
                                </div>
                            @empty
                                <div class="carousel-item active  shadow rounded-4">
                                    <img src="{{ asset('img/not-found.jpeg') }}" class="d-block w-100" alt="...">
                                </div>
                            @endforelse
                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carousel-{{ $item->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carousel-{{ $item->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-bs.modal>
</div>

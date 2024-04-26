<x-bs.container class="my-5">
    @foreach ($items as $item)
        <div wire:key='{{ $item->id }}' class="col-12 col-md-6 col-lg-4 col-xxl-3 mb-3">
            <div class="card text-center d-block">
                @if ($item->itemPics->first()?->url)
                    <img src="{{ asset('storage/photos/' . $item->itemPics->first()?->url) }}" class="m-auto p-3" style="max-height: 200px; max-width: 100%;"
                        alt="...">
                @else
                    <img src="{{ asset('img/not-found.jpeg') }}" class="card-img-top" alt="...">
                @endif

                <div class="card-body">
                    <h5 class="card-title truncate-2">{{ $item->category->name }}</h5>
                    <h6>{{ $item->name }}</h6>
                    <p class="card-text truncate-5">{{ $item->description }}.</p>


                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-secondary">Stock: {{ $item->stock }}</span>
                        <span class="text-danger fs-4 fw-bold">USD {{ $item->price }}</span>
                    </div>

                    <button data-bs-toggle="modal" data-bs-target="#show-modal-item-{{ $item->id }}" type="button"
                        class="btn btn-primary">Ver detalles</button>
                </div>
            </div>
            <livewire:item.show-modal :$item :key="'show-' . $item->id" @show-modal="$refresh" />
        </div>
    @endforeach
    {{ $items->onEachSide(0)->links() }}
</x-bs.container>

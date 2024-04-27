<div class="my-4">
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
                @forelse ($shoppingCartDetails ?? [] as $shoppingCartDetail)
                    <tr wire:key="{{ $shoppingCartDetail->id }}">
                        <th>{{ $shoppingCartDetail->item->id }}</th>
                        <th>
                            @if ($shoppingCartDetail->item->itemPics->first()?->url)
                                <img style="width: 50px"
                                    src="{{ asset('storage/photos/' . $shoppingCartDetail->item->itemPics->first()?->url) }}" />
                            @else
                                <img style="width: 50px" src="{{ asset('img/not-found.jpeg') }}" class="card-img-top"
                                    alt="...">
                            @endif
                        </th>
                        <th>{{ $shoppingCartDetail->item->category->name }}</th>
                        <th>{{ $shoppingCartDetail->item->name }}</th>
                        <th>{{ $shoppingCartDetail->item->description }}</th>
                        <th>{{ $shoppingCartDetail->item->stock }}</th>
                        <th
                            class="{{ $shoppingCartDetail->item->owner == 'Cliente' ? 'text-danger' : 'text-success' }}">
                            {{ $shoppingCartDetail->item->owner == 'Cliente' ? '-' : '+' }}{{ $shoppingCartDetail->item->price }}
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

    {{ $shoppingCartDetails?->onEachSide(0)->links() }}

    <div class="text-end">
        <p class="fs-4 fw-bold">Total: USD {{ $shoppingCart->total_price ?? 0 }}</p>
        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#register-payment">
            Registrar pago
        </button>
    </div>
    <x-bs.modal id="register-payment" :footer="false" ref="addPaymentModal"
        @payment-saved.window="addPaymentModal.hide()">
        <x-slot name="header">
            <h3 class="fs-2 fw-bold">Registrar pago</h3>
        </x-slot>
        <x-slot name="body">
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <x-bs.input autofocus autocomplete="on" wire:model.blur='paymentAmount' label="Monto de pago:"
                            for="payment_amount" :error="$errors->first('paymentAmount')" />
                        {{-- <x-input.filepond wire:model="paymentFile" :error="$errors->first('paymentFile')" /> --}}
                        <livewire:dropzone wire:model="paymentFile" :rules="['image', 'mimes:png,jpeg', 'max:10420']" :multiple="false" />

                        <div class="text-end">
                            <button type="submit" wire:click='addPayment' class="btn btn-outline-success btn-sm">
                                <span wire:loading wire:target='addPayment' class="spinner-border spinner-border-sm"
                                    aria-hidden="true"></span>
                                Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-bs.modal>
    @push('scripts')
        {{-- <script type="text/javascript" src="{{ config('services.niubiz.url_js') }}"></script>
        <script type="text/javascript">
            function openForm() {
                VisanetCheckout.configure({
                    sessiontoken: '{{ $sessionToken }}',
                    channel: 'web',
                    merchantid: "{{ config('services.niubiz.merchant_id') }}",
                    purchasenumber: {{ $shoppingCart->id }},
                    amount: {{ $shoppingCart->total_price }},
                    expirationminutes: '20',
                    timeouturl: 'about:blank',
                    merchantlogo: "{{ asset('img/logo.png') }}",
                    formbuttoncolor: '#000000',
                    action: 'paginaRespuesta',
                    complete: function(params) {
                        alert(JSON.stringify(params));
                    }
                });
                VisanetCheckout.open();
            }
        </script> --}}
    @endpush
</div>

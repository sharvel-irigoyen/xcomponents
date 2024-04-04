@if ($errors->any())
    <div {!! $attributes->merge(['class' => 'alert alert-danger fs-6 p-2']) !!} role="alert">
        <div class="font-weight-bold">{{ __('Whoops! Something went wrong.') }}</div>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn bg-yellow-500 text-white inline-flex algin-items-center px-4 py-2 border rounded-3 font-semibold fw-bold text-uppercase']) }}>
    {{ $slot }}
</button>

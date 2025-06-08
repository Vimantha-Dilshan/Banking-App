<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-success !important']) }}>
    {{ $slot }}
</button>

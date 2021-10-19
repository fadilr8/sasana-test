<button {{ $attributes->merge(['type' => 'button', 'class' => 'bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded']) }}>
    {{ $slot }}
</button>

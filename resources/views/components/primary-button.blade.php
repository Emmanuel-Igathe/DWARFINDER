<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-royal-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-royal-700 focus:bg-royal-700 active:bg-royal-800 focus:outline-none focus:ring-2 focus:ring-royal-400 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

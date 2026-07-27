<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center w-full px-4 py-3 bg-sidebar border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-wider hover:bg-orange-500 hover:text-white focus:bg-orange-600 active:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all ease-in-out duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5']) }}>
    {{ $slot }}
</button>

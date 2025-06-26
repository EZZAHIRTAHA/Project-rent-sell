<div>
    <div class="flex items-center">
        <button type="button" wire:click="decrement" 
            class="flex items-center justify-center w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-pr-400 disabled:opacity-50 disabled:cursor-not-allowed"
            {{ $quantity <= $minQuantity ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
            </svg>
        </button>
        
        <input type="number" wire:model="quantity" name="quantity" 
            class="w-16 h-8 text-center border-t border-b border-gray-300 focus:outline-none focus:ring-2 focus:ring-pr-400 text-gray-900"
            min="{{ $minQuantity }}" max="{{ $maxQuantity }}">
        
        <button type="button" wire:click="increment"
            class="flex items-center justify-center w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-pr-400 disabled:opacity-50 disabled:cursor-not-allowed"
            {{ $quantity >= $maxQuantity ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </button>
    </div>

    <div class="mt-1 text-xs text-gray-500">
        Min: {{ $minQuantity }} | Max: {{ $maxQuantity }}
    </div>
</div>

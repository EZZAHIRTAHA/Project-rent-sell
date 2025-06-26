<?php

namespace App\Livewire;

use Livewire\Component;

class Quantity extends Component
{
    public $quantity = 1;
    public $minQuantity = 1;
    public $maxQuantity = 10;

    public function mount($initialQuantity = 1)
    {
        $this->quantity = $initialQuantity;
    }

    public function increment()
    {
        if ($this->quantity < $this->maxQuantity) {
            $this->quantity++;
            $this->emitQuantityUpdate();
        }
    }

    public function decrement()
    {
        if ($this->quantity > $this->minQuantity) {
            $this->quantity--;
            $this->emitQuantityUpdate();
        }
    }

    public function updatedQuantity()
    {
        // Ensure quantity stays within bounds
        if ($this->quantity < $this->minQuantity) {
            $this->quantity = $this->minQuantity;
        } elseif ($this->quantity > $this->maxQuantity) {
            $this->quantity = $this->maxQuantity;
        }
        $this->emitQuantityUpdate();
    }

    private function emitQuantityUpdate()
    {
        // For Livewire 3
        $this->dispatch('quantity-updated', quantity: $this->quantity);
        
        // For older Livewire versions, use this instead:
        // $this->dispatchBrowserEvent('quantity-updated', ['quantity' => $this->quantity]);
    }

    public function render()
    {
        return view('livewire.quantity');
    }
}
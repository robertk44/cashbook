<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class BookingForm extends Component
{
    public $cashbox;
    public $amountType = 'outgoing';

    public function mount($cashbox)
    {
        $this->cashbox = $cashbox;
    }

    public function render()
    {
        return view('livewire.booking-form', [
            'categories' => Category::all()
        ]);
    }
}

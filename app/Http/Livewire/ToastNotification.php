<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ToastNotification extends Component
{
    public $message = '';
    public $showToast = false;
    public $type = 'success'; // success, error, warning, info

    protected $listeners = [
        'showToast',
        'productAddedToCart' => 'showProductAddedToast',
    ];

    public function render()
    {
        return view('livewire.toast-notification');
    }

    public function showToast($data)
    {
        $this->message = $data['message'] ?? '';
        $this->type = $data['type'] ?? 'success';
        $this->showToast = true;

        // Auto-hide after 3 seconds
        $this->dispatchBrowserEvent('toast-shown');
    }

    public function showProductAddedToast()
    {
        $this->message = 'Product added to cart successfully!';
        $this->type = 'success';
        $this->showToast = true;

        // Auto-hide after 3 seconds
        $this->dispatchBrowserEvent('toast-shown');
    }

    public function hideToast()
    {
        $this->showToast = false;
        $this->message = '';
    }
}


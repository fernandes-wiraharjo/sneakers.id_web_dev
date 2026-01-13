<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ModalMessageCheckout extends Component
{

    public $message;
    public $showModal = false; // Add a property to control the visibility of the modal
    public $useBootstrapView = false; // View type property to persist across Livewire updates

    protected $listeners = ['modalMessage'];

    public function mount()
    {
        // Determine if we should use bootstrap view based on current URL or route
        $this->useBootstrapView = request()->routeIs('customer.checkout.order') 
            || str_contains(url()->current(), '/checkout/order')
            || str_contains(url()->current(), 'bootstrap');
    }

    public function render()
    {
        // Use the persisted property to determine which view to use
        // This ensures the view stays consistent during Livewire updates
        $viewName = $this->useBootstrapView 
            ? 'bootstrap.livewire.modal-message-checkout' 
            : 'livewire.modal-message-checkout';

        return view($viewName);
    }

    public function modalMessage($data)
    {
        // Receive the message from the event and display it in the modal
        $this->message = $data['message'];
        $this->showModal = true; // Set the showModal property to true to show the modal
    }

    public function closeModal()
    {
        $this->showModal = false; // Set the showModal property to false to close the modal
    }
}

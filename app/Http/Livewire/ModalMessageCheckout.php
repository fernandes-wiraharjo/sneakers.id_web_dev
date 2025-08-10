<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ModalMessageCheckout extends Component
{

    public $message;
    public $showModal = false; // Add a property to control the visibility of the modal

    protected $listeners = ['modalMessage'];

    public function render()
    {
        return view('livewire.modal-message-checkout');
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

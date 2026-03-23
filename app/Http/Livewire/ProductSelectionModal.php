<?php


namespace App\Http\Livewire;

use Livewire\Component;

class ProductSelectionModal extends Component
{
    public $message;
    public $showModal = false; // Add a property to control the visibility of the modal

    protected $listeners = ['modal'];

    public function render()
    {
        return view('livewire.product-selection-modal');
    }

    public function modal($data)
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

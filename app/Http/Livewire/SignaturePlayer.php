<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\SignaturePlayer\Repositories\SignaturePlayerRepository;

class SignaturePlayer extends Component
{
    public $current_signature;
    public $edit;

    public function render(SignaturePlayerRepository $signature)
    {
        $signature = $signature->getSignatureTag()->toJson();
        return view('livewire.signature-player', compact('signature'));
    }
}

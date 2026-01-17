<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\SignaturePlayer\Repositories\SignaturePlayerRepository;

class SignaturePlayerCarousel extends Component
{
    public $current_signature;
    public $edit;

    public function render(SignaturePlayerRepository $signaturePlayerRepository)
    {
        $signature_carousel = $signaturePlayerRepository->getSignatureCarousel();
        return view('bootstrap.livewire.signature-player-carousel', compact('signature_carousel'));
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\SignaturePlayer\Repositories\SignaturePlayerRepository;

class SignaturePlayer extends Component
{
    public $current_signature;
    public $edit;

    public function render(SignaturePlayerRepository $signaturePlayerRepository)
    {
        // If current_signature and edit are set, this is the admin form
        if (isset($this->current_signature) && isset($this->edit)) {
            $signatures = $signaturePlayerRepository->getSignatureIdAndNameLivewire();
            $selectedSignature = $this->current_signature->first()?->id ?? null;
            return view('livewire.signature-player', compact('signatures', 'selectedSignature'));
        }
        
        // Otherwise, this is the frontend carousel
        $signature_carousel = $signaturePlayerRepository->getSignatureCarousel();
        return view('bootstrap.livewire.signature-player', compact('signature_carousel'));
    }
}

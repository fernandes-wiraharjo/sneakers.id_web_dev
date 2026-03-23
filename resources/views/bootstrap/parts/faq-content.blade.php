
<div class="accordion" id="faqAccordion">
@foreach ($faq as $key => $row)
    <div class="accordion-item rounded-4 mb-3 border-0 rounded-4 bg-secondary-subtle">
        <h2 class="accordion-header rounded-4" id="heading{{ $key }}">
            <button class="accordion-button fw-bold rounded-4 {{ $key == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $key }}">
                {{ $row->faq_question }}
            </button>
        </h2>
        <div class="accordion-collapse rounded-4 collapse {{ $key == 0 ? 'show' : '' }}" id="collapse{{ $key }}" aria-labelledby="heading{{ $key }}" data-bs-parent="#faqAccordion">
            <div class="accordion-body rounded-4">
                {{ $row->faq_answer }}
            </div>
        </div>
    </div>
@endforeach
</div>

@push('styles')
<style>
    /* Expanded accordion header (black with white text) */
    .accordion-button:not(.collapsed) {
        color: #fff;
        background-color: #000;
        box-shadow: none;
    }
    
    /* Collapsed accordion header (secondary/gray background) */
    .accordion-button.collapsed {
        color: #000;
        background-color: var(--bs-secondary-subtle);
        box-shadow: none;
    }
    
    /* Remove default arrow background image */
    .accordion-button::after {
        background-image: none;
        width: 1.5rem;
        height: 1.5rem;
        font-size: 1.5rem;
        font-weight: 400;
        font-family: sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Minus icon for expanded state (white) */
    .accordion-button:not(.collapsed)::after {
        content: '−';
        color: #fff;
    }
    
    /* Plus icon for collapsed state (black) */
    .accordion-button.collapsed::after {
        content: '+';
        color: #000;
    }
    
    /* Hover effect for collapsed items */
    .accordion-button.collapsed:hover {
        background-color: var(--bs-secondary-subtle);
    }
    
    /* Remove default accordion button focus outline */
    .accordion-button:focus {
        box-shadow: none;
        border-color: transparent;
    }
</style>
@endpush
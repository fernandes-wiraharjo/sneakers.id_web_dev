<div>
    @if($showModal)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Perhatian!</strong> {{ $message }}.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" >&times;</span>
        </button>
    </div>
    {{-- <div class=" modal-message">
        <div wire:ignore.self>
            <span class="_19gi7yt0 _19gi7yte _1fragem1j">
                {{ $message }}
                <a href="#" class="close" wire:click="closeModal"> &times;</a>
            </span>
        </div>
    </div> --}}
    @endif
    {{-- The Master doesn't talk, he acts. --}}
    <script>
        // JavaScript to handle the modal visibility
        document.addEventListener('livewire:load', function () {
            Livewire.on('openModal', function () {
                const modal = document.querySelector('.modal-message');
                modal.style.display = "block";
            });
        });
    </script>
</div>

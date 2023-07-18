<div>
    {{-- The whole world belongs to you. --}}
    <style>
        .close {
            font-size: 30px;
            margin: 0px;
            position: absolute;
            top: -2px;
            right: 14px;
            cursor: pointer;
        }

        .modal{
            position: absolute;
        }
    </style>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    @if($showModal)
        <div wire:ignore.self>
            <div class="Form__Alert Alert Alert--error modal">
                <div>
                    <ul class="Alert__ErrorList modal-content">
                        <li class="Alert__ErrorItem">{{ $message }}</li>
                    </ul>
                </div>
                <div>
                    <button wire:click="closeModal" class="close">&times;</button> <!-- Add a close button to close the modal -->
                </div>
            </div>
        </div>
    @endif

    <script>
        // JavaScript to handle the modal visibility
        document.addEventListener('livewire:load', function () {
            Livewire.on('openModal', function () {
                const modal = document.querySelector('.Form__Alert.modal');
                modal.style.display = "block";
            });
        });
    </script>
</div>

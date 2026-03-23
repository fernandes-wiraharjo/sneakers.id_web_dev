<div>
    @if ($showToast)
    <div class="toast-notification toast-{{ $type }}" 
         style="position: fixed; 
                top: 20px; 
                right: 20px; 
                z-index: 9999; 
                min-width: 300px;
                padding: 15px 20px;
                background-color: {{ $type === 'success' ? '#d4edda' : ($type === 'error' ? '#f8d7da' : ($type === 'warning' ? '#fff3cd' : '#d1ecf1')) }};
                color: {{ $type === 'success' ? '#155724' : ($type === 'error' ? '#721c24' : ($type === 'warning' ? '#856404' : '#0c5460')) }};
                border: 1px solid {{ $type === 'success' ? '#c3e6cb' : ($type === 'error' ? '#f5c6cb' : ($type === 'warning' ? '#ffeeba' : '#bee5eb')) }};
                border-radius: 4px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                display: flex;
                align-items: center;
                justify-content: space-between;
                animation: slideInRight 0.3s ease-out;">
        <div style="display: flex; align-items: center; gap: 10px;">
            @if ($type === 'success')
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            @elseif ($type === 'error')
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
            @elseif ($type === 'warning')
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            @else
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
            @endif
            <span style="font-weight: 500;">{{ $message }}</span>
        </div>
        <button wire:click="hideToast" 
                style="background: none; 
                       border: none; 
                       color: inherit; 
                       cursor: pointer; 
                       font-size: 20px; 
                       padding: 0; 
                       margin-left: 15px;
                       opacity: 0.7;"
                onmouseover="this.style.opacity='1'" 
                onmouseout="this.style.opacity='0.7'">
            ×
        </button>
    </div>
    @endif

    <style>
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .toast-notification.hiding {
            animation: slideOutRight 0.3s ease-out forwards;
        }
    </style>

    <script>
        window.addEventListener('toast-shown', event => {
            // Auto-hide after 3 seconds
            setTimeout(() => {
                @this.call('hideToast');
            }, 3000);
        });
    </script>
</div>


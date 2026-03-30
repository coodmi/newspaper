<div id="toast" 
     class="fixed top-5 right-5 max-w-xs w-full bg-green-600 text-white px-5 py-3 rounded shadow-lg z-50
            opacity-0 translate-x-20 pointer-events-none
            transition-all duration-500 ease-in-out"
     style="display: none;">
    <div class="flex items-center space-x-3">
        <!-- Icon -->
        <svg id="toast-icon" class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 13l4 4L19 7" />
        </svg>
        <span id="toast-message" class="flex-1 text-sm font-medium"></span>
        <!-- Close button -->
        <button id="toast-close" class="ml-3 focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                 stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>

    <script>
        window.addEventListener('notify', event => {
            const toast = document.getElementById('toast');
            const messageSpan = document.getElementById('toast-message');
            const toastIcon = document.getElementById('toast-icon');
    
            // Event.detail can be array or object
            const detail = Array.isArray(event.detail) ? event.detail[0] : event.detail;
    
            // Change background and icon color based on type
            toast.classList.remove('bg-green-600', 'bg-red-600');
            toastIcon.classList.remove('text-green-300', 'text-red-300');
    
            if(detail.type === 'error') {
                toast.classList.add('bg-red-600');
                toastIcon.classList.add('text-red-300');
            } else {
                toast.classList.add('bg-green-600');
                toastIcon.classList.add('text-green-300');
            }
    
            messageSpan.textContent = detail.message;
    
            // Show toast with animation
            toast.style.display = 'block';
    
            // Animate in (opacity 0 -> 1, translate-x-20 -> 0)
            setTimeout(() => {
                toast.classList.remove('opacity-0', 'translate-x-20', 'pointer-events-none');
                toast.classList.add('opacity-100', 'translate-x-0');
            }, 10);
    
            // Hide after 3 seconds with animation
            setTimeout(() => {
                toast.classList.remove('opacity-100', 'translate-x-0');
                toast.classList.add('opacity-0', 'translate-x-20', 'pointer-events-none');
                // After animation ends, hide from DOM
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 500);
            }, 3000);
        });
    
        // Close button to manually hide toast
        document.getElementById('toast-close').addEventListener('click', () => {
            const toast = document.getElementById('toast');
            toast.classList.remove('opacity-100', 'translate-x-0');
            toast.classList.add('opacity-0', 'translate-x-20', 'pointer-events-none');
            setTimeout(() => {
                toast.style.display = 'none';
            }, 500);
        });
    </script>
</div>
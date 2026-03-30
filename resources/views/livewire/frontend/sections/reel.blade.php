<section>
    <div class="w-full mx-auto py-8">
        <div class="inline-flex items-center justify-center w-full">
            <hr class="w-full h-[4px] my-8 bg-gray-200 border-0 dark:bg-zinc-900 rounded-lg">
            <span
                class="absolute px-3 font-semibold text-2xl text-gray-900 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">খবরের ভিডিও</span>
        </div>
        @if ($reels->isNotEmpty()) 
            <div id="carousel-wrapper" class="relative group">
                <div id="reels-carousel" class="carousel-track flex items-center gap-4 md:gap-6 overflow-x-auto scroll-smooth py-4 px-4 sm:px-6 lg:px-8 no-scrollbar">

                    {{-- Laravel @foreach loop starts here --}}
                    @foreach ($reels as $reel)
                                        @php
                        preg_match('/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=|shorts\/)([^#&?]*).*/', $reel->video_url, $matches);
                        $videoId = $matches[2] ?? null;
                                        @endphp

                                        @if ($videoId)
                                            @php
                                                if ($reel->user && $reel->user->profile_image) {
                                                    $userProfile = asset('storage/' . $reel->user->profile_image);
                                                } else {
                                                    $userProfile = 'https://placehold.co/250x250?text=user';
                                                }
                                            @endphp
                                                <article id="reel-{{ $reel->id }}" 
                                                         class="reel-card carousel-item group relative aspect-[9/16] w-[65vw] sm:w-64 md:w-72 flex-shrink-0 bg-black rounded-xl overflow-hidden shadow-lg cursor-pointer transition-all duration-300 ease-in-out"
                                                         data-videoid="{{ $videoId }}"
                                                         data-title="{{ $reel->title }}"
                                                         data-username="{{ $reel->user->name ?? 'Reporter' }}"
                                                         data-avatar="{{ $userProfile }}"
                                                         data-slug="{{ $reel->slug }}">

                                                    <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300" alt="{{ $reel->title }}">
                                                    <div class="video-placeholder absolute inset-0 w-full h-full"></div>
                                                    <div class="absolute inset-0 bg-black/20 flex items-center justify-center pointer-events-none">
                                                        <div class="play-icon w-16 h-16 bg-black/40 rounded-full flex items-center justify-center transition-all duration-300 opacity-80 group-hover:opacity-100 group-hover:scale-110">
                                                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"></path></svg>
                                                        </div>
                                                    </div>
                                                    <div class="reel-info absolute bottom-0 left-0 p-4 w-full bg-gradient-to-t from-black/70 to-transparent transition-opacity duration-300 pointer-events-none">
                                                        <div class="flex items-center space-x-3">
                                                            {{-- <img src="{{ asset('storage/' . $reel->user->profile_image) }}" alt="Reporter Avatar" class="w-10 h-10 rounded-full border-2 border-white"> --}}
                                                            <div class="max-w-10 min-w-10 h-10 rounded-full overflow-hidden border-2 border-white">
                                                                <img src="{{ $userProfile }}" alt="Reporter Avatar" class="w-full min-h-full">
                                                            </div>
                                                            <div>
                                                                <p class="font-bold text-sm text-white">{{ $reel->user->name ?? 'Reporter' }}</p>
                                                                <p class="text-xs text-gray-300">{{ $reel->title }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                        @endif
                    @endforeach
                     {{-- Laravel @foreach loop ends here --}}
                </div>

                <button id="scroll-left" class="absolute left-0 top-1/2 -translate-y-1/2 bg-gray-800/50 hover:bg-gray-800/80 p-2 rounded-full z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 ml-2 disabled:opacity-0 disabled:cursor-not-allowed"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg></button>
                <button id="scroll-right" class="absolute right-0 top-1/2 -translate-y-1/2 bg-gray-800/50 hover:bg-gray-800/80 p-2 rounded-full z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 mr-2 disabled:opacity-0 disabled:cursor-not-allowed"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></button>
            </div>
        @else
            <p class="text-center text-2xl font-bold">No reels found.</p>
        @endif
    </div>
    
    <div id="reel-modal" class="hidden fixed inset-0 bg-black/90 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div id="modal-bg-close" class="absolute inset-0"></div>
        <div class="relative w-full max-w-sm" style="max-height: 90vh;">
            <div class="relative aspect-[9/16] bg-black rounded-xl overflow-hidden flex flex-col justify-between">
                <div class="absolute top-0 left-0 right-0 p-4 z-10 bg-gradient-to-b from-black/50 to-transparent">
                    <div id="modal-info" class="flex items-center space-x-3">
                        {{-- <img id="modal-avatar" src="" alt="Reporter Avatar" class="w-10 h-10 rounded-full border-2 border-white"> --}}
                        <div class="max-w-10 min-w-10 h-10 rounded-full overflow-hidden border-2 border-white">
                            <img id="modal-avatar" src="" alt="Reporter Avatar" class="w-full min-h-full">
                        </div>
                        <div>
                            <p id="modal-username" class="font-bold text-white text-sm"></p>
                            <a id="modal-title-link" href="#" wire:navigate class="text-xs text-gray-300 hover:underline">
                                <p id="modal-title"></p>
                            </a>
                        </div>
                    </div>
                    <button id="modal-close-btn" class="absolute top-4 right-4 text-white/70 hover:text-white text-2xl"><i class="fas fa-times"></i></button>
                </div>

                <div id="modal-content-wrapper" class="w-full h-full"></div>
            </div>
            
            <button id="modal-prev" class="absolute left-14 top-1/2 -translate-y-1/2 -ml-12 bg-white/20 hover:bg-white/40 text-white rounded-full w-10 h-10 flex items-center justify-center text-2xl disabled:opacity-50 disabled:cursor-not-allowed"><i class="fas fa-chevron-left"></i></button>
            <button id="modal-next" class="absolute right-14 top-1/2 -translate-y-1/2 -mr-12 bg-white/20 hover:bg-white/40 text-white rounded-full w-10 h-10 flex items-center justify-center text-2xl disabled:opacity-50 disabled:cursor-not-allowed"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
    @push('styles')
        <style>
            .no-scrollbar::-webkit-scrollbar { display: none; }
            .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
            body { font-family: 'Inter', sans-serif; }
            .carousel-track { scroll-snap-type: x mandatory; }
            .carousel-item { scroll-snap-align: center; }
            body.modal-open { overflow: hidden; }
            .reel-iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0; }
        </style>
    @endpush
    @push('scripts')
        <script>
            function initializeReels() {
                let allReelsData = [];
                let currentModalIndex = 0;
        
                const closeModal = () => {
                    document.getElementById('reel-modal')?.classList.add('hidden');
                    document.body.classList.remove('modal-open');
                    document.getElementById('modal-content-wrapper').innerHTML = "";
                };
        
                const populateReelsData = () => {
                    allReelsData = Array.from(document.querySelectorAll('.reel-card')).map(card => card.dataset);
                };
        
                const showModalVideo = (index) => {
                    if (index < 0 || index >= allReelsData.length) return;
                    currentModalIndex = index;
                    const reelData = allReelsData[index];
        
                    const modalContentWrapper = document.getElementById('modal-content-wrapper');
                    const modalAvatar = document.getElementById('modal-avatar');
                    const modalUsername = document.getElementById('modal-username');
                    const modalTitle = document.getElementById('modal-title');
                    const modalTitleLink = document.getElementById('modal-title-link');
        
                    modalContentWrapper.innerHTML = `
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/${reelData.videoid}?autoplay=1&controls=1" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    `;
        
                    if (modalAvatar) modalAvatar.src = reelData.avatar;
                    if (modalUsername) modalUsername.textContent = reelData.username;
                    if (modalTitle) modalTitle.textContent = reelData.title;
                    if (modalTitleLink) modalTitleLink.href = `/post/${reelData.slug}`;
        
                    document.getElementById('modal-prev').disabled = currentModalIndex === 0;
                    document.getElementById('modal-next').disabled = currentModalIndex === allReelsData.length - 1;
                };
        
                const handleMouseEnter = (e) => {
                    const card = e.currentTarget;
                    const videoId = card.dataset.videoid;
                    if (!videoId) return;
                    const placeholder = card.querySelector('.video-placeholder');
                    const img = card.querySelector('img');
                    const playIcon = card.querySelector('.play-icon');
                    if (img) img.style.opacity = '0';
                    if (playIcon) playIcon.style.opacity = '0';
                    placeholder.innerHTML = `
                        <iframe class="reel-iframe pointer-events-none" src="https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1&controls=0&loop=1&playlist=${videoId}" allow="autoplay" allowfullscreen></iframe>
                    `;
                };
        
                const handleMouseLeave = (e) => {
                    const card = e.currentTarget;
                    const placeholder = card.querySelector('.video-placeholder');
                    placeholder.innerHTML = '';
                    const img = card.querySelector('img');
                    const playIcon = card.querySelector('.play-icon');
                    if (img) img.style.opacity = '1';
                    if (playIcon) playIcon.style.opacity = '0.8';
                };
        
                const handleCardClick = (e) => {
                    const card = e.currentTarget;
                    const videoId = card.dataset.videoid;
                    if (!videoId) return;
        
                    handleMouseLeave({ currentTarget: card });
        
                    currentModalIndex = allReelsData.findIndex(reel => reel.videoid === videoId);
                    showModalVideo(currentModalIndex);
        
                    document.getElementById('reel-modal')?.classList.remove('hidden');
                    document.body.classList.add('modal-open');
                };
        
                const attachAllListeners = () => {
                    populateReelsData();
        
                    const cards = document.querySelectorAll('.reel-card');
                    cards.forEach(card => {
                        card.removeEventListener('click', handleCardClick);
                        card.removeEventListener('mouseenter', handleMouseEnter);
                        card.removeEventListener('mouseleave', handleMouseLeave);
        
                        card.addEventListener('click', handleCardClick);
                        card.addEventListener('mouseenter', handleMouseEnter);
                        card.addEventListener('mouseleave', handleMouseLeave);
                    });
        
                    const modalPrevBtn = document.getElementById('modal-prev');
                    const modalNextBtn = document.getElementById('modal-next');
        
                    if (modalPrevBtn) modalPrevBtn.onclick = () => showModalVideo(currentModalIndex - 1);
                    if (modalNextBtn) modalNextBtn.onclick = () => showModalVideo(currentModalIndex + 1);
                };
        
                const setupNavButtons = () => {
                    const carousel = document.getElementById('reels-carousel');
                    const leftButton = document.getElementById('scroll-left');
                    const rightButton = document.getElementById('scroll-right');
                    const cards = document.querySelectorAll('.reel-card');
        
                    if (!carousel || cards.length === 0) return;
        
                    const checkScrollButtons = () => {
                        const maxScrollLeft = carousel.scrollWidth - carousel.clientWidth;
                        leftButton.disabled = carousel.scrollLeft <= 1;
                        rightButton.disabled = carousel.scrollLeft >= maxScrollLeft - 1;
                    };
        
                    const getCardWidthAndGap = () => {
                        const cardWidth = cards[0].offsetWidth;
                        const gap = parseInt(window.getComputedStyle(carousel).gap) || 0;
                        return { cardWidth, gap };
                    };
        
                    leftButton.onclick = () => {
                        const { cardWidth, gap } = getCardWidthAndGap();
                        carousel.scrollBy({ left: -(cardWidth + gap), behavior: 'smooth' });
                    };
        
                    rightButton.onclick = () => {
                        const { cardWidth, gap } = getCardWidthAndGap();
                        carousel.scrollBy({ left: cardWidth + gap, behavior: 'smooth' });
                    };
        
                    carousel.removeEventListener('scroll', checkScrollButtons);
                    carousel.addEventListener('scroll', checkScrollButtons);
                    window.removeEventListener('resize', checkScrollButtons);
                    window.addEventListener('resize', checkScrollButtons);
                    checkScrollButtons();
                };
        
                // Call helpers
                attachAllListeners();
                setupNavButtons();
        
                // Modal close buttons
                const modalCloseBtn = document.getElementById('modal-close-btn');
                const modalBgClose = document.getElementById('modal-bg-close');
                if (modalCloseBtn) {
                    modalCloseBtn.removeEventListener('click', closeModal);
                    modalCloseBtn.addEventListener('click', closeModal);
                }
                if (modalBgClose) {
                    modalBgClose.removeEventListener('click', closeModal);
                    modalBgClose.addEventListener('click', closeModal);
                }
            }
        
            // Call on all Livewire lifecycle events
            document.addEventListener('DOMContentLoaded', initializeReels);
            document.addEventListener('livewire:load', initializeReels);
            document.addEventListener('livewire:updated', initializeReels);
            document.addEventListener('livewire:navigated', initializeReels);
        </script>

    @endpush
</section>


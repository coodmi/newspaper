<div class="w-full my-1">
    @if ($adSlot && $adSlot->ad_type === 'google' && !empty($adSlot->google_ad_code))
        <div class="max-w-7xl mx-auto px-4">
            {!! $adSlot->google_ad_code !!}
        </div>
    @elseif ($adSlot && $adSlot->ad_type === 'personal' && $personalAd)
        <div class="max-w-7xl mx-auto px-4">
            <a href="{{ $personalAd->target_link }}" target="_blank" rel="noopener noreferrer sponsored">
                <img src="{{ asset('storage/' . $personalAd->ad_image) }}"
                     alt="Advertisement"
                     class="w-full h-auto max-h-[90px] object-cover rounded">
            </a>
        </div>
    @else
        {{-- Demo placeholder banner --}}
        <div class="max-w-7xl mx-auto px-4">
            <div style="width:100%;height:90px;background:linear-gradient(135deg,#f0f4ff 0%,#e8eeff 100%);border:1.5px dashed #c7d2fe;border-radius:8px;display:flex;align-items:center;justify-content:center;gap:12px;">
                <svg style="width:22px;height:22px;color:#818cf8;flex-shrink:0;" fill="none" stroke="#818cf8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
                <div style="text-align:center;">
                    <div style="font-size:13px;font-weight:600;color:#6366f1;letter-spacing:.02em;">বিজ্ঞাপন এলাকা</div>
                    <div style="font-size:11px;color:#94a3b8;margin-top:2px;">970 × 90 — Admin থেকে পরিবর্তন করুন</div>
                </div>
            </div>
        </div>
    @endif
</div>

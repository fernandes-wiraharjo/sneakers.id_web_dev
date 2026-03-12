@php
    $item = $topTextCarousel;
    $common_emojis = [
        '👟', '👠', '👡', '👢', '👞', '🥿', '🩴',  // shoes – sneakers, heels, sandals, boots, flats
        '🛒', '💰', '🏷️', '📦', '🚚', '💳', '✅', '📉',  // e‑commerce – cart, sale, delivery, payment, discount
        '🔥', '⭐', '✨', '🎉', '🆕', '💯', '❤️', '🎁',  // promo – hot, new, love, gift
        '🏃', '⚽', '🎽',  // sport / active
    ];
@endphp

<x-ladmin-form-group name="text" label="Text *">
    <input type="text" class="form-control" name="text" id="top-text-carousel-text" required
        value="{{ old('text', $item->text) }}" placeholder="Carousel text" maxlength="500"
        {{ $edit ? '' : 'autofocus' }}>
    <div class="mt-2">
        <span class="text-muted small d-block mb-1">Insert emoji:</span>
        <div class="d-flex flex-wrap gap-1 emoji-selector">
            @foreach($common_emojis as $emoji)
                <button type="button" class="btn btn-sm btn-light border p-1 px-2 emoji-btn" data-emoji="{{ $emoji }}" title="Insert {{ $emoji }}">{{ $emoji }}</button>
            @endforeach
        </div>
    </div>
</x-ladmin-form-group>

@push('scripts')
<script>
(function() {
    var input = document.getElementById('top-text-carousel-text');
    if (!input) return;
    document.querySelectorAll('.emoji-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var emoji = this.getAttribute('data-emoji');
            var start = input.selectionStart, end = input.selectionEnd, val = input.value;
            input.value = val.slice(0, start) + emoji + val.slice(end);
            input.focus();
            input.setSelectionRange(start + emoji.length, start + emoji.length);
        });
    });
})();
</script>
@endpush

<x-ladmin-form-group name="link" label="Link">
    <input type="url" class="form-control" name="link" id="link"
        value="{{ old('link', $item->link) }}" placeholder="https://... (optional)" maxlength="500">
</x-ladmin-form-group>

<x-ladmin-form-group name="sort_order" label="Sort Order">
    <input type="number" class="form-control" name="sort_order" id="sort_order" min="0"
        value="{{ old('sort_order', $item->sort_order ?? 0) }}" placeholder="0">
</x-ladmin-form-group>

@include('back-office.components.is_active', ['is_active' => $item->is_active ?? true, 'edit' => $edit])

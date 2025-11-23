<div class="position-absolute end-0 {{$cartCounter > 0 ? 'd-block' : 'd-none'}}" style="top: 10px">
    <span id="cartCounter" class="bg-danger rounded-circle p-2 text-white cart-counter">{{ $cartCounter ?? 0 }}</span>
</div>
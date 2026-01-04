<div class="position-absolute top-0 end-0 {{$cartCounter > 0 ? 'd-block' : 'd-none'}}">
    <span id="cartCounter" class="bg-danger rounded-circle p-2 text-white cart-counter">{{ $cartCounter ?? 0 }}</span>
</div>
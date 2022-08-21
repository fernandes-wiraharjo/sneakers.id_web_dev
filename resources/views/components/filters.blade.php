<div class="accordion" id="kt_accordion_1">
    <div class="accordion-item border-0 bg-transparent">
        <h2 class="accordion-header" id="brand">
            <button class="accordion-button fs-4 fw-semibold bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#brand-body" aria-expanded="true" aria-controls="brand-body">
                BRAND
            </button>
        </h2>
        <div id="brand-body" class="accordion-collapse collapse show" aria-labelledby="brand" data-bs-parent="#kt_accordion_1">
            <div class="accordion-body">
                @foreach ($brand as $item)
                    <div class="form-check form-check-custom form-check-solid form-check-sm m-2">
                        <input class="form-check-input" type="checkbox" wire:model="brand.{{$item->id}}" value="{{$item->id}}" id="brand-{{$item->id}}" />
                        <label class="form-check-label" for="brand-{{$item->id}}">
                            {{ strtoupper($item->brand_title) }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="accordion-item border-0 bg-transparent">
        <h2 class="accordion-header" id="category">
            <button class="accordion-button fs-4 fw-semibold bg-transparentcollapsed" type="button" data-bs-toggle="collapse" data-bs-target="#category-body" aria-expanded="false" aria-controls="category-body">
                CATEGORY
            </button>
        </h2>
        <div id="category-body" class="accordion-collapse collapsed collapse" aria-labelledby="category" data-bs-parent="#kt_accordion_1">
            <div class="accordion-body">
                @foreach ($category as $item)
                    <div class="form-check form-check-custom form-check-solid form-check-sm m-2">
                        <input class="form-check-input" type="checkbox" wire:model="category.{{$item->id}}" value="{{$item->id}}" id="brand-{{$item->id}}" />
                        <label class="form-check-label" for="brand-{{$item->id}}">
                            {{ strtoupper($item->category_title) }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="accordion-item border-0 bg-transparent">
        <h2 class="accordion-header" id="tag">
            <button class="accordion-button fs-4 fw-semibold bg-transparentcollapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tag-body" aria-expanded="false" aria-controls="tag-body">
                TAG
            </button>
        </h2>
        <div id="tag-body" class="accordion-collapse collapsed collapse" aria-labelledby="tag" data-bs-parent="#kt_accordion_1">
            <div class="accordion-body">
                @foreach ($tag as $item)
                    <div class="form-check form-check-custom form-check-solid form-check-sm m-2">
                        <input class="form-check-input" type="checkbox" wire:model="tag.{{$item->id}}" value="{{$item->id}}" id="tag-{{$item->id}}" />
                        <label class="form-check-label" for="tag-{{$item->id}}">
                            {{ strtoupper($item->tag_title) }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="accordion-item border-0 bg-transparent">
        <h2 class="accordion-header" id="signature">
            <button class="accordion-button fs-4 fw-semibold bg-transparentcollapsed" type="button" data-bs-toggle="collapse" data-bs-target="#signature-body" aria-expanded="false" aria-controls="signature-body">
                SIGNATURE PLAYER
            </button>
        </h2>
        <div id="signature-body" class="accordion-collapse collapsed collapse" aria-labelledby="signature" data-bs-parent="#kt_accordion_1">
            <div class="accordion-body">
                @foreach ($signature_player as $item)
                    <div class="form-check form-check-custom form-check-solid form-check-sm m-2">
                        <input class="form-check-input" type="checkbox" wire:model="signature.{{$item->id}}" value="{{$item->id}}" id="signature-{{$item->id}}" />
                        <label class="form-check-label" for="signature-{{$item->id}}">
                            {{ strtoupper($item->signature_title) }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="accordion-item border-0 bg-transparent">
        <h2 class="accordion-header" id="size">
            <button class="accordion-button fs-4 fw-semibold bg-transparentcollapsed" type="button" data-bs-toggle="collapse" data-bs-target="#size-body" aria-expanded="false" aria-controls="size-body">
                SIZE
            </button>
        </h2>
        <div id="size-body" class="accordion-collapse collapsed collapse" aria-labelledby="size" data-bs-parent="#kt_accordion_1">
            <div class="accordion-body">
                @foreach ($size as $item)
                    <div class="form-check form-check-custom form-check-solid form-check-sm m-2">
                        <input class="form-check-input" type="checkbox" wire:model="size.{{$item->id}}" value="{{$item->id}}" id="size-{{$item->id}}" />
                        <label class="form-check-label" for="size-{{$item->id}}">
                            {{ strtoupper($item->size_title) }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

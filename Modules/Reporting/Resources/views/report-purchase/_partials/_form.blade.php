@php
    $rp = $reportPurchase;
    $formatRp = function ($v) {
        if ($v === null || $v === '') return '';
        return rupiah_format((int) $v, false);
    };
@endphp

{{-- Card: Customer info --}}
<div class="card mb-5">
    <div class="card-header">
        <h3 class="card-title">Customer Info</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <x-ladmin-form-group name="order_id" label="Order ID *">
                    <input type="text" class="form-control text-uppercase" name="order_id" id="order_id" required
                        value="{{ old('order_id', $rp->order_id) }}" placeholder="Order ID">
                </x-ladmin-form-group>
            </div>
            <div class="col-md-6">
                <x-ladmin-form-group name="transaction_date" label="Transaction Date *">
                    <input type="date" class="form-control" name="transaction_date" id="transaction_date" required
                        value="{{ old('transaction_date', $rp->transaction_date ? $rp->transaction_date->format('Y-m-d') : '') }}">
                </x-ladmin-form-group>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-ladmin-form-group name="customer_name" label="Customer Name *">
                    <input type="text" class="form-control text-uppercase" name="customer_name" id="customer_name" required
                        value="{{ old('customer_name', $rp->customer_name) }}" placeholder="Customer Name">
                </x-ladmin-form-group>
            </div>
            <div class="col-md-6">
                <x-ladmin-form-group name="transaction_type" label="Transaction Type">
                    <input type="text" class="form-control text-uppercase" name="transaction_type" id="transaction_type"
                        value="{{ old('transaction_type', $rp->transaction_type ?? 'WEB') }}" placeholder="e.g. WEB">
                </x-ladmin-form-group>
            </div>
        </div>
        <x-ladmin-form-group name="location" label="Location">
            <input type="text" class="form-control text-uppercase" name="location" id="location"
                value="{{ old('location', $rp->location) }}" placeholder="Location">
        </x-ladmin-form-group>
        <x-ladmin-form-group name="phone_number" label="Phone Number">
            <input type="text" class="form-control text-uppercase" name="phone_number" id="phone_number"
                value="{{ old('phone_number', $rp->phone_number) }}" placeholder="Phone Number">
        </x-ladmin-form-group>
        <x-ladmin-form-group name="awb_number" label="AWB Number">
            <input type="text" class="form-control text-uppercase" name="awb_number" id="awb_number"
                value="{{ old('awb_number', $rp->awb_number) }}" placeholder="AWB Number">
        </x-ladmin-form-group>
    </div>
</div>

{{-- Card: Product & price --}}
<div class="card mb-5">
    <div class="card-header">
        <h3 class="card-title">Product & Price</h3>
    </div>
    <div class="card-body">
        <x-ladmin-form-group name="article_number" label="Article Number">
            <div class="position-relative" id="article-number-wrap">
                <input type="text" class="form-control text-uppercase" name="article_number" id="article_number" autocomplete="off"
                    value="{{ old('article_number', $rp->article_number) }}" placeholder="Type 3+ characters to search">
                <ul class="list-group position-absolute w-100 shadow-sm" id="article-number-list" style="z-index: 1050; display: none; max-height: 280px; overflow-y: auto;"></ul>
            </div>
        </x-ladmin-form-group>

        <x-ladmin-form-group name="product_name" label="Product Name">
            <input type="text" class="form-control text-uppercase" name="product_name" id="product_name"
                value="{{ old('product_name', $rp->product_name) }}" placeholder="Product Name">
        </x-ladmin-form-group>

        <div class="row">
            <div class="col-md-6">
                <x-ladmin-form-group name="size" label="Size">
                    <input type="text" class="form-control text-uppercase" name="size" id="size"
                        value="{{ old('size', $rp->size) }}" placeholder="Size">
                </x-ladmin-form-group>
            </div>
            <div class="col-md-6">
                <x-ladmin-form-group name="quantity" label="Quantity *">
                    <input type="number" class="form-control" name="quantity" id="quantity" required min="0" step="1"
                        value="{{ old('quantity', $rp->quantity ?? 1) }}">
                </x-ladmin-form-group>
            </div>
        </div>

        <x-ladmin-form-group name="price_ongkir" label="Price Ongkir (Rp)">
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="text" class="form-control price-input" name="price_ongkir" id="price_ongkir" placeholder="0"
                    value="{{ old('price_ongkir', $formatRp($rp->price_ongkir)) }}">
            </div>
        </x-ladmin-form-group>

        <input type="hidden" id="base_price_per_unit" value="">
        <x-ladmin-form-group name="price_modal" label="Price Modal (Rp)">
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="text" class="form-control price-input" name="price_modal" id="price_modal" placeholder="0"
                    value="{{ old('price_modal', $formatRp($rp->price_modal)) }}">
            </div>
        </x-ladmin-form-group>

        <x-ladmin-form-group name="price_jual" label="Price Jual (Rp)">
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="text" class="form-control price-input" name="price_jual" id="price_jual" placeholder="0"
                    value="{{ old('price_jual', $formatRp($rp->price_jual)) }}">
            </div>
        </x-ladmin-form-group>

        <x-ladmin-form-group name="price_voucher" label="Voucher (Rp)">
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="text" class="form-control price-input" name="price_voucher" id="price_voucher" placeholder="-"
                    value="{{ old('price_voucher', $formatRp($rp->price_voucher)) }}">
            </div>
        </x-ladmin-form-group>

        <x-ladmin-form-group name="price_total_payment" label="Price Total Payment (Rp)">
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="text" class="form-control price-input" name="price_total_payment" id="price_total_payment" placeholder="0"
                    value="{{ old('price_total_payment', $formatRp($rp->price_total_payment)) }}">
            </div>
        </x-ladmin-form-group>

        <div class="row">
            <div class="col-md-6">
                <x-ladmin-form-group name="margin_net" label="Margin Net (Rp)">
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control price-input" name="margin_net" id="margin_net" placeholder="0"
                            value="{{ old('margin_net', $formatRp($rp->margin_net)) }}">
                    </div>
                </x-ladmin-form-group>
            </div>
            <div class="col-md-6">
                <x-ladmin-form-group name="modal_net" label="Modal Net (Rp)">
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control price-input" name="modal_net" id="modal_net" placeholder="0"
                            value="{{ old('modal_net', $formatRp($rp->modal_net)) }}">
                    </div>
                </x-ladmin-form-group>
            </div>
        </div>
    </div>
</div>

{{-- Card: DP & Sisa --}}
<div class="card mb-5">
    <div class="card-header">
        <h3 class="card-title">DP & Sisa</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <x-ladmin-form-group name="dp_owner" label="DP Owner (Rp)">
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control price-input" name="dp_owner" id="dp_owner" placeholder="0"
                            value="{{ old('dp_owner', $formatRp($rp->dp_owner)) }}">
                    </div>
                </x-ladmin-form-group>
            </div>
            <div class="col-md-6">
                <x-ladmin-form-group name="dp_supplier" label="DP Supplier (Rp)">
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control price-input" name="dp_supplier" id="dp_supplier" placeholder="0"
                            value="{{ old('dp_supplier', $formatRp($rp->dp_supplier)) }}">
                    </div>
                </x-ladmin-form-group>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-ladmin-form-group name="sisa_owner" label="Sisa Owner (Rp)">
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control price-input" name="sisa_owner" id="sisa_owner" placeholder="0"
                            value="{{ old('sisa_owner', $formatRp($rp->sisa_owner)) }}">
                    </div>
                </x-ladmin-form-group>
            </div>
            <div class="col-md-6">
                <x-ladmin-form-group name="sisa_supplier" label="Sisa Supplier (Rp)">
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control price-input" name="sisa_supplier" id="sisa_supplier" placeholder="0"
                            value="{{ old('sisa_supplier', $formatRp($rp->sisa_supplier)) }}">
                    </div>
                </x-ladmin-form-group>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-ladmin-form-group name="status_owner" label="Status Owner">
                    <select class="form-select" name="status_owner" id="status_owner">
                        <option value="">-- Pilih --</option>
                        <option value="belum lunas" {{ old('status_owner', $rp->status_owner) == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="lunas" {{ old('status_owner', $rp->status_owner) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="sebagian" {{ old('status_owner', $rp->status_owner) == 'sebagian' ? 'selected' : '' }}>Sebagian</option>
                    </select>
                </x-ladmin-form-group>
            </div>
            <div class="col-md-6">
                <x-ladmin-form-group name="status_supplier" label="Status Supplier">
                    <select class="form-select" name="status_supplier" id="status_supplier">
                        <option value="">-- Pilih --</option>
                        <option value="belum lunas" {{ old('status_supplier', $rp->status_supplier) == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="lunas" {{ old('status_supplier', $rp->status_supplier) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="sebagian" {{ old('status_supplier', $rp->status_supplier) == 'sebagian' ? 'selected' : '' }}>Sebagian</option>
                    </select>
                </x-ladmin-form-group>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(function() {
    var typeaheadUrl = '{{ route("administrator.report-purchase.typeahead-article") }}';
    var $list = $('#article-number-list');
    var $wrap = $('#article-number-wrap');

    function parseNum(str) {
        if (str == null || str === '') return 0;
        return parseInt(String(str).replace(/\D/g, ''), 10) || 0;
    }
    function formatRp(num) {
        if (num == null || isNaN(num)) return '';
        return Number(num).toLocaleString('id-ID');
    }

    // Uppercase for string inputs
    $('.text-uppercase').on('input blur', function() {
        $(this).val($(this).val().toUpperCase());
    });

    // Price inputs: focus = raw number, blur = formatted
    $('.price-input').on('focus', function() {
        var n = parseNum($(this).val());
        $(this).val(n > 0 ? String(n) : '');
    }).on('blur', function() {
        var n = parseNum($(this).val());
        $(this).val(n > 0 ? formatRp(n) : '');
    });

    // Before submit: strip formatting from price inputs
    $('#report-purchase-form').on('submit', function() {
        $('.price-input').each(function() {
            $(this).val(parseNum($(this).val()));
        });
    });

    // Auto-fill derived prices on keyup: price_total_payment = price_jual + price_ongkir - price_voucher; margin_net; modal_net
    function updateDerivedPrices() {
        var pJual = parseNum($('#price_jual').val());
        var pOngkir = parseNum($('#price_ongkir').val());
        var pModal = parseNum($('#price_modal').val());
        var pVoucher = parseNum($('#price_voucher').val());
        $('#price_total_payment').val(formatRp(pJual + pOngkir - pVoucher));
        $('#margin_net').val(formatRp(pJual - pModal));
        $('#modal_net').val(formatRp((pJual - pModal) / 2 + pModal));
    }
    $('#price_jual, #price_ongkir, #price_modal, #price_voucher').on('input keyup', function() {
        updateDerivedPrices();
    });

    // When quantity changes and we have a base price from typeahead, recalc price_modal = base_price_per_unit * quantity
    $('#quantity').on('input change keyup', function() {
        var basePerUnit = parseInt($('#base_price_per_unit').val(), 10);
        if (!basePerUnit) return;
        var qty = parseInt($(this).val(), 10) || 0;
        $('#price_modal').val(formatRp(basePerUnit * qty));
        updateDerivedPrices();
    });

    // Typeahead: min 3 chars, use mousedown so selection runs before blur hides list
    var typeaheadTimer;
    $('#article_number').on('input', function() {
        var q = $.trim($(this).val());
        $list.empty().hide();
        if (q.length < 3) return;
        clearTimeout(typeaheadTimer);
        typeaheadTimer = setTimeout(function() {
            $.getJSON(typeaheadUrl, { q: q }).done(function(items) {
                $list.empty();
                if (!items || items.length === 0) {
                    $list.hide();
                    return;
                }
                $.each(items, function(i, item) {
                    var basePrice = parseInt(item.base_price, 10) || 0;
                    var $li = $('<li class="list-group-item list-group-item-action" style="cursor: pointer;"></li>')
                        .text((item.product_code || '') + ' - ' + (item.product_name || '') + ' - ' + (item.size || '') + ' (Rp ' + formatRp(basePrice) + ')')
                        .attr('data-product-code', item.product_code || '')
                        .attr('data-product-name', item.product_name || '')
                        .attr('data-size', item.size || '')
                        .attr('data-base-price', basePrice);
                    $li.on('mousedown', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        var code = $(this).data('product-code');
                        var name = ($(this).data('product-name') || '').toString().toUpperCase();
                        var sizeVal = ($(this).data('size') || '').toString().toUpperCase();
                        var base = $(this).data('base-price') || 0;
                        var qty = parseInt($('#quantity').val(), 10) || 1;
                        $('#article_number').val(code);
                        $('#product_name').val(name);
                        $('#size').val(sizeVal);
                        $('#base_price_per_unit').val(base);
                        $('#price_modal').val(formatRp(base * qty));
                        $list.empty().hide();
                        updateDerivedPrices();
                    });
                    $list.append($li);
                });
                $list.show();
            });
        }, 200);
    });

    $('#article_number').on('blur', function() {
        setTimeout(function() { $list.hide(); }, 200);
    });

    $(document).on('click', function(e) {
        if ($(e.target).closest('#article-number-wrap').length === 0) {
            $list.hide();
        }
    });
});
</script>
@endpush

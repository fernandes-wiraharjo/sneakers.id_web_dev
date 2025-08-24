function openModal(transaction_id){
    $('.loading-spinner-' + transaction_id).hide();
    $('.description-check-resi-' + transaction_id).hide();
    $('.description-check-resi-' + transaction_id).empty();
    var manifestTimeline = $('.timeline--' + transaction_id);
    manifestTimeline.empty(); // Clear existing manifest timeline
    $('.check-resi-' + transaction_id).hide();
}

function fieldResi(transaction_id){
    var waybill = $('.shipping-waybill-'+transaction_id).val();
    var waybillButton = $('#shipping-waybill-'+transaction_id);
    if(waybill != undefined || waybill != null || waybill != "") {
        waybillButton.prop('disabled', false);
    }

    if (waybill == '') {
        waybillButton.prop("disabled", true);
    }
}

function checkResi(transaction_id){
    //ajax here
    var waybill = $('.shipping-waybill-'+transaction_id).val();
    var csrf = $('.csrf-token-'+transaction_id).val();
    // Mengirim data ke server
    // Show loading animation
    $('.loading-spinner-' + transaction_id).show();
    // Clear existing HTML content
    $('.description-check-resi-' + transaction_id).hide();
    $('.description-check-resi-' + transaction_id).empty();
    $.ajax({
        url: "transaction/check-resi",
        method: 'POST',
        data: {
            shipping_waybill: waybill,
            _token: csrf
        },
        success: function(response) {
            // Hide loading animation
            $('.loading-spinner-' + transaction_id).hide();
            // Menampilkan hasil ongkir
            if (response.status.code != 200) {
                var html = '<div class="description-response-' + transaction_id + '">' + response.status.description + '</div>';
                $('.description-check-resi-' + transaction_id).show().append(html);
            } else {
                var manifest = response.result.manifest;
                var manifestTimeline = $('.timeline--' + transaction_id);
                manifestTimeline.empty(); // Clear existing manifest timeline

                manifest.forEach(function(item) {
                var text = `
                    <div class="info">
                    <h3 class="title">`+item.manifest_description+`</h3>
                    <p>`+item.manifest_date +` - `+ item.city_name +`</p>
                    </div>`;
                var listItem = $('<div class="card-timeline">').html(text);
                manifestTimeline.append(listItem);
                });

                $('.check-resi-' + transaction_id).show();
            }
        }
    });
}

var elements = Array.prototype.slice.call(document.querySelectorAll("[data-bs-stacked-modal]"));

if (elements && elements.length > 0) {
    elements.forEach((element) => {
        if (element.getAttribute("data-kt-initialized") === "1") {
            return;
        }

        element.setAttribute("data-kt-initialized", "1");

        element.addEventListener("click", function(e) {
            e.preventDefault();

            const modalEl = document.querySelector(this.getAttribute("data-bs-stacked-modal"));

            if (modalEl) {
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            }
        });
    });
}

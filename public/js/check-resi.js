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

function checkResi(transaction_id) {
    var waybill = $('.shipping-waybill-'+transaction_id).val();
    var csrf = $('.csrf-token-'+transaction_id).val();

    // Show loading animation
    $('.loading-spinner-' + transaction_id).show();

    // Clear existing HTML content
    $('.description-check-resi-' + transaction_id).hide().empty();

    $.ajax({
        url: "transaction/check-resi",
        method: 'POST',
        data: {
            id: transaction_id,
            shipping_waybill: waybill,
            _token: csrf
        },
        success: function(response) {
            $('.loading-spinner-' + transaction_id).hide();
            if (response.meta && response.meta.code !== 200) {
                var html = `
                    <div class="description-response-${transaction_id}"
                         style="color:red; font-weight:bold;">
                        ${response.meta.message}
                    </div>`;
                $('.description-check-resi-' + transaction_id).show().append(html);
                return;
            }

            if (response.data) {
                var summary = response.data.summary;
                if (summary) {
                    var summaryHtml = `
                        <div class="summary-response-${transaction_id}">
                            <p><b>Kurir:</b> ${summary.courier_name} (${summary.courier_code})</p>
                            <p><b>No Resi:</b> ${summary.waybill_number}</p>
                            <p><b>Status:</b> ${summary.status}</p>
                        </div>`;
                    $('.description-check-resi-' + transaction_id).show().append(summaryHtml);
                }

                var manifest = response.data.manifest || [];
                var manifestTimeline = $('.timeline--' + transaction_id);
                manifestTimeline.empty();

                manifest.forEach(function (item) {
                    var text = `
                        <div class="info">
                            <h3 class="title">${item.manifest_description}</h3>
                            <p>${item.manifest_date} ${item.manifest_time || ''} - ${item.city_name || ''}</p>
                        </div>`;
                    var listItem = $('<div class="card-timeline">').html(text);
                    manifestTimeline.append(listItem);
                });

                $('.check-resi-' + transaction_id).show();
            }
        },
        error: function (xhr, status, error) {
            $('.loading-spinner-' + transaction_id).hide();
            console.error("AJAX Error:", error);
            console.error("Response Text:", xhr.responseText);
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

        element.addEventListener("click", function (e) {
            e.preventDefault();

            const modalEl = document.querySelector(this.getAttribute("data-bs-stacked-modal"));

            if (modalEl) {
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            }
        });
    });
}

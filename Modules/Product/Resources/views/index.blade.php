<x-base-layout>
    <x-slot name="styles">
        {{-- <link rel="stylesheet" href="{{ mix('css/custom.css') }}"> --}}
    </x-slot>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Product</h1>
    </x-slot>
    <x-slot name="button_create">
            <!--begin::Wrapper-->
            <div data-bs-toggle="tooltip" data-bs-placement="left" data-bs-trigger="hover" title="Import update from Excel" style="margin-right: 5px">
                <a data-bs-toggle="modal" data-bs-target="#kt_modal_1" href="{{ route('administrator.product.create', ['back' => request()->fullUrl()]) }}" class="btn btn-sm btn-secondary fw-bolder">
                    Update from Excel
                </a>
            </div>
            <!--end::Wrapper-->
        @can('administrator.product.create')
        <!--begin::Wrapper-->
            <div data-bs-toggle="tooltip" data-bs-placement="left" data-bs-trigger="hover" title="Create a new product">
                <a href="{{ route('administrator.product.create', ['back' => request()->fullUrl()]) }}" class="btn btn-sm btn-primary fw-bolder">
                    Create Product
                </a>
            </div>
        <!--end::Wrapper-->
        @endcan
    </x-slot>

        <!--begin::Card-->
        <div class="card">
            <!--begin::Card body-->
            <div class="card-body pt-6">
                {{-- <x-ladmin-datatables :fields="$fields" :options="$options" /> --}}
                {{ $dataTable->table() }}
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->

        <div class="modal fade" tabindex="-1" id="kt_modal_1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Import update product from Excel</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <!--begin::Form-->
                            <form class="form" action="#" method="post">
                                <!--begin::Input group-->
                                <div class="fv-row">
                                    <input type="hidden" name="data-raw" id="data-raw">
                                    <!--begin::Dropzone-->
                                    <div class="dropzone" id="kt_dropzonejs_example_1">
                                        <!--begin::Message-->
                                        <div class="dz-message needsclick">
                                            <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span class="path2"></span></i>

                                            <!--begin::Info-->
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                                    <!--end::Dropzone-->
                                </div>
                                <!--end::Input group-->
                            </form>
                            <!--end::Form-->

                            <div class="message">
                                <span class="response-message"></span>
                                <br>
                                <span class="article-number">
                                    <ul class="article-number-list"></ul>
                                </span>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="process-btn" disabled>Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Inject Scripts --}}
@push('scripts')
    {{ $dataTable->scripts() }}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.8/xlsx.full.min.js"></script>
    <script>
        var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
            url: "{{ route('administrator.product.uploadFromExcel') }}", // Set the url for your upload script location
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 1,
            maxFilesize: 1, // MB
            addRemoveLinks: true,
            autoProcessQueue: false,
            uploadMultiple: false,
            acceptedFiles: ".xls,.xlsx,.csv",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            parallelUploads: 1,
            // accept: function(file, done) {

            // }
            success: function (file, response) {
                $('#kt_modal_1').modal('toggle');
                $('.modal-backdrop').hide();
                $('#product-table').DataTable().ajax.reload();
                //is-validated & success insert

                if(response.code === 200) {

                    Swal.fire({
                        text: "Success updating product via excel!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            },
        });

        myDropzone.on("sending", function(file, xhr, formData) {
            var data = $(".form").serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
        });

        document.querySelector("#process-btn").addEventListener("click", function(e) {
            e.preventDefault();
            myDropzone.processQueue();
            //disable modal, spinner save button
        });

        myDropzone.on("removedfile", function(file){
            $('.response-message').empty();
            var ul = $('.article-number-list');
            ul.empty();
        })

        myDropzone.on("addedfile", function(file) {
            //validator excel
           // create a new file reader object
            var reader = new FileReader();

            // specify the function to run when the file has been read
            reader.onload = function(e) {
                // get the contents of the file
                var data = e.target.result;

                // use the xlsx library to parse the Excel file data
                var workbook = XLSX.read(data, { type: 'binary' });

                // get the first worksheet in the workbook
                var worksheet = workbook.Sheets[workbook.SheetNames[0]];

                // define an array to hold the data from the worksheet
                var dataArr = [];

                const json = XLSX.utils.sheet_to_json(worksheet);
                const rowCount = json.length;

                if (rowCount > 0) {
                    // if(worksheet["!range"].e.r < 2) {
                    //     console.log('Error read file : below 1 record data!.')
                    // }
                    // iterate over the rows in the worksheet
                    for (var rowNum = 1; rowNum <= rowCount; rowNum++) {
                        // access the cell values in the row
                        var articleNumber = worksheet[XLSX.utils.encode_cell({ r: rowNum, c: 0 })].v;
                        var namaProduk = worksheet[XLSX.utils.encode_cell({ r: rowNum, c: 1 })].v;
                        var ukuran = worksheet[XLSX.utils.encode_cell({ r: rowNum, c: 2 })].v;
                        var hargaAwal = worksheet[XLSX.utils.encode_cell({ r: rowNum, c: 3 })] != undefined ? worksheet[XLSX.utils.encode_cell({ r: rowNum, c: 3 })].v : 0;
                        var persentaseDiskon = worksheet[XLSX.utils.encode_cell({ r: rowNum, c: 4 })]  != undefined ? worksheet[XLSX.utils.encode_cell({ r: rowNum, c: 4 })].v : 0;
                        var hargaAkhir = worksheet[XLSX.utils.encode_cell({ r: rowNum, c: 5 })]  != undefined ? worksheet[XLSX.utils.encode_cell({ r: rowNum, c: 4 })].v : 0;
                        var stok = worksheet[XLSX.utils.encode_cell({ r: rowNum, c: 6 })]  != undefined ? worksheet[XLSX.utils.encode_cell({ r: rowNum, c: 4 })].v : 0;

                        // validate Harga awal, persentase diskon, harga akhir dan stok kalau tidak diisi auto dibikin 0

                        // create an object to represent the row data
                        var rowObj = {
                            "product_code": articleNumber,
                            "product_name": namaProduk,
                            "size": ukuran,
                            "base_price": hargaAwal ?? '0',
                            "discount_percentage": persentaseDiskon ?? '0',
                            "after_discount_price": hargaAkhir ?? '0',
                            "qty": stok ?? '0'
                        };
                        // add the row object to the data array
                        dataArr.push(rowObj);
                    }

                    if(dataArr.length === 0) {
                        console.log('No data recorded!');
                    } else {
                        // do something with the data array
                        // $('#data-raw').val(JSON.encode(response.data));
                        //validation article with ajax

                        $.ajax({
                            url: "{{ route('administrator.product.uploadExcelValidation') }}",
                            method: "POST",
                            data: { data: dataArr },
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                $('.response-message').text('');
                                // handle successful response
                                if(response.code === 200) {
                                    //if return true article number is exist
                                    //if errorBUcket is null return remove disabled button
                                    $('#data-raw').val(response.data);
                                    $('#process-btn').attr('disabled', false);
                                    $('.response-message').text(`The worksheet has ${rowCount} rows`);

                                } else {
                                    $('.response-message').text('there is article number that not exist, please consider to create product first.');
                                    $(file.previewElement).addClass("dz-error").find('.dz-error-message').text('article number not found');
                                    $(file.previewElement).find('.dz-progress').remove();

                                    var ul = $('.article-number-list');
                                    ul.empty();

                                    var errorData = JSON.parse(response.data);
                                    errorData.forEach(article => {
                                        var li = $('<li>').text(article);
                                        ul.append(li);
                                    });
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                // handle error response
                            }
                            });
                        //process-queue
                    }
                } else {
                    console.log('No data recorded!');
                    console.error("Worksheet is null or undefined, or does not have a defined range.");
                };
            }

            // read the file as binary data
            reader.readAsBinaryString(file);
        });
    </script>
@endpush

</x-base-layout>




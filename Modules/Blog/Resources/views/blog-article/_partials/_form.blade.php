<x-ladmin-form-group name="title" label="Title *">
	<input type="text" placeholder="Article Title" class="form-control" name="title" id="title" required value="{{ old('title', $blogArticle->title) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="slug" label="Slug">
	<input type="text" placeholder="Article Slug (auto-generated from title)" class="form-control" name="slug" id="slug" value="{{ old('slug', $blogArticle->slug) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="category_id" label="Category">
	<select class="form-control" name="category_id" id="category_id">
		<option value="">-- Select Category --</option>
		@foreach($categories as $category)
		<option value="{{ $category->id }}" {{ old('category_id', $blogArticle->category_id) == $category->id ? 'selected' : '' }}>
			{{ $category->name }}
		</option>
		@endforeach
	</select>
</x-ladmin-form-group>

<x-ladmin-form-group name="featured_image" label="Featured Image {{ $edit ? '' : '*' }}">
	@if($edit && $blogArticle->featured_image_url)
	<div class="mb-3">
		<img src="{{ $blogArticle->featured_image_url }}" alt="Featured Image" style="max-width: 300px; max-height: 200px; object-fit: cover;" class="img-thumbnail">
		<p class="text-muted mt-2">Current featured image</p>
	</div>
	@endif
	<input type="file" class="form-control" name="featured_image" id="featured_image" {{ $edit ? '' : 'required' }} accept="image/*">
	<p class="d-block mt-2">
		<span class="text-muted">Size: 1200x630px</span>
    </p>
</x-ladmin-form-group>

<input type="hidden" name="author" id="author" value="{{ old('author', $blogArticle->author ?? auth()->user()->name) }}">

<x-ladmin-form-group name="content" label="Content *">
	<textarea class="form-control" name="content" id="content" required>{{ old('content', $blogArticle->content) }}</textarea>
</x-ladmin-form-group>

<!--begin::Input group-->
<div class="d-flex flex-stack w-lg-50 mb-5">
    <!--begin::Label-->
    <div class="me-5">
        <label class="fs-6 fw-bold form-label">Show in Carousel?</label>
    </div>
    <!--end::Label-->

    <!--begin::Switch-->
    <label class="form-check form-switch form-check-custom form-check-solid fv-row">
        <input type="hidden" name="is_carousel" value="0"/>
        <input class="form-check-input" type="checkbox" name="is_carousel" value="1"
            {{ $edit ? (intval($blogArticle->is_carousel) ? 'checked' : '') : '' }} />
        <span class="form-check-label fw-bold text-muted">
            Active
        </span>
    </label>
    <!--end::Switch-->
</div>
<!--end::Input group-->

@include('back-office.components.is_active', ['is_active' => $blogArticle->is_active, 'edit' => $edit])

@push('styles')
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/summernote-bs5.min.css" integrity="sha512-rDHV59PgRefDUbMm2lSjvf0ZhXZy3wgROFyao0JxZPGho3oOuWejq/ELx0FOZJpgaE5QovVtRN65Y3rrb7JhdQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .note-editor {
        width: 100% !important;
    }
    .note-editable {
        width: 100% !important;
    }
    .note-dropdown-menu {
        z-index: 1050 !important;
    }
    .note-popover {
        z-index: 1050 !important;
    }
    /* Bootstrap table styles for Summernote editor */
    .note-editable table.table {
        border-collapse: collapse !important;
        width: 100%;
        margin-bottom: 1rem;
    }
    .note-editable table.table-bordered {
        border: 1px solid #dee2e6 !important;
    }
    .note-editable table.table-bordered th,
    .note-editable table.table-bordered td {
        border: 1px solid #dee2e6 !important;
        padding: 0.5rem !important;
    }
    .note-editable table.table th {
        border-top: 2px solid #dee2e6 !important;
    }
    /* Blockquote styles for Summernote editor */
    .note-editable blockquote {
        padding: 0.5rem 1rem !important;
        margin: 1rem 0 !important;
        border-left: 4px solid #dee2e6 !important;
        background-color: #f8f9fa !important;
        font-style: italic !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/summernote-bs5.min.js" integrity="sha512-qTQLA91yGDLA06GBOdbT7nsrQY8tN6pJqjT16iTuk08RWbfYmUz/pQD3Gly1syoINyCFNsJh7A91LtrLIwODnw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        // Initialize Summernote with full width and enhanced features
        $('#content').summernote({
            height: 500,
            width: '100%',
            dialogsInBody: true,
            dialogsFade: true,
            disableDragAndDrop: false,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear', 'fontsize', 'color']],
                ['para', ['ul', 'ol', 'paragraph', 'hr']],
                ['insert', ['link', 'picture', 'video', 'table']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            styleTags: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
            callbacks: {
                onImageUpload: function(files) {
                    // Upload image to server
                    var file = files[0];
                    var formData = new FormData();
                    formData.append('image', file);
                    
                    $.ajax({
                        url: '{{ route("administrator.blog.article.upload-image") }}',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.url) {
                                // Insert image into editor
                                $('#content').summernote('insertImage', response.url);
                            } else {
                                alert('Failed to upload image');
                            }
                        },
                        error: function(xhr) {
                            var errorMsg = 'Failed to upload image';
                            if (xhr.responseJSON && xhr.responseJSON.error) {
                                errorMsg = xhr.responseJSON.error;
                            }
                            alert(errorMsg);
                        }
                    });
                }
            },
            popover: {
                image: [
                    ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ],
                link: [
                    ['link', ['linkDialogShow', 'unlink']]
                ],
                table: [
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']]
                ],
                air: [
                    ['color', ['color']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']]
                ]
            }
        });

        // Auto-generate slug from title on blur
        $('#title').on('blur', function() {
            const title = $(this).val();
            if (title) {
                const slug = title.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                $('#slug').val(slug);
            }
        });

        // Form validation
        var validator = FormValidation.formValidation(
            $('#form')[0],
            {
                fields: {
                    'title': {
                        validators: {
                            notEmpty: {
                                message: 'Title is required'
                            }
                        }
                    },
                    'content': {
                        validators: {
                            callback: {
                                message: 'Content is required',
                                callback: function(value) {
                                    // Get content from Summernote
                                    const content = $('#content').summernote('code');
                                    if (content) {
                                        // Get plain text without HTML tags
                                        const text = $('<div>').html(content).text().trim();
                                        return text.length > 0;
                                    }
                                    return value && value.trim().length > 0;
                                }
                            }
                        }
                    },
                    @if(!$edit)
                    'featured_image': {
                        validators: {
                            notEmpty: {
                                message: 'Featured image is required'
                            }
                        }
                    },
                    @endif
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Submit button handler
        $('#form-submit').on('click', function(e) {
            e.preventDefault();

            // Sync Summernote content to textarea before validation
            $('#content').summernote('code', $('#content').summernote('code'));

            if (validator) {
                validator.validate().then(function(status) {
                    if (status == 'Valid') {
                        // Ensure Summernote content is synced before submit
                        const content = $('#content').summernote('code');
                        $('#content').val(content);

                        const $submitButton = $('#form-submit');
                        $submitButton.attr('data-kt-indicator', 'on');
                        $submitButton.prop('disabled', true);

                        setTimeout(function() {
                            $submitButton.removeAttr('data-kt-indicator');
                            $submitButton.prop('disabled', false);
                            $('#form').submit();
                        }, 2000);
                    }
                });
            }
        });
    });
</script>
@endpush


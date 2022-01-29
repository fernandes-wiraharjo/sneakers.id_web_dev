<div class="input-group control-group increment">
    <input type="file" name="filename[]" class="form-control">
    <div class="input-group-btn">
        <button class="btn btn-success image-add" type="button">
            <i class="fa fa-plus"></i>
        </button>
    </div>
    <div class="clone hide" style="display: none;">
        <div class="control-group input-group" style="margin-top: 10px">
            <input type="file" name="filename[]" class="form-control">
            <div class="input-group-btn">
                <button class="btn btn-danger image-remove" type="button">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".image-add").click(function(){
                var html = $(".clone").html();
                $(".increment").after(html);
            });
            $("body").on("click", ".image-remove", function(){
                $(this).parents(".control-group").remove();
            });
        });
    </script>
@endpush

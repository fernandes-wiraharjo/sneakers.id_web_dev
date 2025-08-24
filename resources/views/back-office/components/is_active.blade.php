{{-- <x-ladmin-form-group name="is_active" label="Active *"> --}}
    <!--begin::Input group-->
    <div class="d-flex flex-stack w-lg-50">
        <!--begin::Label-->
        <div class="me-5">
            <label class="fs-6 fw-bold form-label">Activate this data?</label>
        </div>
        <!--end::Label-->

        <!--begin::Switch-->
        <label class="form-check form-switch form-check-custom form-check-solid fv-row">
            <input type="hidden" name="is_active" value="0"/>
            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                {{ $edit ? (intval($is_active) ? 'checked' : '') : 'checked' }} />
            <span class="form-check-label fw-bold text-muted">
                Active
            </span>
        </label>
        <!--end::Switch-->
    </div>
    <!--end::Input group-->
{{-- </x-ladmin-form-group> --}}

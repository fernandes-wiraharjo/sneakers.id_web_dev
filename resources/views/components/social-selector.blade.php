<select class="form-select" name="social_icon" data-control="select2" data-placeholder="Select Icon">
    <option></option>
    <option value="discord" {{ ($selected ?? '') == 'discord' ? 'selected' : '' }}>Discord</option>
    <option value="google-plus" {{ ($selected ?? '') == 'google-plus' ? 'selected' : '' }}>Google Plus</option>
    <option value="pinterest" {{ ($selected ?? '') == 'pinterest' ? 'selected' : '' }}>Pinterest</option>
    <option value="snapchat" {{ ($selected ?? '') == 'snapgram' ? 'selected' : '' }}>Snapchat</option>
    <option value="telegram" {{ ($selected ?? '') == 'telegram' ? 'selected' : '' }}>Telegram</option>
    <option value="tiktok" {{ ($selected ?? '') == 'tiktok' ? 'selected' : '' }}>Tiktok</option>
    <option value="instagram" {{ ($selected ?? '') == 'instagram' ? 'selected' : '' }}>Instagram</option>
    <option value="facebook" {{ ($selected ?? '') == 'facebook' ? 'selected' : '' }}>Facebook</option>
    <option value="email" {{ ($selected ?? '') == 'email' ? 'selected' : '' }}>Email</option>
    <option value="line" {{ ($selected ?? '') == 'line' ? 'selected' : '' }}>Line</option>
    <option value="whatsapp" {{ ($selected ?? '') == 'whatsapp' ? 'selected' : '' }}>Whatsapp</option>
    <option value="youtube" {{ ($selected ?? '') == 'youtube' ? 'selected' : '' }}>Youtube</option>
</select>

@push('top-scripts')
<script src="{{asset('demo1/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
<script type="text/javascript">
    $(".form-select").select2();
 </script>
@endpush

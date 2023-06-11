<!--begin::Input group-->
<div style="padding: 10px 10px;">
    <!--begin::Label-->
    <label class="Heading u-h6">{{ __('First Name') }}</label>
    <!--end::Label-->

    <!--begin::Input-->
    <input type="text" placeholder="First Name" class="Form__Input" name="first_name" id="first_name" required value="{{ old('first_name', $user->first_name) }}">
    <!--end::Input-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div style="padding: 10px 10px;">
    <!--begin::Label-->
    <label class="Heading u-h6">{{ __('Last Name') }}</label>
    <!--end::Label-->

    <!--begin::Input-->
    <input type="text" placeholder="Last Name" class="Form__Input" name="last_name" id="last_name" required value="{{ old('last_name', $user->last_name) }}">
    <!--end::Input-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div style="padding: 10px 10px;">
    <!--begin::Label-->
    <label class="Heading u-h6">{{ __('Email') }}</label>
    <!--end::Label-->

    <!--begin::Input-->
    <input type="email" placeholder="E-mail Address" class="Form__Input" name="email" id="email" required value="{{ old('email', $user->email) }}">
    <!--end::Input-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div style="padding: 10px 10px;">
    <!--begin::Label-->
    <label class="Heading u-h6">{{ __('Password') }}</label>
    <!--end::Label-->

    <!--begin::Input-->
    <input type="password" placeholder="Password" class="Form__Input" name="password" id="password">
    <!--end::Input-->
</div>
<!--end::Input group-->





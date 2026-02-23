@php
    $tt = $transactionType;
@endphp

<x-ladmin-form-group name="code" label="Code *">
    <input type="text" class="form-control text-uppercase" name="code" id="code" required
        value="{{ old('code', $tt->code) }}" placeholder="e.g. WEB" maxlength="64"
        {{ $edit ? '' : 'autofocus' }}>
</x-ladmin-form-group>

<x-ladmin-form-group name="name" label="Name">
    <input type="text" class="form-control" name="name" id="name"
        value="{{ old('name', $tt->name) }}" placeholder="Display name (optional)">
</x-ladmin-form-group>

@include('back-office.components.is_active', ['is_active' => $tt->is_active, 'edit' => $edit])

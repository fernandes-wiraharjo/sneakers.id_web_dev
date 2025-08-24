<x-ladmin-form-group name="name" label="Full Name *">
  <x-slot name="prepend">
    {!! ladmin()->icon('user-circle') !!}
  </x-slot>

  <input type="text" placeholder="Full Name" class="form-control" name="name" id="name" required value="{{ old('name', $user->name) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="email" label="E-mail Address *">
  <x-slot name="prepend">
    {!! ladmin()->icon('at-symbol') !!}
  </x-slot>

  <input type="email" placeholder="E-mail Address" class="form-control" name="email" id="email" required value="{{ old('email', $user->email) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="pass" label="Password *">
  <x-slot name="prepend">
    {!! ladmin()->icon('lock-closed') !!}
  </x-slot>

  <input type="password" placeholder="Password" class="form-control" name="password" id="password">
</x-ladmin-form-group>

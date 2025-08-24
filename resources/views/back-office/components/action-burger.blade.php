<!--begin::Action--->
{{-- <td class="text-end"> --}}
    @if(isset($show))
        {{-- @can($show['gate']) --}}
            <a href="{{ $show['url'] }}" class="btn btn-icon btn-info btn-active-light-primary btn-sm">
                <i class="fas fa-eye"></i>
            </a>
        {{-- @endcan --}}
    @endif

    @if(isset($edit))
        @can($edit['gate'])
            <a href="{{ $edit['url'] }}" class="btn btn-icon btn-warning btn-active-light-primary btn-sm">
                <i class="fas fa-edit"></i>
            </a>
        @endcan
    @endif

    @if(isset($destroy))
        @can($destroy['gate'])
            <a href="{{ $destroy['url'] }}" class="btn btn-icon btn-danger btn-active-light-primary btn-sm"
                data-bs-toggle="modal" data-bs-target="#action-{{ Str::slug($destroy['url']) }}">
                <i class="fas fa-trash"></i>
            </a>

            <div class="modal fade" tabindex="-1" id="action-{{ Str::slug($destroy['url']) }}" tabindex="-1" role="dialog" aria-labelledby="action-{{ Str::slug($destroy['url']) }}Label" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <form action="{{ $destroy['url'] }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header border-0">
                                <h5 class="modal-title" id="action-{{ Str::slug($destroy['url']) }}Label">Delete!</h5>
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <span class="svg-icon svg-icon-2x"></span>
                                </div>
                                <!--end::Close-->
                            </div>

                            <div class="modal-body">
                                @if (isset($destroy['tag']))
                                    @if($destroy['tag']['best_seller'] && $destroy['tag']['new_release'])
                                        Do you really want to delete this
                                        <span class="badge badge-info">{{ $destroy['tag']['best_seller'] }}</span> and
                                        <span class="badge badge-info">{{ $destroy['tag']['new_release'] }}</span>
                                        {{ isset($destroy['type']) ? $destroy['type'] : 'item'}}?
                                    @elseif($destroy['tag']['best_seller'] && !$destroy['tag']['new_release'])
                                        Do you really want to delete this
                                        <span class="badge badge-info">{{ $destroy['tag']['best_seller'] }}</span>
                                        {{ isset($destroy['type']) ? $destroy['type'] : 'item'}}?
                                    @elseif(!$destroy['tag']['best_seller'] && $destroy['tag']['new_release'])
                                        Do you really want to delete this
                                        <span class="badge badge-info">{{ $destroy['tag']['new_release'] }}</span>
                                        {{ isset($destroy['type']) ? $destroy['type'] : 'item'}}?
                                    @endif
                                @else
                                    @if (isset($destroy['type']))
                                        @if ($destroy['type'] == 'restrict')
                                            Data cannot be deleted, this data attached to other data!
                                        @endif
                                    @else
                                        Do you really want to delete this item?
                                    @endif
                                @endif
                            </div>

                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger" {{ (isset($destroy['type']) ? $destroy['type'] : '') == 'restrict' ? 'disabled' : ''}}>Yes, Do it!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan
    @endif
    <!--end::Menu-->
{{-- </td> --}}
<!--end::Action--->

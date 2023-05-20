<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
	<!--begin::Heading-->
    <div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('{{ asset(theme()->getMediaUrlPath() . 'misc/pattern-1.jpg') }}')">
        <!--begin::Title-->
        <h3 class="text-white fw-bold px-9 mt-10 mb-6">
            Notifications <span class="fs-8 opacity-75 ps-3">24 reports</span>
        </h3>
        <!--end::Title-->
    </div>
	<!--end::Heading-->
    <!--begin::Wrapper-->
    <div class="d-flex flex-column px-9">
        <div>
            <div class="scroll-y mh-325px my-5 px-8">
                <!--begin::Item-->
                <div class="d-flex flex-stack py-4">
                    <!--begin::Section-->
                    <div class="w-100 align-items-center me-2">
                        <!--begin::Title-->
                        <a href="javascript:document.getElementById('notification-all-read').submit();" class="text-gray-800 text-hover-primary fw-bold">
                            <div class="text-center">
                                <p>Mark all as read?</p>
                            </div>
                        </a>
                        <!--end::Title-->
                    </div>
                    <!--end::Section-->
                </div>
            @forelse (Auth::user()->unreadNotifications()->take(10)->get() as $item)
                <a href="{{ route('ladmin.notification.show', $item->id) }}" target="_blank"
                    class="d-flex flex-stack py-4"
                    aria-current="true">
                    @if (isset($item->data['image_link']))
                        <div>
                            <img src="{{ $item->data['image_link'] }}" class="me-2" alt="Notification image"
                                width="50">
                        </div>
                    @endif
                    <div class="flex-grow-1">
                        <div class="d-flex w-100 justify-content-between">
                            <strong class="mb-1">{{ $item->data['title'] ?? 'Title Not Found' }}</strong>
                            <small>{{ $item->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1">{{ Str::limit($item->data['description'], 50) }}</p>
                    </div>
                </a>
            @empty
                <!--begin::Item-->
                <div class="d-flex flex-stack py-4">
                    <!--begin::Section-->
                    <div class="w-100 align-items-center me-2">
                        <!--begin::Title-->
                        <a href="#" class="text-gray-800 text-hover-primary fw-bold">
                            <div class="text-center">
                                <i class="fa-solid fa-bell-slash fa fa-3x mb-3 text-muted"></i>
                                <p>You have no new notifications</p>
                            </div>
                        </a>
                        <!--end::Title-->
                    </div>
                    <!--end::Section-->
                </div>
            @endforelse
            </div>
            <!--begin::View more-->
            <div class="py-3 text-center border-top">
                <a href="{{ route('administrator.notification.index') }}" class="btn btn-color-gray-600 btn-active-color-primary">
                    View All
                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr064.svg", "svg-icon-5") !!}
                </a>
            </div>
            <!--end::View more-->
        </div>

    </div>
    <!--end::Wrapper-->
</div>

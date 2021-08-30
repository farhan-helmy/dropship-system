@extends('master')

@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Profile 4-->
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end">
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-hor"></i>
                                </a>

                            </div>
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::User-->
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                <div class="symbol-label" style="background-image:url('assets/media/users/300_13.jpg')">
                                </div>
                                <i class="symbol-badge bg-success"></i>
                            </div>
                            <div>
                                <a href="#"
                                    class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{$user->name}}</a>

                                <div class="mt-2">
                                    <span
                                        class="label label-lg label-light-success label-inline font-weight-bold py-4">{{$user->status}}</span>
                                </div>
                            </div>
                        </div>
                        <!--end::User-->
                        <!--begin::Contact-->
                        <div class="pt-8 pb-6">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Email:</span>
                                <a href="#" class="text-muted text-hover-primary">{{$user->email}}</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Phone:</span>
                                <span class="text-muted">{{$user->phone_no}}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Location:</span>
                                <span class="text-muted">Malaysia</span>
                            </div>
                        </div>
                        <!--end::Contact-->
                        @if($user->status == 'Active')
                        <a href="{{route('admin.dropshipper.deactivate', ['user' => $user->id])}}"
                            class="btn btn-light-danger font-weight-bold py-3 px-6 mb-2 text-center btn-block">Deactivate</a>
                        @else
                        <a href="{{route('admin.dropshipper.activate', ['user' => $user->id])}}"
                            class="btn btn-light-success font-weight-bold py-3 px-6 mb-2 text-center btn-block">Activate</a>
                        @endif
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
              
            </div>
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
                <div class="card card-custom gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Orders</span>

                        </h3>

                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0 pb-3">
                       
                        {!! $ordertable->table() !!}
                       
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Profile 4-->
    </div>
    <!--end::Container-->
</div>
@endsection

@push('scripts')
{!! $ordertable->scripts() !!}

@endpush

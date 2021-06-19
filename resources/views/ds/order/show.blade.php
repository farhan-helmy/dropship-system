@extends('master')

@section('content')

<div class="container">
    <div class="card card-custom card-shadowless rounded-top-0">
        <div class="card-body p-0">
            <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                <div class="col-xl-12 col-xxl-7">
                    <!--begin: Wizard Form-->
                    <form class="form mt-0 mt-lg-10 fv-plugins-bootstrap fv-plugins-framework" id="kt_form">
                        <!--begin: Wizard Step 3-->
                        <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                            <!--begin::Section-->
                            <h4 class="mb-10 font-weight-bold text-dark">Order # {{$order->id}}</h4>
                            <h6 class="font-weight-bolder mb-3">Delivery Address:</h6>
                            <div class="text-dark-50 line-height-lg">
                                <div>{{$order->address1}}</div>
                                <div>{{$order->address2}}</div>
                                <div>{{$order->negeri}} {{$order->postcode}}, {{$order->negara}}</div>
                            </div>
                            <div class="separator separator-dashed my-5"></div>
                            <!--end::Section-->
                            <!--begin::Section-->
                            <h6 class="font-weight-bolder mb-3">Order Details:</h6>
                            <div class="text-dark-50 line-height-lg">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="pl-0 font-weight-bold text-muted text-uppercase">Ordered
                                                    Items</th>
                                                <th class="text-right font-weight-bold text-muted text-uppercase">Qty
                                                </th>
                                                <th class="text-right font-weight-bold text-muted text-uppercase">Unit
                                                    Price</th>
                                                <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">
                                                    Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $order->products as $product )
                                            <tr class="font-weight-boldest">
                                                <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                                        <div class="symbol-label"
                                                            style="background-image: url('{{$product->getFirstMediaUrl()}}')">
                                                        </div>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    {{$product->name}}
                                                </td>
                                                <td class="text-right pt-7 align-middle">{{$product->pivot->quantity}}
                                                </td>
                                                <td class="text-right pt-7 align-middle">RM {{$product->price}}</td>
                                                <td class="text-primary pr-0 pt-7 text-right align-middle">RM
                                                    {{$product->pivot->total_price}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="border-0 pt-0"></td>
                                                <td class="border-0 pt-0 font-weight-bolder font-size-h5 text-right">
                                                    Grand Total</td>
                                                <td
                                                    class="border-0 pt-0 font-weight-bolder font-size-h5 text-success text-right pr-0">
                                                    RM {{$go}}</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-5"></div>
                            <!--end::Section-->
                            <!--begin::Section-->
                            <h6 class="font-weight-bolder mb-5">Status:</h6>
                            <a class="alert alert-success">
                                    {{$order->status}}
                            </a>
                            <div class="separator separator-dashed my-5"></div>
                            <!--end::Section-->
                            <!--begin::Section-->
                            <h6 class="font-weight-bolder mb-5">Tracking number:</h6>
                            <a class="alert alert-warning">
                                    {{$order->tracking_num}}
                            </a>
                            <!--end::Section-->
                            <div class="separator separator-dashed my-5"></div>
                            <!--end::Section-->
                            <!--begin::Section-->
                            <h6 class="font-weight-bolder mb-3">Receipt uploaded:</h6>
                            <div class="text-dark-50 line-height-lg">
                                <!-- Button trigger modal-->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                    See receipt
                                </button>

                                <!-- Modal-->
                                <div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1"
                                    role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <img src="{{ $order->getFirstMediaUrl() }}" alt=""
                                                    style="width: 500px; height: 500px;">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-primary font-weight-bold"
                                                    data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end: Wizard Step 3-->
                        <!--begin: Wizard Actions-->
                        <div class="d-flex justify-content-between border-top mt-5 pt-10">
                            <div class="mr-2">
                                <a href="{{route('ds.order.index')}}"
                                    class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4">Back</a>
                            </div>
                            <div>
                            </div>
                        </div>
                        <!--end: Wizard Actions-->
                        <div></div>
                        <div></div>
                    </form>
                    <!--end: Wizard Form-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

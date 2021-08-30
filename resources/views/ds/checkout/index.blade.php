@extends('master')


@section('content')

    <div class="container">
        <div class="flex-row-fluid ml-lg-8">
            <!--begin::Section-->
            <div class="card card-custom card-transparent">
                <div class="card-body p-0">
                    <!--begin: Wizard-->

                    <!--begin: Wizard Nav-->

                    <!--end: Wizard Nav-->
                    <!--begin: Wizard Body-->
                    <div class="card card-custom card-shadowless rounded-top-0">
                        <div class="card-body p-0">
                            @if ($errors->any())
                                <div class="d-flex flex-column-fluid flex-center alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                <div class="col-xl-12 col-xxl-7">
                                    <!--begin: Wizard Form-->
                                    <form class="form mt-0 mt-lg-10 fv-plugins-bootstrap fv-plugins-framework" id="kt_form"
                                        action="{{ route('ds.checkout.store') }}" enctype="multipart/form-data"
                                        method="POST">
                                        @method('POST')
                                        @csrf
                                        <!--begin: Wizard Step 1-->
                                        <!--begin: Wizard Step 2-->
                                        <div class="pb-5" data-wizard-type="step-content">
                                            <h4 class="mb-10 font-weight-bold text-dark">Customer details</h4>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <!--begin::Input-->
                                                    <div class="form-group fv-plugins-icon-container has-success">
                                                        <label>Name</label>
                                                        <input type="text"
                                                            class="form-control form-control-solid form-control-lg"
                                                            name="name" placeholder="Customer Name" value="{{ old('name') }}">
                                                        <span class="form-text text-muted">Please enter customers.</span>
                                                        <div class="fv-plugins-message-container"></div>
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-6">
                                                    <!--begin::Input-->
                                                    <div class="form-group fv-plugins-icon-container has-success">
                                                        <label>Phone Number</label>
                                                        <input type="text"
                                                            class="form-control form-control-solid form-control-lg"
                                                            name="phoneno" placeholder="xxx-xxx xxxx" value="{{ old('phoneno') }}">
                                                        <span class="form-text text-muted">Please enter customer phone
                                                            number.</span>
                                                        <div class="fv-plugins-message-container"></div>
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--end: Wizard Step 2-->
                                        <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                            <h4 class="mb-10 font-weight-bold text-dark">Enter Customer Address</h4>
                                            <!--begin::Input-->
                                            <div class="form-group fv-plugins-icon-container has-success">
                                                <label>Address Line 1</label>
                                                <input type="text" class="form-control form-control-solid form-control-lg"
                                                    name="address1" placeholder="Address Line 1" value="{{ old('address1') }}">
                                                <span class="form-text text-muted">Please enter your Address.</span>
                                                <div class="fv-plugins-message-container"></div>
                                            </div>
                                            <!--end::Input-->
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Address Line 2</label>
                                                <input type="text" class="form-control form-control-solid form-control-lg"
                                                    name="address2" placeholder="Address Line 2" value="{{ old('address2') }}">
                                                <span class="form-text text-muted">Please enter your Address.</span>
                                            </div>
                                            <!--end::Input-->
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <!--begin::Input-->
                                                    <div class="form-group fv-plugins-icon-container has-success">
                                                        <label>Postcode</label>
                                                        <input type="text"
                                                            class="form-control form-control-solid form-control-lg"
                                                            name="postcode" placeholder="Postcode"
                                                            value="{{ old('postcode') }}">
                                                        <span class="form-text text-muted">Please enter your
                                                            Postcode.</span>
                                                        <div class="fv-plugins-message-container"></div>
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-6">
                                                    <!--begin::Input-->
                                                    <div class="form-group fv-plugins-icon-container has-success">
                                                        <label>City</label>
                                                        <input type="text"
                                                            class="form-control form-control-solid form-control-lg"
                                                            name="bandar" placeholder="Bandar" value="{{ old('bandar') }}">
                                                        <span class="form-text text-muted">Please enter your
                                                            City.</span>
                                                        <div class="fv-plugins-message-container"></div>
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <!--begin::Input-->
                                                    <div class="form-group fv-plugins-icon-container has-success">
                                                        <label>State</label>
                                                        <input type="text"
                                                            class="form-control form-control-solid form-control-lg"
                                                            name="negeri" placeholder="Negeri" value="{{ old('negeri') }}">
                                                        <span class="form-text text-muted">Please enter your
                                                            State.</span>
                                                        <div class="fv-plugins-message-container"></div>
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-6">
                                                    <!--begin::Select-->
                                                    <div class="form-group fv-plugins-icon-container has-success">
                                                        <label>Country</label>
                                                        <select name="negara"
                                                            class="form-control form-control-solid form-control-lg">
                                                            <option value="MY" selected="selected">Malaysia</option>
                                                        </select>
                                                        <div class="fv-plugins-message-container"></div>
                                                    </div>
                                                    <!--end::Select-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--end: Wizard Step 1-->
                                        <div class="pb-5" data-wizard-type="step-content">
                                            <h4 class="mb-10 font-weight-bold text-dark">Upload receipt</h4>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <!--begin::Input-->
                                                    <div class="form-group fv-plugins-icon-container has-success">
                                                        <label>Receipt</label>
                                                        <input type="file" class="custom-file-input" id="customFile"
                                                            name="receipt" />
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            file</label>
                                                        <div class="fv-plugins-message-container"></div>
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                            </div>

                                        </div>
                                        <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                            <!--begin::Section-->
                                            <h4 class="mb-10 font-weight-bold text-dark">Review your Order</h4>
                                            <!--end::Section-->
                                            <!--begin::Section-->
                                            <h6 class="font-weight-bolder mb-3">Order Details:</h6>
                                            <div class="text-dark-50 line-height-lg">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th class="pl-0 font-weight-bold text-muted text-uppercase">
                                                                    Ordered Items</th>
                                                                <th
                                                                    class="text-right font-weight-bold text-muted text-uppercase">
                                                                    Qty</th>

                                                                <th
                                                                    class="text-right pr-0 font-weight-bold text-muted text-uppercase">
                                                                    Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($products as $product)
                                                                <tr class="font-weight-boldest">
                                                                    <td class="border-0 pl-0 pt-7 align-items-center">
                                                                        <!--begin::Symbol-->
                                                                        <div
                                                                            class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">

                                                                        </div>
                                                                        <!--end::Symbol-->
                                                                        {{ $product['item']['name'] }}
                                                                    </td>
                                                                    <td class="text-right pt-7 align-middle">
                                                                        {{ $product['qty'] }}</td>

                                                                    <td
                                                                        class="text-primary pr-0 pt-7 text-right align-middle">
                                                                        RM{{ $product['price'] }}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="1" class="border-0 pt-0"></td>
                                                                <td
                                                                    class="border-0 pt-0 font-weight-bolder font-size-h5 text-right">
                                                                    Grand Total</td>
                                                                <td
                                                                    class="border-0 pt-0 font-weight-bolder font-size-h5 text-success text-right pr-0">
                                                                    RM {{ $total ?? '' }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                        <!--begin: Wizard Actions-->
                                        <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                            <div class="mr-2">
                                                <a href="{{ route('ds.cart.index') }}"
                                                    class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4">Previous</a>
                                            </div>
                                            <div>

                                                <button type="submit"
                                                    class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4">Submit</button>
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
                    <!--end: Wizard Bpdy-->

                    <!--end: Wizard-->
                </div>
            </div>
            <!--end::Section-->
        </div>
    </div>
@endsection

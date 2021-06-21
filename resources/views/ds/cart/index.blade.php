@extends('master')

@section('content')

<div class="container">
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder font-size-h3 text-dark">My Shopping Cart</span>
            </h3>
            <div class="card-toolbar">
                <div class="dropdown dropdown-inline">
                    <a href="{{ route('ds.product.index') }}"
                        class="btn btn-primary font-weight-bolder font-size-sm">Continue Shopping</a>
                </div>
            </div>
        </div>
        <!--end::Header-->
        <div class="card-body">
            <!--begin::Shopping Cart-->
            @if(Session::has('cart'))
            <div class="table-responsive">
                <table class="table">
                    <!--begin::Cart Header-->
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Qty</th>
                            <th class="text-right">Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <!--end::Cart Header-->
                    <tbody>
                        <!--begin::Cart Content-->
                        @foreach($products as $product)
                        <tr>
                            <td class="d-flex align-items-center font-weight-bolder">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-60 flex-shrink-0 mr-4 bg-light">
                                    <div class="symbol-label"
                                        style="background-image: url('/metronic/theme/html/demo1/dist/assets/media/products/11.png')">
                                    </div>
                                </div>
                                <!--end::Symbol-->
                                <a href="#" class="text-dark text-hover-primary">{{ $product['item']['name'] }}</a>
                            </td>
                            <td class="text-center align-middle">
                              
                                <span class="mr-2 font-weight-bolder">{{ $product['qty'] }}</span>
                              
                            </td>
                            <td class="text-right align-middle font-weight-bolder font-size-h5">
                                RM{{ $product['price'] }}</td>
                            <td class="text-right align-middle">
                                <a href="{{ route('ds.cart.removeItem', ['id' => $product['item']['id']]) }}"
                                    class="btn btn-danger font-weight-bolder font-size-sm">Remove</a>
                            </td>
                            @endforeach
                        </tr>

                        <!--end::Cart Content-->
                        <!--begin::Cart Footer-->
                        <tr>
                            <td colspan="2"></td>
                            <td class="font-weight-bolder font-size-h4 text-right">Subtotal</td>
                            <td class="font-weight-bolder font-size-h4 text-right">RM {{$total ?? ''}}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="border-0 text-muted text-right pt-0">Excludes Delivery. GST Included
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border-0 pt-10">
                                <form>
    
                                </form>
                            </td>
                            <td colspan="2" class="border-0 text-right pt-10">
                                <a href="{{ route('ds.checkout.index') }}"
                                    class="btn btn-success font-weight-bolder px-8">Proceed to Checkout</a>
                            </td>
                        </tr>
                        <!--end::Cart Footer-->
                    </tbody>
                </table>
            </div>
            @else
            <h1>Such empty cart, please purchase something</h1>
            @endif
            <!--end::Shopping Cart-->
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>

</script>
@endpush

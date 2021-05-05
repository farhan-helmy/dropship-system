@extends('master')

@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom gutter-b">
            <!--begin::Card Body-->
            <div class="card-body d-flex rounded bg-danger p-12 flex-column flex-md-row flex-lg-column">
                <!--begin::Card-->
                <div class="card card-custom w-auto w-lg-auto w-xxl-300px">
                    <!--begin::Card Body-->
                    <div class="card-body px-12 py-10">
                        <h3 class="font-weight-bolder font-size-h2 mb-1">
                            <a href="#" class="text-dark-75">{{$product->name}}</a>
                        </h3>
                        <div class="text-primary font-size-h4 mb-9">MYR {{$product->price}}</div>
                        <div class="font-size-sm mb-8">{{$product->description}}</div>
                        <!--begin::Info-->
                        <div class="d-flex mb-3">
                            <span class="text-dark-50 flex-root font-weight-bold">Stock Left</span>
                            <span class="text-dark flex-root font-weight-bold">{{$product->stock}}</span>
                        </div>

                        <!--end::Info-->
                    </div>
                    <!--end::Card Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Card Body-->
        </div>
    </div>
</div>
@endsection
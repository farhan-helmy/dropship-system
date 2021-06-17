@extends('master')

@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container">
        @if ($errors->any())
        <div class="card card-custom">
            <ul>
                @foreach ($errors->all() as $error)
                <div class="alert alert-custom alert-notice alert-light-danger fade show" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                    <div class="alert-text">{{ $error }}</div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                        </button>
                    </div>
                </div>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Register new dropshipper
                </h3>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                    </div>
                </div>
                <div class="card-toolbar">
                    <a href="{{route('admin.dropshipper.index')}}" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                    <path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) " />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Go back</a>
                </div>
            </div>


            <!--begin::Form-->
            <form action="{{ route('ds.dashboard.update', ['user' => $user->id]) }}" method="POST"> 
                @method('PUT')
                @csrf
                <div class="card-body">
                    <!-- <div class="form-group mb-8">
                        <div class="alert alert-custom alert-default" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
                            <div class="alert-text">
                                The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter user name" name="name" value="{{$user->name}}" />
                    </div>
                    <div class="form-group">
                        <label>Email address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{$user->email}}" />
                        <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                    </div>
                    <div class="form-group">
                        <label>Phone number <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" placeholder="Enter phone no" name="phone_no" value="{{$user->phone_no}}" />
                    </div>
                    <div class="form-group">
                        <label>Nric <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" placeholder="Enter phone no" name="nric" value="{{$user->nric}}" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" value="{{$user->password}}" />
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </div>

            </form>

            <!--end::Form-->
        </div>

    </div>
</div>
@endsection
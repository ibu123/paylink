@extends('layouts.horizontal')
@section('title')
تسجيل الدخول 
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="row header-container justify-content-center">

                    <div class="col-md-8 col-11 row align-items-center">

                        <div class="col-md-3 col-3 text-left">
                            <img src="{{ asset('images/logo/header-logo.png')}}"  alt="">
                        </div>
                        <div class="col-md-6 col-9 text-center brando__bold px__470">
                           <h1> تسجيل الدخول </h1>
                        </div>

                    </div>
            </div>
            <div class="content-body">
                <!-- register section starts -->
                <section class="row justify-content-center">
                    <div class="col-md-5 col-11 px__500">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- register section left -->
                                <div class="col-md-12 col-12 px-0">
                                    {{-- <div class="mb-0 h-100 d-flex justify-content-center"> --}}


                                        <div class="card-content">
                                            <div class="card-body">
                                                @livewire('alert-component')
                                                @livewire('auth-component')
                                              </div>
                                        </div>
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>




                        <div class="my-5 text-center">
                            <img src="{{ asset('images/logo/footer-logo-3x.png')}}" width="50px" alt="">
                        </div>
                    </div>
                </section>
                <!-- register section endss -->
            </div>
        </div>
    </div>

@endsection
@section('js')
<script>

</script>
@endsection

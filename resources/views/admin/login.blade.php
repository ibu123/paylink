@extends('layouts.horizontal')
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
                        <div class="col-md-6 col-9 text-center brando__bold">
                           <h1> تسجيل الدخول </h1>
                        </div>

                    </div>
            </div>
            <div class="content-body">
                <!-- register section starts -->
                <section class="row justify-content-center">
                    <div class="col-md-5 col-11">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- register section left -->
                                <div class="col-md-12 col-12 px-0">
                                    <div class="card mb-0  h-100 d-flex justify-content-center">


                                        <div class="card-content">
                                            <div class="card-body">
                                                @livewire('alert-component')
                                                <form method="POST" action="{{ route('send-otp') }}" class="register-form common__form">
                                                    @csrf
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12 mb-50">
                                                                <p>  يرجى إدخال رقم الهاتف ثم ضغط زر التوثيق </p>

                                                            <label for="phone_no" class="brando__semi__bold">رقم الهاتف</label>
                                                            <div class="pos__relative">
                                                                <input type="text" class="form-control" name="phone_no" id="phone_no" >
                                                                <span class="icon-in-control brando__bold">توثيق</span>
                                                                @error('phone_no')
                                                                    <span class="text text-danger">{{ $message }}<span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-center my-2">
                                                        <button type="submit" class="btn btn-primary glow position-relative ">تسجيل الدخول</button>

                                                    </div>
                                                  </form>
                                              </div>
                                        </div>
                                    </div>
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
    <!-- END: Content-->
</body>
<!-- END: Body-->

</html>
@endsection

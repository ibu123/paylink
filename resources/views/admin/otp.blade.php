@extends('layouts.horizontal')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="row header-container justify-content-center">

                    <div class="col-md-8 col-10 row align-items-center">

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
                    <div class="col-md-5 col-10">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- register section left -->
                                <div class="col-md-12 col-12 px-0">
                                    <div class="card mb-0 p-2 h-100 d-flex justify-content-center">


                                        <div class="card-content">
                                            <div class="card-body">
                                                @livewire('alert-component')
                                                <form method="POST" action="{{ route('verify-otp') }}" class="register-form common__form">
                                                    @csrf
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12 mb-50">
                                                            <p  >ستصلك رسالة SMS، الرجاء إدخال رمز التوثيق أدناه</p>

                                                            <label class="brando__semi__bold"> رمز التوثيق</label>
                                                            <div class="pos__relative">
                                                                <input type="text" class="form-control" maxlength="4" name="otp" oninput="javascript: this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  >
                                                                <span class="icon-in-control brando__bold">إعادة طلب الرمز</span>
                                                                @error('otp')
                                                                    <span class="text-danger error">{{ $message }} </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if($stores->isNotEmpty())
                                                    <p class="text-center">
                                                        هنالك أكثر من حساب مرتبط بهذا الرقم
                                                    </p>
                                                    <p class="text-center">
                                                        الرجاء تحديد الحساب الذي تود تسجيل الدخول له
                                                    </p>
                                                    @endif

                                                        <div class="row justify-content-center">
                                                            <div class="col-sm-5 col-md-6 col-12">
                                                                @foreach($stores as $store)
                                                                    <div class="form-row ">
                                                                        <div class="form-group m-0">
                                                                            <input type="radio" name="store" id="{{$store->id}}__store" class="radio__btn ">
                                                                            <label for="{{$store->id}}__store" class="radio__checked my-0 brando-extra-light">{{ $store->store_display_name}}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                                @error('store')
                                                                    <span class="text-danger error">{{ $message }} </span>
                                                                @enderror
                                                            </div>

                                                        </div>

                                                        <div class="text-center my-2 pos__relative">
                                                            <span class="time icon-in-control-without-abs brando__bold" id="time__cnt">
                                                                إعادة إرسال OTP بعد <span id="counter"></span>
                                                            </span>
                                                        </div>
                                                        <div class="text-center re-send-otp d-none">
                                                            <a href="{{ route('re-send-otp') }}" class="time icon-in-control-without-abs brando__bold">
                                                                إعادة إرسال OTP
                                                            </a>
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
@endsection
@section('js')
<script>
    function countdown() {
        var seconds = 61;
        function tick() {
          var counter = document.getElementById("counter");
          seconds--;
          counter.innerHTML =
            "0:" + (seconds < 10 ? "0" : "") + String(seconds);
          if (seconds > 0) {
            setTimeout(tick, 1000);
          } else {
            $("#time__cnt").addClass("d-none");
            $(".re-send-otp").removeClass("d-none");
            document.getElementById("counter").innerHTML = "";
          }
        }
        tick();
    }

    $(document).ready(function(){
        countdown();
    })
</script>
@endsection

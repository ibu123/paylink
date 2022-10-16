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
                                                <form class="register-form common__form">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12 mb-50">
                                                                <p class="jali__semi__bold">  يرجى إدخال رقم الهاتف ثم ضغط زر التوثيق </p>

                                                            <label for="inputfirstname4" class="brando__semi__bold">رقم الهاتف</label>
                                                            <div class="pos__relative">
                                                                <input type="text" class="form-control" id="inputfirstname4" >
                                                                <span class="icon-in-control jali__extra__bold">توثيق</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12 mb-50">
                                                            <p  for="exampleInputUsername1" class="jali__semi__bold">ستصلك رسالة SMS، الرجاء إدخال رمز التوثيق أدناه</p>

                                                            <label for="exampleInputUsername1" class="brando__semi__bold"> رمز التوثيق</label>
                                                            <div class="pos__relative">
                                                                <input type="text" class="form-control" id="exampleInputUsername1" >
                                                                <span class="icon-in-control jali__extra__bold">إعادة طلب الرمز</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="jali__semi__bold text-center">
                                                        هنالك أكثر من حساب مرتبط بهذا الرقم
                                                     </p>

                                                    <p class="jali__semi__bold text-center">
                                                        الرجاء تحديد الحساب الذي تود تسجيل الدخول له
                                                    </p>
                                                    <div class="row justify-content-center">
                                                        <div class="col-sm-5 col-md-5 col-7 col-sm-4">
                                                            <div class="form-row ">
                                                                <div class="form-group m-0">
                                                                    <input type="radio" name="abc" id="yes" class="radio__btn ">
                                                                    <label for="yes" class="radio__checked my-0 brando-extra-light">فندق كيتزال - فرع العليا</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-row ">
                                                                <div class="form-group m-0">
                                                                    <input type="radio" name="abc" id="yes2" class="radio__btn ">
                                                                    <label for="yes2" class="radio__checked my-0  brando-extra-light">فندق كيتزال - فرع النزهة</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-row ">
                                                                <div class="form-group m-0">
                                                                    <input type="radio" name="abc" id="yes3" class="radio__btn ">
                                                                    <label for="yes3" class="radio__checked my-0 brando-extra-light">سلسلة فنادق كيتزال - الإدارة العامة</label>
                                                                </div>
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

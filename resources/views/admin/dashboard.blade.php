@extends('layouts.horizontal')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tables/datatable/datatables.min.css') }}">
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper container">
                <div class="d-flex header-container justify-content-center align-items-center grid__header col-md-12 col-12">
                            <div class="col-md-4 text-left">
                                <img src="{{ asset('images/logo/header-logo.png')}}"  alt="">
                            </div>
                            <div class="col-md-4  text-center brando__bold">
                            <h1> المارينفورد</h1>
                            </div>
                            <div class="col-md-4 text-center brando__bold">
                                <h3 class="brando-extra-light"> تسجيل الخروج </h3>
                            </div>
                </div>
            <div class="content-body">
                <!-- register section starts -->
                <section class="row justify-content-center">
                    <div class="col-md-12 col-11">
                        <div class="card data__table__grid mb-0">
                            <div class="row m-0">
                                <!-- register section left -->
                                <div class="col-md-12 col-12 px-0">
                                    <div class="card mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-md-2 ">
                                                        <h4 class="brando__black">قائمة التجار</h4>
                                                    </div>
                                                    <div class="col-md-8 text-right grid__4">
                                                        <span class="filters">
                                                                    <img src="{{ asset('images/icon/experiment_1x.png') }}" alt="">
                                                            فلترة
                                                        </span>
                                                        <span class="filters">
                                                        <img src="{{ asset('images/icon/clockwise_1x.png') }}" alt="">
                                                        تحديث</span>
                                                        <span class="filters">
                                                            <img src="{{ asset('images/icon/export copy_1x.png') }}" alt="">
                                                        تصدير</span>
                                                        <span class="filters">
                                                            <img src="{{ asset('images/icon/card_1x.png') }}" alt="">
                                                         مخالصة</span>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" class="btn btn-primary glow position-relative ">تسجيل الدخول</button>

                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table zero-configuration">
                                                        <thead>
                                                            <tr>
                                                                <th><div>الرقم</div></th>
                                                                <th>الاسم</th>
                                                                <th>الهاتف</th>
                                                                <th>عدد الروابط</th>
                                                                <th>الإيرادات</th>
                                                                <th>صافي الأرباح</th>
                                                                <th>الإجراءات</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>18</td>
                                                                <td class="small__fonts brando__regular">كيتزال..</td>
                                                                <td class="small__fonts jali__regular">0547..</td>
                                                                <td >115</td>
                                                                <td>26.3k <span>
                                                                    ريال
                                                                </span></td>
                                                                <td>26.3k <span>
                                                                    ريال
                                                                </span></td>
                                                                <td>
                                                                    <span class="badge">
                                                                    <img src="{{ asset('images/icon/preview.png')}}" alt="">عرض </span>
                                                                    <span class="badge">
                                                                        <img src="{{ asset('images/icon/duplicate.png')}}" alt=""> تحكم</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>17</td>
                                                                <td class="small__fonts brando__regular">فور سي..</td>
                                                                <td class="small__fonts jali__regular">0968..</td>
                                                                <td >84</td>
                                                                <td>45k <span>
                                                                    ريال
                                                                </span></td>
                                                                <td>26.3k <span>
                                                                    ريال
                                                                </span></td>
                                                                <td>
                                                                    <span class="badge">
                                                                    <img src="{{ asset('images/icon/preview.png')}}" alt="">عرض </span>
                                                                    <span class="badge">
                                                                        <img src="{{ asset('images/icon/duplicate.png')}}" alt=""> تحكم</span>
                                                                </td>
                                                            </tr>

                                                        </tbody>

                                                    </table>
                                                </div>
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

@section('js')
<script src="{{asset('js/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{asset('js/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('js/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('js/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('js/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('js/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('js/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{asset('js/scripts/datatables/datatable.js') }}"></script>
@endsection
@endsection

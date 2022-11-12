@extends('layouts.horizontal')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendors/css/duration-picker/jquery-duration-picker.css') }}">
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper container">
            <div class="d-flex header-container justify-content-center align-items-center grid__header col-md-12 col-12">
                            <div class="col-md-3 text-left px-0 px-sm-3">
                                <img src="{{ asset('images/logo/header-logo.png')}}"  alt="">
                            </div>
                            <div class="col-md-6  text-center brando__bold">
                            <h1> روابط الدفع</h1>
                            </div>
                            <div class="col-md-3 text-center brando__bold">
                                <a href="{{ route('logout') }}">
                                    <h3 class="brando-extra-light" > تسجيل الخروج </h3>
                                </a>
                            </div>
            </div>
            <div class="content-body">
                <!-- register section starts -->
                <section class="row justify-content-center">
                    <div class="col-md-12 col-11" style="max-width: 1050px">
                        <div class="card data__table__grid mb-0">
                            <div class="row m-0">
                                <!-- register section left -->
                                <div class="col-md-12 col-12 px-0">
                                    <div class=" mb-0 py-2 px-0 h-100 ">
                                        <div class="card-content">
                                            <div class="card-body px-0">
                                                @livewire('alert-component')
                                                <span class="filters back__button">
                                                    <img src="{{asset('images/icon/chevron-right.png')}}" alt="">
                                                    العودة
                                                </span>
                                                <div class="row align-items-center mb-2 px-3">
                                                    <div class="col-md-4">
                                                        <h4 class="brando__black">فندق كيتزال - فرع العليا</h4>
                                                    </div>
                                                    <div class="col-md-5 text-right grid__4">
                                                        <span class="filters" data-toggle="modal" data-target="#filterForm">
                                                                    <img src="{{ asset('images/icon/experiment_1x.png') }}" alt="">
                                                            فلترة
                                                        </span>
                                                        <span class="filters">
                                                        <img src="{{ asset('images/icon/clockwise_1x.png') }}" alt="">
                                                        تحديث</span>
                                                        <span class="filters" data-toggle="modal" data-target="#exportForm">
                                                            <img src="{{ asset('images/icon/export copy_1x.png') }}" alt="">
                                                        تصدير</span>
                                                    </div>
                                                    <div class="col-md-3 text-right add__button">
                                                        <button type="button"  data-toggle="modal" data-target="#addLinkForm" class="btn btn-primary  position-relative "><img src="{{ asset('images/icon/plus.png') }}" alt=""> إنشاء رابط دفع جديد</button>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table zero-configuration-2" id="merchant_list" data-url='{{ route("admin.list") }}' >
                                                        <thead>
                                                            <tr>
                                                                <th>الرقم</th>
                                                                <th>المبلغ</th>
                                                                <th>حالة الدفع</th>
                                                                <th>حالة الاستلام</th>
                                                                <th class="text-center">الإجراءات</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>316</td>
                                                                <td class="bold" style="white-space: nowrap">117 <span> ريال </span> </td>
                                                                <td>
                                                                    <span class="td__badge">تم الدفع</span>
                                                                </td>
                                                                <td>
                                                                    <span class="td__badge">تم الاستلام</span>
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center cursor__pointer">
                                                                        <span class="badge" class="badge"  data-toggle="modal" data-target="#viewLinkForm">
                                                                        <img src="{{ asset('images/icon/preview.png')}}" alt="">عرض </span>
                                                                        <span class="badge">
                                                                            <img src="{{ asset('images/icon/duplicate.png')}}" alt=""> نسخ</span>
                                                                            <span class="badge">
                                                                                <img src="{{ asset('images/icon/export copy_1x.png')}}" alt=""> تصدير</span>
                                                                     </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>316</td>
                                                                <td class="bold">117 <span> ريال </span> </td>
                                                                <td>
                                                                    <span class="td__badge">تم الدفع</span>
                                                                </td>
                                                                <td>
                                                                    <span class="td__badge">تم الاستلام</span>
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center cursor__pointer">
                                                                        <span class="badge"  data-toggle="modal" data-target="#viewLinkForm">
                                                                            <img src="{{ asset('images/icon/preview.png')}}" alt="">عرض </span>
                                                                            <span class="badge">
                                                                                <img src="{{ asset('images/icon/duplicate.png')}}" alt=""> نسخ</span>
                                                                                <span class="badge">
                                                                                    <img src="{{ asset('images/icon/export copy_1x.png')}}" alt=""> تصدير</span>
                                                                    </div>

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

    @include('admin.view_links')
    @include('admin.export_links')
    @include('admin.filter_links')
    @include('admin.add_links')

@endsection
@section('js')
    <script src="{{asset('js/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{asset('js/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/scripts/datatables/datatable.js') }}"></script>
    <script src="{{ asset('js/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.4/semantic.min.js"></script>

    <script src="{{ asset('js/vendors/js/duration-picker/jquery-duration-picker.js') }}"></script>
    <script src="{{ asset('js/scripts/forms/select/form-select2.js') }}"></script>
    <script src="{{ asset('js/vendors/js/pickers/daterange/moment.min.js')}}"></script>
    <script src="{{ asset('js/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script>
        window.pagination = 0;
        window.asset_url = "{{ asset('') }}"
        $('#duration').duration_picker({
            lang : 'ar'
        });
        $(document).on("click", ".plus__minus",  function(e){
            if($(this).find('.minus_duration').length == 1) {
                $(this).parent().find("input").val(
                    parseInt($(this).parent().find("input").val()) - 1
                )
            } else {
                $(this).parent().find("input").val(
                    parseInt($(this).parent().find("input").val()) + 1
                )
            }
            $(this).parent().find("input").trigger("change")
        })
    </script>
@endsection

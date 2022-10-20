@extends('layouts.horizontal')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendors/css/pickers/daterange/daterangepicker.css') }}">
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
                                <a href="{{ route('logout') }}">
                                    <h3 class="brando-extra-light" > تسجيل الخروج </h3>
                                </a>
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
                                                @livewire('alert-component')

                                                <div class="row align-items-center mb-2">
                                                    <div class="col-md-2 ">
                                                        <h4 class="brando__black">قائمة التجار</h4>
                                                    </div>
                                                    <div class="col-md-7 text-right grid__4">
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
                                                        <span class="filters">
                                                            <img src="{{ asset('images/icon/card_1x.png') }}" alt="">
                                                         مخالصة</span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="button"  data-toggle="modal" data-target="#addMerchantForm" class="btn btn-primary glow position-relative "><img src="{{ asset('images/icon/plus.png') }}" alt=""> إضافة متجر جديد </button>

                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table zero-configuration" id="merchant_list" data-url='{{ route("admin.list") }}' >
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
                                                            {{-- <tr>
                                                                <td>18</td>
                                                                <td class="small__fonts">كيتزال..</td>
                                                                <td class="small__fonts">0547..</td>
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
                                                                <td class="small__fonts ">فور سي..</td>
                                                                <td class="small__fonts ">0968..</td>
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
                                                            </tr> --}}

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


@include('admin.dashboard.add_merchant')
@include('admin.dashboard.export_modal')
@livewire('view-merchant')
@endsection
@section('js')
<script src="{{asset('js/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{asset('js/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/scripts/datatables/datatable.js') }}"></script>
<script src="{{ asset('js/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('js/scripts/forms/select/form-select2.js') }}"></script>
<script src="{{ asset('js/vendors/js/pickers/daterange/moment.min.js')}}"></script>
<script src="{{ asset('js/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
<script>
    Livewire.on('merchant_created',() => {
        $("#addMerchantForm").modal("hide");
        $('.zero-configuration').DataTable().draw()
    })

    Livewire.on('merchant_popup', () => {

        // Livewire.emit('refershComponent');
        $("#viewMerchantForm").modal("show");
    })

    $(document).on('click', '.view__merchant', function(){
        Livewire.emit('view_merchant', $(this).attr("id"));
    });

    $(document).ready(function(){

        $(".bootstrap-dt-range").daterangepicker();

        // $(".bootstrap-dt-range").on('apply.daterangepicker', function(ev, picker) {
        //     $(this).val(picker.endDate.format('YYYY-MMM-DD') + ' - ' + picker.startDate.format('YYYY-MMM-DD')  );
        // });

        $(document).on("change", ".select2-icons", function(){
            Livewire.components.componentsById[
                $("#expt__form").attr("wire:id")
            ].set("column", $(this).val())
        })


    })
</script>
@endsection

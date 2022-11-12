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
                            <div class="col-md-3 text-left px-0 px-sm-3">
                                <img src="{{ asset('images/logo/header-logo.png')}}"  alt="">
                            </div>
                            <div class="col-md-6  text-center brando__bold">
                            <h1> المارينفورد</h1>
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
                    <div class="col-md-12 col-12" style="max-width: 1050px">
                        <div class="card data__table__grid mb-0">
                            <div class="row m-0">
                                <!-- register section left -->
                                <div class="col-md-12 col-12 px-0">
                                    <div class="mb-0 py-2 px-0 h-100 ">
                                        <div class="card-content">
                                            <div class="card-body px-0">
                                                @livewire('alert-component')
                                                <span class="filters back__button" >
                                                    <img src="{{ asset('images/icon/chevron-right.png') }}" alt="">
                                                    العودة
                                                </span>
                                                <div class="row align-items-center mb-2 px-3">
                                                    <div class="col-md-2 ">
                                                        <h4 class="brando__black">قائمة التجار</h4>
                                                    </div>
                                                    <div class="col-md-7 text-right grid__4">
                                                        <span class="filters  pos__relative" data-toggle="modal" data-target="#filterForm">
                                                                    <img class="active-image" src="{{ asset('images/icon/experiment_1x.png') }}" alt="">
                                                                    <img class="in-active-image"src="{{ asset('images/icon/experiment.png') }}" alt="">
                                                                    <img class="in-active-image cross-icon"src="{{ asset('images/icon/cross.png') }}" alt="">

                                                            فلترة
                                                        </span>
                                                        <span class="filters" id="refresh">
                                                        <img src="{{ asset('images/icon/clockwise_1x.png') }}" alt="">
                                                        تحديث</span>
                                                        <span class="filters" data-toggle="modal" data-target="#exportForm">
                                                            <img src="{{ asset('images/icon/export copy_1x.png') }}" alt="">
                                                        تصدير</span>
                                                        <span class="filters">
                                                            <img src="{{ asset('images/icon/card_1x.png') }}" alt="">
                                                         مخالصة</span>
                                                    </div>
                                                    <div class="col-md-3 text-md-right add__button">
                                                        <button type="button"  data-toggle="modal" data-target="#addMerchantForm" class="btn btn-primary  position-relative "><img src="{{ asset('images/icon/plus.png') }}" alt=""> إضافة متجر جديد </button>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table admin_tbl zero-configuration" width="100%" id="merchant_list" data-url='{{ route("admin.list") }}' >
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
@include('admin.dashboard.filter_merchant')
@include('admin.dashboard.auth')
@livewire('view-merchant')
@endsection
@section('js')
<script>
      window.pagination = 0;
      window.filtreIDS = [];
      window.filterMerchantName = '';
      window._token = "{{ csrf_token() }}"
</script>
<script src="{{asset('js/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{asset('js/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/scripts/datatables/datatable.js') }}"></script>
<script src="{{ asset('js/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('js/scripts/forms/select/form-select2.js') }}"></script>
<script src="{{ asset('js/vendors/js/pickers/daterange/moment.min.js')}}"></script>
<script src="{{ asset('js/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
<script>
    Livewire.on('merchant_created',() => {
        window.filtreIDS = [];
        $("#addMerchantForm").modal("hide");
        $('.zero-configuration').DataTable().draw()
    })

    Livewire.on('flash_hide', () => {
        setTimeout(() => {
            $(".alert").fadeOut("slow");
        }, 100);
    })

    Livewire.on('merchant_popup', () => {

        // Livewire.emit('refershComponent');
        $("#viewMerchantForm").modal("show");
    })

    $(document).on("click", ".in-active-image.cross-icon, .filters.back__button", function(event){
        event.stopPropagation();
        componentID = $("#filter_Form").attr("wire:id");
        Livewire.components.componentsById[
                        componentID
                    ].call("resetProp");
        Livewire.emit('redraw-DataTable', '');
        $(".in-active-image.cross-icon").parent().removeClass("active");
    });

    Livewire.on('redraw-DataTable', (Ids, merchantName) => {

        window.filtreIDS = Ids;
        window.filterMerchantName = merchantName;
        console.log(window.filterMerchantName);
        $('.zero-configuration').DataTable().draw()
        $("#filterForm").modal("hide");
        $(".in-active-image.cross-icon").parent().addClass("active");
    })

    $(document).on('click', '.view__merchant', function(){
        Livewire.emit('view_merchant', $(this).attr("id"));
    });

    $(document).ready(function(){
        setTimeout(() => {
            $(".alert").fadeOut("slow");
        }, 100);

        $("#refresh").click(function(){
            window.filtreIDS = [];
            $('.zero-configuration').DataTable().draw()
        })
        $(".bootstrap-dt-range").daterangepicker();

        $(document).on("change", ".custom-pagination", function(){
            alert($(this).val());
            window.pagination = $(this).val() - 1;
            $('.zero-configuration').DataTable().draw()
        })
        // $(".bootstrap-dt-range").on('apply.daterangepicker', function(ev, picker) {
        //     $("#abcb").html(picker.endDate.format('YYYY-MMM-DD') + ' - ' + picker.startDate.format('YYYY-MMM-DD')  );
        // });
        $('.modal').on('show.bs.modal', function(){
            if( $(this).find("form").attr("id") != "filter_Form") {
                componentID = $(this).find("form").attr("wire:id");
                if(componentID) {
                    Livewire.components.componentsById[
                        componentID
                    ].call("resetProp");
                } else {
                    componentID = $(this).find(".modal-body").attr("wire:id");
                    if(componentID) {
                        Livewire.components.componentsById[
                            componentID
                        ].call("resetProp");
                    }
                }
            }
        });

        $('.modal').on('show.bs.modal', function(){
            if( $(this).find("form").attr("id") != "filter_Form") {
                componentID = $(this).find("form").attr("wire:id");
                if(componentID) {
                    Livewire.components.componentsById[
                        componentID
                    ].call("resetProp");
                } else {
                    componentID = $(this).find(".modal-body").attr("wire:id");
                    if(componentID) {
                        Livewire.components.componentsById[
                            componentID
                        ].call("resetProp");
                    }
                }
            }
        });

        $(document).on("click", ".auth__merchant", function(){
            $("#authForm").modal("show");
            componentID = $(".register-form").attr("wire:id");
            if(componentID) {
                Livewire.components.componentsById[
                            componentID
                        ].set("phoneNo", $(this).data("phone"));
            }
        })

        $(document).on("change", ".select2-icons", function(){
            if($(this).val().includes('select_all')) {
                $(this).val("");
                console.log($(this).find("option").slice(1));
                $(this).find("option").slice(1).prop("selected", true);
                $(this).trigger("change");
            }
            Livewire.components.componentsById[
                $("#expt__form").attr("wire:id")
            ].set("column", $(this).val())
        })


    })
</script>
@endsection

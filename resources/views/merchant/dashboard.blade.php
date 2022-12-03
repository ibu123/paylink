@extends('layouts.horizontal')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendors/css/duration-picker/jquery-duration-picker.css') }}">
@endsection
@section('title')
 {{ __('Merchant Dashboard') }}
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
                                                        <span class="filters pos__relative" data-toggle="modal" data-target="#filterForm">
                                                                    <img  class="active-image" src="{{ asset('images/icon/experiment_1x.png') }}" alt="">
                                                                    <img class="in-active-image"src="{{ asset('images/icon/experiment.png') }}" alt="">
                                                                    <img class="in-active-image cross-icon"src="{{ asset('images/icon/cross.png') }}" alt="">

                                                            فلترة
                                                        </span>
                                                        <span class="filters">
                                                        <img src="{{ asset('images/icon/clockwise_1x.png') }}" id="refresh" alt="">
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
                                                    <table class="table zero-configuration-2" width="100%" id="merchant_list" data-url='{{ route("merchant.links") }}' >
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
                                                            {{-- <tr>
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
                                                                <td>315</td>
                                                                <td class="bold">528 <span> ريال </span> </td>
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
                                                            <tr>
                                                                <td>314</td>
                                                                <td class="bold">3138 <span> ريال </span> </td>
                                                                <td>
                                                                    <span class="td__badge td__orange">بانتظار الدفع</span>
                                                                </td>
                                                                <td>
                                                                    <span class="td__badge td__gray">غير مستلم</span>
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
                                                            <tr>
                                                                <td>313</td>
                                                                <td class="bold">98 <span> ريال </span> </td>
                                                                <td>
                                                                    <span class="td__badge td__black">ملغي</span>
                                                                </td>
                                                                <td>
                                                                    <span class="td__badge td__black">ملغي</span>
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
                                                            <tr>
                                                                <td>312</td>
                                                                <td class="bold">984 <span> ريال </span> </td>
                                                                <td>
                                                                    <span class="td__badge td__orange">بانتظار الدفع</span>
                                                                </td>
                                                                <td>
                                                                    <span class="td__badge td__gray">غير مستلم</span>
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
                                                            <tr>
                                                                <td>311</td>
                                                                <td class="bold">984 <span> ريال </span> </td>
                                                                <td>
                                                                    <span class="td__badge td__orange">بانتظار الدفع</span>
                                                                </td>
                                                                <td>
                                                                    <span class="td__badge td__gray">غير مستلم</span>
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
                                                            <tr>
                                                                <td>310</td>
                                                                <td class="bold">9864 <span> ريال </span> </td>
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
                                                            <tr>
                                                                <td>309</td>
                                                                <td class="bold">8888 <span> ريال </span> </td>
                                                                <td>
                                                                    <span class="td__badge td__orange">بانتظار الدفع</span>
                                                                </td>
                                                                <td>
                                                                    <span class="td__badge td__gray">غير مستلم</span>
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
                                                            <tr>
                                                                <td>308</td>
                                                                <td class="bold">1080 <span> ريال </span> </td>
                                                                <td>
                                                                    <span class="td__badge td__black">ملغي</span>
                                                                </td>
                                                                <td>
                                                                    <span class="td__badge td__black">ملغي</span>
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
                                                            <tr>
                                                                <td>307</td>
                                                                <td class="bold">1050 <span> ريال </span> </td>
                                                                <td>
                                                                    <span class="td__badge td__orange">بانتظار الدفع</span>
                                                                </td>
                                                                <td>
                                                                    <span class="td__badge td__gray">غير مستلم</span>
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
                                                            <tr>
                                                                <td>306</td>
                                                                <td class="bold">52 <span> ريال </span> </td>
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
                                                            <tr>
                                                                <td>305</td>
                                                                <td class="bold">54 <span> ريال </span> </td>
                                                                <td>
                                                                    <span class="td__badge td__black">ملغي</span>
                                                                </td>
                                                                <td>
                                                                    <span class="td__badge td__black">ملغي</span>
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
                                                            <tr>
                                                                <td>304</td>
                                                                <td class="bold">100 <span> ريال </span> </td>
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
                                                            <tr>
                                                                <td>303</td>
                                                                <td class="bold">42 <span> ريال </span> </td>
                                                                <td>
                                                                    <span class="td__badge td__black">ملغي</span>
                                                                </td>
                                                                <td>
                                                                    <span class="td__badge td__black">ملغي</span>
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
                                                            <tr>
                                                                <td>302</td>
                                                                <td class="bold">1245 <span> ريال </span> </td>
                                                                <td>
                                                                    <span class="td__badge td__orange">بانتظار الدفع</span>
                                                                </td>
                                                                <td>
                                                                    <span class="td__badge td__gray">غير مستلم</span>
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
                                                            <tr>
                                                                <td>301</td>
                                                                <td class="bold">9841 <span> ريال </span> </td>
                                                                <td>
                                                                    <span class="td__badge td__black">ملغي</span>
                                                                </td>
                                                                <td>
                                                                    <span class="td__badge td__black">ملغي</span>
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

    @include('admin.view_links')
    @include('admin.export_links')
    @include('admin.filter_links')
    @include('admin.add_links')

@endsection
@section('js')
    <script type="text/javascript">
        $.fn.bsModal = $.fn.modal.noConflict();
    </script>
    <script src="{{ asset('js/clipboard.min.js')}}"></script>
    <script src="{{asset('js/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{asset('js/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/scripts/datatables/datatable.js') }}"></script>
    <script src="{{ asset('js/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.4/semantic.min.js"></script>

    <script src="{{ asset('js/vendors/js/duration-picker/jquery-duration-picker.js') }}"></script>
    <script src="{{ asset('js/scripts/forms/select/form-select2.js?v=1') }}"></script>
    <script src="{{ asset('js/vendors/js/pickers/daterange/moment.min.js')}}"></script>
    <script src="{{ asset('js/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>


<script>
    var clipboard = new ClipboardJS('.copy_text', {
        container: document.getElementById('copy__container')
    });


    clipboard.on('success', function(e) {
        console.log(e);
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            container: "#copy__container"
        })
        $(".bootstrap-dt-range").daterangepicker();

      

        $(".bootstrap-dt-range").on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                componentID = $("#expt__form").attr("wire:id");
                if(componentID) {
                Livewire.components.componentsById[
                            componentID
                        ].set("date_range", ""); 
                }
        });
    })
</script>
    <script>
        window.filtreIDS = '';
        window.filterStatus = '';
        window.filterAmountFrom = '';
        window.filterAmountTo = '';
        window.pagination = 0;
        window.asset_url = "{{ asset('') }}",
        window._token = "{{ csrf_token() }}"
        $('#duration').duration_picker({
            lang : 'ar'
        });

        $('.modal').on('show.bs.modal', function(){
       
            if( $(this).find("form").attr("id") != "filter_Form" &&  $(this).find("form").attr("id") != 'view__links') {
                componentID = $(this).find("form").attr("wire:id");
                if(componentID) {
                    Livewire.components.componentsById[
                        componentID
                    ].call("resetProp");
                } else {
                        
                    $(".select2-icons").val("");
                    $(".select2-icons").trigger("change");
                    componentID = $(this).find(".modal-body").attr("wire:id");
                    if(componentID) {
                        Livewire.components.componentsById[
                            componentID
                        ].call("resetProp");
                    }
                }
            }
        });

        $(document).on("click", ".in-active-image.cross-icon, .filters.back__button", function(event){
            event.stopPropagation();
                
            $(".select2-icons").val("");
            $(".select2-icons").trigger("change");
            componentID = $("#filter_Form").attr("wire:id");
            Livewire.components.componentsById[
                            componentID
                        ].call("resetProp");
            Livewire.emit('redraw-DataTable', '');
            $(".in-active-image.cross-icon").parent().removeClass("active");
        });

        Livewire.on('link_created',() => {
            window.filtreIDS = [];
            $("#jdp-days").html("0");
            $("#jdp-hours").html("0");
            $("#jdp-minutes").html("0");
            $("#jdp-seconds").html("0");
            
            $("#addLinkForm").bsModal("hide");
            $('.zero-configuration-2').DataTable().draw()
        })

        Livewire.on('link_expired',() => {
            window.filtreIDS = [];
            $("#viewLinkForm").bsModal("hide");
            $('.zero-configuration-2').DataTable().draw()
        })

        Livewire.on('flash_hide', () => {
            setTimeout(() => {
                $(".alert").fadeOut("slow");
            }, 100);
        })

        Livewire.on('viewlink_popup', (Id = "") => {
            $("#viewLinkForm").bsModal("show");
            $("#viewLinkForm").find("#id").html(Id);

        })

        $(document).on('click', '.view__link', function(){
            Livewire.emit('view_link', $(this).attr("id"));
        });

        Livewire.on('redraw-DataTable', (Ids, status, amountFrom, amountTo) => {
            window.filtreIDS = Ids;
            window.filterStatus = status;
            window.filterAmountFrom = amountFrom;
            window.filterAmountTo = amountTo;

            $('.zero-configuration-2').DataTable().draw()
            $("#filterForm").bsModal("hide");
            $(".in-active-image.cross-icon").parent().addClass("active");
        })

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
        $(document).on("change", ".custom-pagination", function(){
            $('.zero-configuration-2').DataTable().context[0].oAjaxData.start = (($(this).val() - 1 ) * 10)
            $('.zero-configuration-2').DataTable().context[0]._iDisplayStart = (($(this).val() - 1) * 10)
            $('.zero-configuration-2').DataTable().draw('page');

        })

        $(document).on("change", ".select2-icons", function(){
            if($(this).val().includes('select_all')) {
                $(this).val("");
                console.log($(this).find("option").slice(1));
                $(this).find("option").slice(1).prop("selected", true);
                $(this).trigger("change");
            }

            Livewire.components.componentsById[
                $("#filter_Form").attr("wire:id")
            ].set("status", $(this).val())
        })

        $("#refresh").click(function(){
            $('.zero-configuration-2').DataTable().draw()
        })

        $(document).on("click", ".copy_text", function(){
            $(this).parents("#copy__container").find(".badge__toaster").show();
            $(this).parents("#copy__container").find(".badge__toaster").fadeOut(1500);
        })

        $(document).on("click", ".copy_text_2", function(){
            $(this).parent().find(".badge__toaster").show();
            $(this).parent().find(".badge__toaster").fadeOut(1500);
        })
    </script>
@endsection

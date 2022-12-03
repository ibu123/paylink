@extends('layouts.horizontal')
@section('title')
 {{ __('Success') }}
@endsection
@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content bg__success">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="row header-container justify-content-center">


                            <img src="{{ asset('images/icon/logo-white.png')}}"  alt="">


            </div>
            <div class="content-body" x-data>
                <!-- register section starts -->
                <section class="row justify-content-center">
                    <div class="col-11 px__650">
                        <div class="card bg-authentication mb-0 border__radius__20" >
                            <div class="row m-0">
                                <!-- register section left -->
                                <div class="col-md-12 col-12 px-0">
                                    {{-- <div class="mb-0 h-100 d-flex justify-content-center"> --}}
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="form-row" >
                                                    <div class="form-group col-md-12 mb-50 ">
                                                            <p class="text-center heading">  تم الدفع بنجاح! </p>
                                                            <p class="text-center sub__line mt-3">
                                                                لقد دفعت بنجاح مبلغ <span>{{$paylink->amount}}</span>  ريال لـ<span>{{$paylink->store->store_display_name}} </span> .
                                                            </p>
                                                            <p class="text-center sub__line mt-2">
                                                                رقم فاتورتك هو #{{str_pad($paylink->id, 4, '0', STR_PAD_LEFT);}}
                                                            </p>
                                                            <div class="mt-3 align-items-center form-group mb-0 d-flex flex-sm-row flex-column col-md-12 justify-content-center paylink_view_pdf">
                                                                <span class="mb-1 mb-sm-0 margin__right__25 icon__badge d-flex align-items-center text-center cursor__pointer" @click="window.open('{{ route("invoice", $orderId) }}', '_blank')">
                                                                    <img src="{{ asset('images/icon/preview.png') }}" alt="">
                                                                    عرض الفاتورة
                                                                </span>
                                                                <span class="mb-1 mb-sm-0 margin__right__25 icon__badge d-flex align-items-center text-center cursor__pointer" @click="window.location = '{{ route("invoice", ["orderId" => $orderId, "download" => 1]) }}'">
                                                                    <img src="{{ asset('images/icon/download.png') }}" alt="">
                                                                    تنزيل الفاتورة
                                                                </span>
                                                                <span class="mb-1 mb-sm-0 margin__right__25 icon__badge d-flex align-items-center text-center cursor__pointer" @click="navigator.share(
                                                                    {
                                                                        title: 'Dafa',
                                                                        text : 'Dafa',
                                                                        url : '{{ Request::url() }}'

                                                                    })">
                                                                    <img src="{{ asset('images/icon/export copy_1x.png') }}" alt="">
                                                                    شارك العملية
                                                                </span>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>




                        <div class="my-5 text-center col-md-12" style="margin:auto">
                            <div class="d-flex flex-column flex-sm-row w-100 justiy-content-center align-items-center">
                                <div class="col-md-4 col mb-2 mb-sm-0 text-white brando-extra-light">
                                دفع، 2022 صنع بفخر في
                                </div>
                                <div class="col-md-4 col col mb-2 mb-sm-0">
                                    <img  class="cursor__pointer" src="{{ asset('images/icon/minthal-info.png')}}"  alt="" onclick="window.location.href='https://twitter.com/MintharInfo?s=20&t=sXQVRmnbKUqWvtENJE4Cog'">
                                </div>
                                <div class="col-md-4 col col mb-2 mb-sm-0 text-white brando-extra-light">

                                mintharinfo@
                                </div>
                            </div>
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

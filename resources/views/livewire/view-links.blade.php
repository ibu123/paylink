<form class="common__form overflow-auto" x-data>
                    <div class="modal-body">

                        <div class="d-flex mb-3  align-items-start header__title flex-wrap">
                            <div class="col-md-4 col-6 d-flex flex-column align-items-center">
                                <label class="align">المبلغ المطلوب</label>
                                <h3> {{ $amount }} <span class="text-dark">ريال </span></h3>
                            </div>
                            <div class="col-md-4 col-6 d-flex flex-column align-items-center">
                                <label>حالة الدفع</label>
                                @if($paymentStatus == 0)
                                    <span class='td__badge td__black'>ملغي</span>
                                @elseif($paymentStatus == 1 && !empty($expirationTime))
                                    <span class='td__badge td__orange'>بانتظار الدفع</span>
                                @elseif($paymentStatus == 1 && empty($expirationTime))
                                    <span class='td__badge td__black'>منتهي</span>
                                @elseif($paymentStatus == 2)
                                    <span class='td__badge'>تم الدفع</span>
                                @endif
                            </div>
                            <div class="col-md-4 mt-1 mt-sm-0 d-flex flex-column align-items-center">
                                <label>حالة الاستلام</label>
                                @if($receivingStatus == 0)
                                    <span class='td__badge td__black'>ملغي</span>
                                @elseif($receivingStatus == 1 && !empty($expirationTime))
                                    <span class='td__badge td__gray'>غير مستلم</span>
                                @elseif($receivingStatus == 1 && $paymentStatus == 1 && empty($expirationTime))
                                    <span class='td__badge td__black'>منتهي</span>
                                @elseif($receivingStatus == 2)
                                    <span class='td__badge'>تم الاستلام</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <label class="d-flex flex-sm-row flex-column justify-content-md-between">الرابط </label>

                                <div class="form-group " id="copy__container">
                                    <span class="badge badge__toaster td_green_color_status ">
                                        انسخ الرابط
                                    </span>
                                    <div class="pos__relative">


                                        <div class="d-flex align-items-center form-control link__copy">
                                            {{ $linkUrl }}

                                        </div>
                                        <span
                                            data-clipboard-action="copy"
                                            data-clipboard-text=" {{ $linkUrl }}"
                                            class="cursor__pointer copy_text icon-in-control icon-in-control-with-text-horizontal brando__extra__bold border-0 d-flex align-items-center"

                                        >
                                            <span class="badge">
                                                <img src="{{ asset('images/icon/duplicate.png') }}" alt=""> نسخ</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <label>صلاحية الرابط</label>
                                <div class="form-group pos__relative">
                                    <div class="jdp-input d-flex align-items-center form-control flex-column flex-sm-row h-auto">
                                        @if($paymentStatus == 1 && !empty($expirationTime))
                                            @php $time = json_decode($expirationTime) @endphp
                                            <span class="td__badge  text-white td_green_color_status">
                                                صالح للدفع
                                            </span>
                                            تنتهي الصلاحية بعد
                                            <div>
                                                <div class="jdp-block margin ">
                                                    <span>{{ $time->d }}</span>
                                                    <br>
                                                    <span class="jdp-label" >أيام</span>
                                                </div>
                                                <div class="jdp-block">
                                                    <span>{{ $time->h }}</span>
                                                    <br>
                                                    <span class="jdp-label">ساعات</span>
                                                </div>
                                                <div class="jdp-block">
                                                    <span>{{ $time->i }}</span>
                                                    <br>
                                                    <span class="jdp-label" >الدقائق</span>
                                                </div>
                                                <div class="jdp-block">
                                                    <span>{{ $time->s }}</span>
                                                    <br>
                                                    <span class="jdp-label">
                                                        ثواني
                                                    </span>
                                                </div>
                                            </div>
                                        @elseif($paymentStatus == 1 && empty($expirationTime))
                                            <span class="td__badge  text-white td_green_color_status">
                                                صالح للدفع
                                            </span>
                                            انتهت صلاحية الرابط
                                        @elseif($paymentStatus == 0)
                                            <span class="td__badge  text-white td_green_color_status">
                                                صالح للدفع
                                            </span>
                                            انتهت صلاحية الرابط
                                        @else
                                            <span class="td__badge  text-white td_green_color_status">
                                                صالح للدفع
                                            </span>
                                            تم الدفع بنجاح
                                        @endif
                                    </div>

                                    <span class="icon-in-control-without-border brando__extra__bold">
                                        <img src="{{ asset('images/icon/clock.png') }}" alt="">
                                    </span>
                                 </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-0">
                                <div class="form-group">
                                    <label>الملاحظات</label>
                                    <textarea class="form-control" name="" id="" cols="30" rows="5" readonly>{{ $notes}}</textarea>
                                </div>
                            </div>
                        </div>
                        @if($paymentStatus == 2)
                            <div class="form-row text-center">
                                <label class="col-md-12">إجراءات</label>
                                <div class="form-group mb-0 d-flex col-md-12 justify-content-center paylink_view_pdf">
                                    <span class="icon__badge d-flex align-items-center text-center" @click="window.open('', '_blank')">
                                        <img src="{{ asset('images/icon/preview.png') }}" alt="">
                                        عرض فاتورة الرابط
                                    </span>
                                    <span class="icon__badge d-flex align-items-center text-center" @click="window.open('', '_blank')">
                                        <img src="{{ asset('images/icon/download.png') }}" alt="">
                                        تحميل فاتورة الرابط بصيغة PDF
                                    </span>
                                </div>
                            </div>
                        @endif
                        @if($receivingStatus == 2)
                            <div class="form-row mt-1">
                                <div class="form-group mb-0 d-flex col-md-12 justify-content-center paylink_view_pdf">
                                    <span class="icon__badge d-flex align-items-center text-center" @click="window.open('', '_blank')">
                                        <img src="{{ asset('images/icon/preview.png') }}" alt="" >
                                        عرض فاتورة الرابط
                                    </span>
                                    <span class="icon__badge d-flex align-items-center text-center" @click="window.open('', '_blank')">
                                        <img src="{{ asset('images/icon/download.png') }}" alt="">
                                        تحميل فاتورة الرابط بصيغة PDF
                                    </span>
                                </div>
                            </div>
                        @endif
                        @if($paymentStatus == 1 && !empty($expirationTime))
                            <div class="form-row mt-1">
                                <div class="form-group mb-0 d-flex col-md-12 justify-content-center paylink_view_pdf">
                                    <span class="icon__badge d-flex align-items-center text-center">
                                        <img src="{{ asset('images/icon/link-broken.png') }}" alt="" class="mr-1"> عرض فاتورة الرابط</span>

                                </div>
                            </div>
                        @endif
                    </div>
</form>

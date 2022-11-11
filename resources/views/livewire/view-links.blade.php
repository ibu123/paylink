<form class="common__form overflow-auto">
                    <div class="modal-body">

                        <div class="d-flex mb-2  align-items-start header__title flex-wrap">
                            <div class="col-md-4 col-6 d-flex flex-column align-items-center">
                                <label class="align">المبلغ المطلوب</label>
                                <h3>  117 <span class="text-dark">ريال </span></h3>
                            </div>
                            <div class="col-md-4 col-6 d-flex flex-column align-items-center">
                                <label>المبلغ المطلوب</label>
                                <span class="td__badge">تم الاستلام</span>
                            </div>
                            <div class="col-md-4 mt-1 mt-sm-0 d-flex flex-column align-items-center">
                                <label>المبلغ المطلوب</label>
                                <span class="td__badge">بانتظار التحويل</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <label class="d-flex flex-sm-row flex-column justify-content-md-between">{{ __('Merchant Name') }} <span> {{ __('As mentioned in the commercial register') }}</span></label>

                                <div class="form-group">
                                    <div class="pos__relative">
                                        <input type="text" class="form-control" name="merchant_name"    class="form-control">
                                        <span class="icon-in-control icon-in-control-with-text-horizontal brando__extra__bold border-0 d-flex align-items-center">
                                            <span class="badge">
                                                <img src="{{ asset('images/icon/duplicate.png') }}" alt=""> نسخ</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <label>{{ __('Commercial Registration No') }}</label>
                                <div class="form-group pos__relative">
                                    <div class="jdp-input d-flex align-items-center form-control flex-column flex-sm-row h-auto">
                                        <span class="td__badge  text-white td_green_color_status">
                                            صالح للدفع
                                        </span>
                                        تنتهي الصلاحية بعد
                                        <div>
                                            <div class="jdp-block margin ">
                                                <span>0</span>
                                                <br>
                                                <span class="jdp-label" >أيام</span>
                                            </div>
                                            <div class="jdp-block">
                                                <span>0</span>
                                                <br>
                                                <span class="jdp-label">ساعات</span>
                                            </div>
                                            <div class="jdp-block">
                                                <span>0</span>
                                                <br>
                                                <span class="jdp-label" >الدقائق</span>
                                            </div>
                                            <div class="jdp-block">
                                                <span>0</span>
                                                <br>
                                                <span class="jdp-label">
                                                     ثواني
                                                </span>
                                            </div>
                                        </div>
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
                                    <label>{{ __('VAT registration number') }}</label>
                                    <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-center">
                            <label class="col-md-12">إجراءات</label>
                            <div class="form-group mb-0 d-flex col-md-12 justify-content-center paylink_view_pdf">
                                <span class="icon__badge d-flex align-items-center text-center">
                                    <img src="{{ asset('images/icon/preview.png') }}" alt="">
                                    عرض فاتورة الرابط
                                </span>
                                <span class="icon__badge d-flex align-items-center text-center">
                                    <img src="{{ asset('images/icon/download.png') }}" alt="">
                                    تحميل فاتورة الرابط بصيغة PDF
                                </span>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="form-group mb-0 d-flex col-md-12 justify-content-center paylink_view_pdf">
                                <span class="icon__badge d-flex align-items-center text-center">
                                    <img src="{{ asset('images/icon/preview.png') }}" alt="" > عرض فاتورة الرابط</span>
                                    <span class="icon__badge d-flex align-items-center text-center">
                                        <img src="{{ asset('images/icon/download.png') }}" alt=""> تحميل فاتورة الرابط بصيغة PDF</span>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="form-group mb-0 d-flex col-md-12 justify-content-center paylink_view_pdf">
                                <span class="icon__badge d-flex align-items-center text-center">
                                    <img src="{{ asset('images/icon/link-broken.png') }}" alt="" class="mr-1"> عرض فاتورة الرابط</span>

                            </div>
                        </div>



                    </div>
</form>

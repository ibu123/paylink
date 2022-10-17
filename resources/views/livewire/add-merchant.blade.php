
<form wire:submit.prevent="addMerchant" class="common__form overflow-auto">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <label class="d-md-flex  justify-content-md-around">اكتب رقم رابط أو أكثر * <span>افصل بين الأرقام بفاصلة أو مسافة أو سطر</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <label>حدد الحالات التي تريد تصدير روابطها <span>(اختياري)</span></label>
                                <div class="form-group">
                                    <input type="text" name="merchant_name" wire:model="merchant_name" class="form-control">
                                    @error('merchant_name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <div class="form-group">
                                    <label>حدد نطاق تاريخ إنشاء الروابط التي تريد تصديرها <span>(اختياري)</span></label>
                                    <div class="pos__relative">
                                        <input type="text" class="form-control">
                                        <span class="icon-in-control brando__extra__bold">
                                            <img src="{{ asset('images/icon/calendar.png') }}" alt="">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50 px-md-4">
                                <label>حدد الملفات والصيغ التي تود تصديرها <span>(1 على الأقل)</span> </label>


                                <div class="row justify-content-start">
                                    <div class="col-md-12 mt-1 px-md-2">
                                        <div class="form-row ">
                                            <div class="form-group m-0">
                                                <input type="radio" name="abc" id="yes" class="radio__btn ">
                                                <label for="yes" class="radio__checked checkbox__checked my-0 brando-extra-light">ملخص بيانات الرابط بصيغة Excel (.csv)</label>
                                            </div>
                                        </div>
                                        <div class="form-row ">
                                            <div class="form-group m-0">
                                                <input type="radio" name="abc" id="yes2" class="radio__btn ">
                                                <label for="yes2" class="radio__checked checkbox__checked my-0  brando-extra-light">فاتورة الرابط بصيغة PDF</label>
                                            </div>
                                        </div>
                                        <div class="form-row ">
                                            <div class="form-group m-0">
                                                <input type="radio" name="abc" id="yes3" class="radio__btn ">
                                                <label for="yes3" class="radio__checked checkbox__checked my-0 brando-extra-light">سلسلة فنادق كيتزال - الإدارة العامة</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer border-0 d-flex justify-content-center">
                        <button type="submit" class="modal__submit btn btn-primary glow position-relative px-3 py-2"
                        ">فلترة الروابط</button>

                    </div>
</form>

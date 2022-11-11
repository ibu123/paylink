
<form action="#" wire:ignore.self class="common__form overflow-auto" id="expt__form">
    <div class="modal-body pb-0">
        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <label class="d-flex flex-sm-row flex-column justify-content-md-around"><span class="bolder">اكتب رقم رابط أو أكثر <strong class="text-danger text-bold">*</strong></span> <span>افصل بين الأرقام بفاصلة أو مسافة أو سطر</span></label>
                <div class="form-group">
                    <input type="text" class="form-control" oninput="javascript: this.value = this.value.replace(/[^0-9,]/g, '');" wire:model="merchantId">
                    @error('merchantId')
                        <span class="error text-danger">{{ $message }} </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <label >حدد البيانات التي تريد تصديرها <span>(اختياري)</span></label>
                <div class="form-group"  wire:ignore>
                    <div class="pos__relative">
                        <select  class="form-control select2-icons" multiple >
                            <option value="id" data-icon="#3cb878">تم الدفع</option>
                            <option value="store_display_name" data-icon="#fbaf5d">بانتظار الدفع</option>

                        </select>
                        <span class="icon-in-control-without-border brando__extra__bold">
                            <img src="{{ asset('images/icon/drop-down-button.png') }}" alt="">
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <div class="form-group">
                    <label>حدد نطاق تاريخ إنشاء الروابط التي تريد تصديرها <span>(اختياري)</span></label>
                    <div class="pos__relative">
                        <input type="text" class="form-control bootstrap-dt-range" wire:model="date_range" onchange="this.dispatchEvent(new InputEvent('input'))">
                        <span class="icon-in-control-without-border brando__extra__bold">
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
                                                <input type="checkbox" id="excel" value="1" class="radio__btn" wire:model="type">
                                                <label for="excel" class="radio__checked checkbox__checked my-0 brando-extra-light">ملخص بيانات الرابط بصيغة Excel (.csv)</label>
                                            </div>
                                        </div>
                                        <div class="form-row ">
                                            <div class="form-group m-0">
                                                <input type="checkbox"  id="pdf" value="2"  class="radio__btn" wire:model="type">
                                                <label for="pdf" class="radio__checked checkbox__checked my-0  brando-extra-light">فاتورة الرابط بصيغة PDF</label>
                                            </div>
                                        </div>
                                        <div class="form-row ">
                                            <div class="form-group m-0">
                                                <input type="checkbox"  id="pdf" value="3"  class="radio__btn" wire:model="type">
                                                <label for="pdf" class="radio__checked checkbox__checked my-0  brando-extra-light">
                                                    فاتورة المنصة بصيغة PDF</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        </div>
    </div>
    <div class="modal-footer border-0 d-flex justify-content-center margin__bottom__modal__footer">
                        <button type="submit" class="modal__submit btn btn-primary  position-relative px-3 py-2"
                        ">فلترة الروابط</button>

    </div>
</form>

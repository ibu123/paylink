
<form wire:submit.prevent="filters" wire:ignore.self class="common__form overflow-auto" id="filter_Form">
    <div class="modal-body pb-0">
        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <label class="d-flex flex-sm-row flex-column justify-content-md-around">ابحث برقم تاجر أو أكثر<span>افصل بين الأرقام بفاصلة أو مسافة أو سطر</span></label>
                <div class="form-group">
                    <input type="text" class="form-control" id="dt_merhcant_id" oninput="javascript: this.value = this.value.replace(/[^0-9,]/g, '');" wire:model="merchantId">
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

            <div class="form-group col-md-6 mb-50">
                <label > ابحث بمبلغ الرابط </label>
                <div class="form-group"  wire:ignore>
                    <input type="text" class="form-control" id="dt_merhcant_id" oninput="javascript: this.value = this.value.replace(/[^0-9,]/g, '');" wire:model="merchantId">
                    @error('merchantId')
                        <span class="error text-danger">{{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-6 mb-50">
                <label for="" class="w-100 text-md-right"><span>شامل الضريبة</span></label>
                <div class="form-group"  wire:ignore>
                    <input type="text" class="form-control" id="dt_merhcant_id" oninput="javascript: this.value = this.value.replace(/[^0-9,]/g, '');" wire:model="merchantId">
                    @error('merchantId')
                        <span class="error text-danger">{{ $message }} </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer border-0 d-flex justify-content-center margin__bottom__modal__footer">
        <button type="submit" class="modal__submit btn btn-primary  position-relative px-3 py-2"
        ">فلترة الروابط</button>
    </div>
</form>

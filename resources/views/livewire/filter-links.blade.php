
<form wire:submit.prevent="filters" wire:ignore.self class="common__form overflow-auto" id="filter_Form">
    <div class="modal-body pb-0">
        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <label class="d-flex flex-sm-row flex-column justify-content-md-between">ابحث برقم رابط أو أكثر<span>افصل بين الأرقام بفاصلة أو شرطة</span></label>
                <div class="form-group">
                    <input type="text" class="form-control" id="dt_merhcant_id" oninput="javascript: this.value = this.value.replace(/[^0-9,،-]/g, '');" wire:model="linkId">
                    @error('merchantId')
                        <span class="error text-danger">{{ $message }} </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <label >ابحث بحالة الرابط</label>
                <div class="form-group"  wire:ignore>
                    <div class="pos__relative">
                        <select  class="form-control select2-icons" multiple >
                            <option value="2" data-icon="#3cb878" data-font-color="#076b37">تم الدفع</option>
                            <option value="1" data-icon="#fbaf5d" data-font-color="#c26c10">بانتظار الدفع</option>
                            <option value="0" data-icon="#4d4d4d" data-font-color="#ffffff">ملغي</option>
                            <option value="3" data-icon="#ededed" data-font-color="#8c8c8c">منتهي الصلاحية</option>

                            <option value="4" data-icon="#00aeef" data-font-color="#005f83">تم الدفع والاستلام</option>
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
                <div class="form-group" >
                    <input type="text" class="form-control" placeholder="المبلغ من.." oninput="javascript: this.value = this.value.replace(/[^0-9,]/g, '');" wire:model="amountFrom">
                    @error('merchantId')
                        <span class="error text-danger">{{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-6 mb-50">
                <label for="" class="w-100 text-md-right"><span>شامل الضريبة</span></label>
                <div class="form-group" >
                    <input type="text" class="form-control" placeholder="المبلغ إلى.."  oninput="javascript: this.value = this.value.replace(/[^0-9,]/g, '');" wire:model="amountTo">
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

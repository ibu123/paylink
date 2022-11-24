
<form wire:submit.prevent="settelment" class="common__form overflow-auto" id="settelment__form">
    <div class="modal-body pb-0">
        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <label class="d-flex flex-sm-row flex-column justify-content-between"><span class="bolder">تحديد التاجر<strong class="text-danger text-bold">*</strong></span> <span>افصل بين الأرقام بفاصلة أو مسافة أو سطر</span></label>
                <div class="form-group"  wire:ignore>
                    <div class="pos__relative">
                        <select  class="form-control  select2-ajax" multiple>

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
                <label >المخالصة بأرقام الفواتير</label>
                <div class="form-group"  wire:ignore>
                    <div class="pos__relative">
                        <select  class="form-control  select2-ajax-paylink" multiple>

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
                        <input type="text" class="form-control bootstrap-dt-range" onchange="this.dispatchEvent(new InputEvent('input'))">
                        <span class="icon-in-control-without-border brando__extra__bold">
                            <img src="{{ asset('images/icon/calendar.png') }}" alt="">
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer border-0 d-flex justify-content-center margin__bottom__modal__footer flex-column">
        @error('no-filter-match')
            <span class="error text-danger my-2">{{ $message }} </span>
        @enderror
                        <button type="submit" class="modal__submit btn btn-primary  position-relative px-3 py-2"
                        ">تصدير بيانات المتاجر</button>

    </div>
</form>

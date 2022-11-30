
<form wire:submit.prevent="settelment" class="common__form overflow-auto" id="settelment__form">
    <div class="modal-body pb-0">
        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <label class="d-flex flex-sm-row flex-column justify-content-between"><span class="bolder">تحديد التاجر<strong class="text-danger text-bold">*</strong></span> </label>
                <div class="form-group mb-0"  wire:ignore>
                    <div class="pos__relative">
                        <select  class="form-control  select2-ajax" multiple>

                        </select>
                        <span class="icon-in-control-without-border brando__extra__bold">
                            <img src="{{ asset('images/icon/drop-down-button.png') }}" alt="">
                        </span>
                    </div>
                </div>
                @error('merchantId')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <label >المخالصة بأرقام الفواتير</label>
                <div class="form-group mb-0"  wire:ignore>
                    <div class="pos__relative">
                        <select  class="form-control  select2-ajax-paylink" multiple>

                        </select>
                        <span class="icon-in-control-without-border brando__extra__bold">
                            <img src="{{ asset('images/icon/drop-down-button.png') }}" alt="">
                        </span>
                    </div>
                </div>

                @error('paylinkId')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-row">

        <div class="col-12 text-center mb-50 or__class">
            — أو —
        </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <div class="form-group">
                    <label>المخالصة بالفترة الزمنية</label>
                    <div class="pos__relative">
                        <input type="text" class="form-control bootstrap-dt-range dropup" wire:model="date_range" onchange="this.dispatchEvent(new InputEvent('input'))">
                        <span class="icon-in-control-without-border brando__extra__bold">
                            <img src="{{ asset('images/icon/calendar.png') }}" alt="">
                        </span>
                    </div>
                    @error('date_range')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer border-0 d-flex justify-content-center margin__bottom__modal__footer flex-column">
        @error('no-filter-match')
            <span class="error text-danger my-2">{{ $message }} </span>
        @enderror
        <button wire:click="exportSettelment()" type="button" class="modal__submit btn btn-primary mr-0 position-relative px-3 py-2 mb-3"
                        ">تصدير التقرير</button>


                        <button type="submit" class="modal__submit btn btn-primary mr-0 position-relative px-3 py-2"
                        ">حفظ المخالصة</button>

    </div>
</form>

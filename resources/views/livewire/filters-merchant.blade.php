
<form wire:submit.prevent="filters" wire:ignore.self class="common__form overflow-auto" id="filter_Form">
    <div class="modal-body">
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

        {{-- <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <div class="form-group">
                    <label>حدد نطاق تاريخ إنشاء الروابط التي تريد تصديرها <span>(اختياري)</span></label>
                    <div class="pos__relative">
                        <input type="text" class="form-control bootstrap-dt-range" wire:model="date_range" onchange="this.dispatchEvent(new InputEvent('input'))">
                        <span class="icon-in-control brando__extra__bold">
                            <img src="{{ asset('images/icon/calendar.png') }}" alt="">
                        </span>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="modal-footer border-0 d-flex justify-content-center">
        <button type="submit" class="modal__submit btn btn-primary glow position-relative px-3 py-2"
        ">فلترة الروابط</button>
    </div>
</form>

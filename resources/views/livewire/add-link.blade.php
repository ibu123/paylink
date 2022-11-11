<form action="#" class="common__form">
    <div class="form-row">
        <div class="form-group col-md-12 mb-50">
            <label class="d-flex flex-sm-row flex-column justify-content-md-between">{{ __('The amount required') }} <span> {{ __('Taxes included') }}</span></label>
            <div class="form-group">
                <input type="text" class="form-control" name="amount"  wire:model="amount" class="form-control">
                @error('amount') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12 mb-50">
            <label class="d-flex flex-sm-row flex-column justify-content-md-between">{{ __('Link validity') }} <span> {{ __('Click the hour field to modify the validity of the link') }}</span></label>
            <div class="form-group pos__relative">

                <input type="text" name="link_validity"  id="duration" class="ui input">
                <span class="icon-in-control-without-border brando__extra__bold">
                    <img src="{{ asset('images/icon/clock.png') }}" alt="">
                </span>
                @error('link_validity') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12 mb-50">
            <label>{{ __('Notes') }} </label>
            <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
        </div>
    </div>

    <div class="modal-footer border-0 d-flex justify-content-center margin__bottom__modal__footer">
                    <button type="submit" class="modal__submit btn btn-primary  position-relative px-2 py-2 border__radius__40"
                    ><img src="{{ asset('images/icon/plus-big.png') }}" alt="">إنشاء رابط دفع جديد </button>
    </div>
</form>

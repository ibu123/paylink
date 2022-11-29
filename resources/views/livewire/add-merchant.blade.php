
<div class="modal-body pb-0">
    <form wire:submit.prevent="addMerchant" class="common__form">
        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <label class="d-flex flex-sm-row flex-column justify-content-md-between">{{ __('Merchant Name') }} <span> {{ __('As mentioned in the commercial register') }}</span></label>
                <div class="form-group">
                    <input type="text" class="form-control" name="merchant_name"  wire:model="merchant_name" class="form-control">
                    @error('merchant_name') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <label>{{ __('Commercial Registration No') }}</label>
                <div class="form-group">
                    <input type="text" name="cr_number"  oninput="javascript: this.value = this.value.replace(/[^0-9]/g, ''); "  wire:model="cr_number" class="form-control">
                    @error('cr_number') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <div class="form-group">
                    <label>{{ __('VAT registration number') }}</label>
                    <div class="pos__relative">
                        <input type="text" class="form-control" oninput="javascript: this.value = this.value.replace(/[^0-9]/g, ''); "  name="vat" wire:model="vat" >
                        @error('vat') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <div class="form-group">
                    <label>{{ __('IBAN Bank Account Number') }}</label>
                    <div class="pos__relative">
                        <input type="text" class="form-control" name="iban"  oninput="javascript: this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '');" wire:model="iban">
                        @error('iban') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <div class="form-group">
                    <label class="d-flex flex-sm-row flex-column justify-content-md-between">{{  __('Write english domain') }} <span class="domain__link"> dafapay.io/<span>name</span>/link/281</span></label>
                    <div class="pos__relative">
                        <input type="text" class="form-control" name="domain" oninput="javascript: this.value = this.value.replace(/[^a-zA-Z0-9-]/g, '');" wire:model="domain">
                        @error('domain') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <div class="form-group">
                    <label>{{ __('Phone number to log in') }}</label>
                    <div class="pos__relative">
                        <input type="text" class="form-control"
                        maxlength="14"
                        oninput="javascript: if(this.value.charAt(0) == '+') {  this.value = '+' + this.value.substr(1).replace(/[^0-9]/g, '')} else { this.value = this.value.replace(/[^0-9]/g, '')}; if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        name="phone_no" wire:model="phone_no">
                        @error('phone_no') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <div class="form-group">
                    <label>{{ __('Store display name') }}</label>
                    <div class="pos__relative">
                        <input type="text" class="form-control" name="store_display_name" wire:model="store_display_name">
                        @error('store_display_name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer border-0 d-flex justify-content-center">
                        <button type="submit" class="modal__submit btn btn-primary  position-relative px-3 py-2"
                        ">إضافة التاجر</button>
        </div>
    </form>
    <form wire:submit.prevent="import" enctpye="multipart/form-data" class="common__form">
        <div class="col-md-12 col-12 text-center mt-3 mb-2">
            <h5 class="brando__bold"> أو ارفع البيانات بالجملة </h5>
        </div>
        <div class="form-row ">
            <div class="form-group col-md-12 mb-0">
                <label class="d-flex flex-sm-row flex-column justify-content-md-between">
                    {{ __('Upload store or store data') }}
                </label>
                <div class="form-group">
                    <label class="w-100" for="file" wire:ignore>
                        <div class="pos__relative">
                            <div class="form-control d-flex align-items-center">
                                <span></span>
                                <span class="icon-in-control icon-in-control-with-text  brando__extra__bold border-0 d-flex flex-column align-items-center">
                                    <img src="{{ asset('images/icon/upload copy.png') }}" alt="" height="16px">
                                    <span color="text-black"> رفع الملف </span>
                                </span>
                            </div>
                        </div>
                    </label>
                    <input type="file" id="file" class="d-none" wire:model="file" accept="xlsx">
                    @error('file') <span class="error text-danger">{{ $message }}</span> @enderror
                    @if($errors && isset($errors->messages()["row"]))
                        @foreach($errors->messages()["row"] as $error)
                            <span class="error text-danger d-block mb-1">{{ $error }}</span>
                        @endforeach
                    @endif
                    <div class="text-center ">
                        <a href="{{ asset('exports/export.xlsx') }}" class="time icon-in-control-without-abs brando__bold">
                            تنزيل ملف نموذج الاستيراد
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal-footer border-0 d-flex justify-content-center w-100 margin__bottom__modal__footer">
            <button type="submit" wire:loading.attr="disabled" class="modal__submit btn btn-primary  position-relative px-3 py-2"
            ">رفع البيانات</button>
        </div>
    </form>
</div>



<form class="common__form" x-data id="view_link_Form">
    <div class="form-row">
        <div class="form-group col-md-12 mb-50">
            <label class="d-flex flex-sm-row flex-column justify-content-md-between">{{ __('Merchant Name') }} <span> {{ __('As mentioned in the commercial register') }}</span></label>
            <div class="form-group pos__relative">
                <input type="text" class="form-control" name="merchant_name"  wire:model="merchant_name"  class="form-control" >
                <span :class="$wire.merchant_name_edit == 0 ? 'icon-in-control brando__bold cursor__pointer  d-none' : 'icon-in-control brando__bold cursor__pointer border-0'" wire:click="update('merchant_name')" >حفظ</span>
                @error('merchant_name') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12 mb-50">
            <label>{{ __('Commercial Registration No') }}</label>
            <div class="form-group pos__relative">
                <input type="text" name="cr_number" oninput="javascript: this.value = this.value.replace(/[^0-9]/g, ''); " wire:model="cr_number" class="form-control" >
                <span :class="$wire.cr_number_edit == 0 ? 'icon-in-control brando__bold cursor__pointer  d-none' : 'icon-in-control brando__bold cursor__pointer border-0'" wire:click="update('cr_number')" >حفظ</span>
                @error('cr_number') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12 mb-50">
            <div class="form-group">
                <label>{{ __('VAT registration number') }}</label>
                <div class="form-group pos__relative">
                    <input type="text" class="form-control" name="vat" oninput="javascript: this.value = this.value.replace(/[^0-9]/g, ''); " wire:model="vat" >
                    <span :class="$wire.vat_edit == 0 ? 'icon-in-control brando__bold cursor__pointer  d-none' : 'icon-in-control brando__bold cursor__pointer border-0'" wire:click="update('vat')" >حفظ</span>
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
                    <input type="text" class="form-control" name="iban" wire:model="iban" class="iban_input" >
                    <span :class="$wire.iban_edit == 0 ? 'icon-in-control brando__bold cursor__pointer  d-none' : 'icon-in-control brando__bold cursor__pointer border-0'" wire:click="update('iban')" >حفظ</span>
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
                    <input type="text" class="form-control" name="domain"  oninput="javascript: this.value = this.value.replace(/[^a-zA-Z0-9-]/g, '');" wire:model="domain" >
                    <span :class="$wire.domain_edit == 0 ? 'icon-in-control brando__bold cursor__pointer  d-none' : 'icon-in-control brando__bold cursor__pointer border-0'" wire:click="update('domain')" >حفظ</span>
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
                    name="phone_no" wire:model="phone_no" >
                    <span :class="$wire.phone_no_edit == 0 ? 'icon-in-control brando__bold cursor__pointer  d-none' : 'icon-in-control brando__bold cursor__pointer border-0'" wire:click="update('phone_no')" >حفظ</span>
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
                    <input type="text" class="form-control" name="store_display_name" wire:model="store_display_name" >
                    <span :class="$wire.store_display_name_edit == 0 ? 'icon-in-control brando__bold cursor__pointer  d-none' : 'icon-in-control brando__bold cursor__pointer border-0'" wire:click="update('store_display_name')" >حفظ</span>
                    @error('store_display_name') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
</form>

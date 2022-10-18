
<form wire:submit.prevent="addMerchant" class="common__form overflow-auto">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <label class="d-flex flex-sm-row flex-column justify-content-md-between">{{ __('Merchant Name') }} <span> {{ __('As mentioned in the commercial register') }}</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="merchant_name" wire:model="merchant_name" class="form-control">
                                    @error('cr_number') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <label>{{ __('Commercial Registration No') }}</label>
                                <div class="form-group">
                                    <input type="text" name="cr_number" wire:model="cr_number" class="form-control">
                                    @error('cr_number') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <div class="form-group">
                                    <label>{{ __('VAT registration number') }}</label>
                                    <div class="pos__relative">
                                        <input type="text" class="form-control" name="vat" wire:model="vat" >
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
                                        <input type="text" class="form-control" name="iban" wire:model="iban">
                                        @error('iban') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <div class="form-group">
                                    <label>{{ __('Write english domain') }}</label>
                                    <div class="pos__relative">
                                        <input type="text" class="form-control" name="domain" wire:model="domain">
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
                                        <input type="text" class="form-control" name="phone_no" wire:model="phone_no">
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

                    </div>
                    <div class="modal-footer border-0 d-flex justify-content-center">
                        <button type="submit" class="modal__submit btn btn-primary glow position-relative px-3 py-2"
                        ">فلترة الروابط</button>
                    </div>
</form>
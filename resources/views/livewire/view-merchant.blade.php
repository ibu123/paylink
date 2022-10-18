    <!--filter form Modal -->
    <div class="modal fade text-left " id="viewMerchantForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content card ">
                <div class="modal-header my-2 border-0 d-flex align-items-center header-container">
                    <div class="col-md-12 col-12 text-center ">
                        <h1 class="brando__bold"> تصدير الروابط </h1>
                        </div>
                    <button type="button" class="modal__close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('images/icon/Close Button.png') }}" alt="">
                    </button>
                </div>
                <form class="common__form overflow-auto">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <label class="d-flex flex-sm-row flex-column justify-content-md-between">{{ __('Merchant Name') }} <span> {{ __('As mentioned in the commercial register') }}</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="merchant_name"  wire:model="merchant_name"  class="form-control">

                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <label>{{ __('Commercial Registration No') }}</label>
                                <div class="form-group">
                                    <input type="text" name="cr_number" wire:model="cr_number" class="form-control">
                                 </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <div class="form-group">
                                    <label>{{ __('VAT registration number') }}</label>
                                    <div class="pos__relative">
                                        <input type="text" class="form-control" name="vat" wire:model="vat" >
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
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

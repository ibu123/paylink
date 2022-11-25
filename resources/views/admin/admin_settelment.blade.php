
<!--filter form Modal -->
<div class="modal fade text-left " id="adminSettelment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content card ">
            <div class="modal-header my-2 border-0 d-flex align-items-center header-container">
                <div class="col-md-12 col-12 text-center ">
                    <h1 class="brando__bold"> المخالصة </h1>
                    </div>
                <button type="button" class="modal__close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('images/icon/Close Button.png') }}" alt="">
                </button>
            </div>
                @livewire('admin-settelment')
        </div>
    </div>
</div>

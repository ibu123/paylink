<form method="POST" wire:submit.prevent="verifyOTP" class="register-form common__form" x-data>
    @csrf
    <div class="form-row" >
        <div class="form-group col-md-12 mb-50 ">
                <p class="text-center">  يرجى إدخال رقم الهاتف ثم ضغط زر التوثيق </p>

            <label for="phone_no" class="brando__semi__bold">رقم الهاتف</label>
            <div class="pos__relative" x-data>
                <input type="text" class="form-control" name="phone_no"
                    id="phone_no" maxlength="14"
                    oninput="javascript: if(this.value.charAt(0) == '+') {  this.value = '+' + this.value.substr(1).replace(/[^0-9]/g, '')} else { this.value = this.value.replace(/[^0-9]/g, '')}; if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    wire:model="phoneNo"
                    {{$readOnly ? readonly : ''}}
                >
                <span :class="$wire.inputStatus == true ? 'icon-in-control brando__bold cursor__pointer d-none' : 'icon-in-control brando__bold cursor__pointer'" wire:click="sendOTP">توثيق</span>
                @error('phoneNo')
                    <span class="error text-danger">{{ $message }}<span>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12 mb-50">
            <p>ستصلك رسالة SMS، الرجاء إدخال رمز التوثيق أدناه</p>

            <label class="brando__semi__bold"> رمز التوثيق</label>
            <div :class="$wire.inputStatus == true ? 'pos__relative' : 'pos__relative disable'">
                <input type="text" disable class="form-control"
                    maxlength="4"
                    name="otp"
                    oninput="javascript: this.value = this.value.replace(/[^0-9]/g, '');
                    if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    wire:model="otp"
                >
                <span class="icon-in-control brando__bold cursor__pointer" wire:click="reSendOTP">إعادة طلب الرمز</span>
                @error('otp')
                    <span class="text-danger error">{{ $message }} </span>
                @enderror
            </div>
        </div>
    </div>
    @if(isset($stores) && $stores->isNotEmpty())
    <p class="text-center">
        هنالك أكثر من حساب مرتبط بهذا الرقم
    </p>
    <p class="text-center">
        الرجاء تحديد الحساب الذي تود تسجيل الدخول له
    </p>
    @endif

        <div class="row justify-content-center align-items-center">
            <div class="list__store">
                @foreach($stores as $store)
                    <div class="form-row ">
                        <div class="form-group m-0">
                            <input type="radio"
                                id="{{$store->id}}__store"
                                class="radio__btn"
                                value="{{$store->id}}"
                                wire:model="store"
                            >
                            <label for="{{$store->id}}__store" class="radio__checked my-0 brando-extra-light">{{ $store->store_display_name}}</label>
                        </div>
                    </div>
                @endforeach
                @error('store')
                    <span class="text-danger error">{{ $message }} </span>
                @enderror
            </div>

        </div>

        {{-- <div class="text-center my-2 pos__relative">
            <span class="time icon-in-control-without-abs brando__bold" id="time__cnt">
                إعادة إرسال OTP بعد <span id="counter"></span>
            </span>
        </div>
        <div class="text-center re-send-otp d-none">
            <a href="{{ route('re-send-otp') }}" class="time icon-in-control-without-abs brando__bold">
                إعادة إرسال OTP
            </a>
        </div> --}}

    <div class="text-center my-2">
        <button type="submit" class="btn btn-primary position-relative login__button">تسجيل الدخول</button>

    </div>
</form>

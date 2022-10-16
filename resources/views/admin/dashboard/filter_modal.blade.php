    <!--filter form Modal -->
<div class="modal fade text-left " id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
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
                <form action="#" class="common__form overflow-auto">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <label class="d-md-flex  justify-content-md-around">اكتب رقم رابط أو أكثر * <span>افصل بين الأرقام بفاصلة أو مسافة أو سطر</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <label>حدد الحالات التي تريد تصدير روابطها <span>(اختياري)</span></label>
                                <div class="form-group">
                                    <input type="text"  class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50">
                                <div class="form-group">
                                    <label>حدد نطاق تاريخ إنشاء الروابط التي تريد تصديرها <span>(اختياري)</span></label>
                                    <div class="pos__relative">
                                        <input type="text" class="form-control">
                                        <span class="icon-in-control brando__extra__bold">
                                            <img src="{{ asset('images/icon/calendar.png') }}" alt="">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-50 px-md-4">
                                <label>حدد الملفات والصيغ التي تود تصديرها <span>(1 على الأقل)</span> </label>


                                <div class="row justify-content-start">
                                    <div class="col-md-12 mt-1 px-md-2">
                                        <div class="form-row ">
                                            <div class="form-group m-0">
                                                <input type="radio" name="abc" id="yes" class="radio__btn ">
                                                <label for="yes" class="radio__checked checkbox__checked my-0 brando-extra-light">ملخص بيانات الرابط بصيغة Excel (.csv)</label>
                                            </div>
                                        </div>
                                        <div class="form-row ">
                                            <div class="form-group m-0">
                                                <input type="radio" name="abc" id="yes2" class="radio__btn ">
                                                <label for="yes2" class="radio__checked checkbox__checked my-0  brando-extra-light">فاتورة الرابط بصيغة PDF</label>
                                            </div>
                                        </div>
                                        <div class="form-row ">
                                            <div class="form-group m-0">
                                                <input type="radio" name="abc" id="yes3" class="radio__btn ">
                                                <label for="yes3" class="radio__checked checkbox__checked my-0 brando-extra-light">سلسلة فنادق كيتزال - الإدارة العامة</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <select mutiple data-placeholder="Select a state..." class="select2-icons form-control select2-hidden-accessible" id="select2-icons" data-select2-id="select2-icons" tabindex="-1" aria-hidden="true">
                                <optgroup label="Services" data-select2-id="331">
                                    <option value="wordpress2" data-icon="bx bxl-wordpress" selected="" data-select2-id="33">WordPress</option>
                                    <option value="codepen" data-icon="bx bxl-codepen" data-select2-id="332">Codepen</option>
                                    <option value="drupal" data-icon="bx bxl-drupal" data-select2-id="333">Drupal</option>
                                    <option value="pinterest2" data-icon="bx bxl-css3" data-select2-id="334">CSS3</option>
                                    <option value="html5" data-icon="bx bxl-html5" data-select2-id="335">HTML5</option>
                                </optgroup>
                                <optgroup label="Browsers" data-select2-id="336">
                                    <option value="chrome" data-icon="bx bxl-chrome" data-select2-id="337">Chrome</option>
                                    <option value="firefox" data-icon="bx bxl-firefox" data-select2-id="338">Firefox</option>
                                    <option value="opera" data-icon="bx bxl-opera" data-select2-id="339">Opera</option>
                                    <option value="IE" data-icon="bx bxl-internet-explorer" data-select2-id="340">IE</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 d-flex justify-content-center">
                        <button type="submit" class="modal__submit btn btn-primary glow position-relative px-3 py-2"
                        ">فلترة الروابط</button>

                    </div>
                </form>
            </div>
        </div>
</div>

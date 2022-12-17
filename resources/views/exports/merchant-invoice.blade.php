<!DOCTYPE html>
<html lang="en">
    <head>
        
        <title>Platform Invoice</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style type="text/css" media="screen">
            html {

                font-family: jali-regular;
                line-height: 1.15;
                margin: 0;
            }


            body {
                font-weight: 400;
                line-height: 1.5;
                color: #212529;
                text-align: left;
                background-color: #fff;
                font-size: 13pt;
                margin: 10pt;
                word-wrap: break-word

            }

            h4 {
                margin-top: 0;
                margin-bottom: 0.5rem;
            }

            p {
                margin-top: 0;
                margin-bottom: 1rem;
            }

            strong {
                font-weight: bolder;
            }

            img {
                vertical-align: middle;
                border-style: none;
            }

            table {
                border-collapse: separate;
            }

            th {
                text-align: inherit;
            }

            h4, .h4 {
                margin-bottom: 0.5rem;
                font-weight: 500;
                line-height: 1.2;
            }

            h4, .h4 {
                font-size: 1.5rem;
            }

            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
                table-layout:fixed;
            }

            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
                word-break:break-all;
                word-wrap:break-word;
            }

            .table.table-items td {
                border-top: 1px solid #dee2e6;
                word-break:break-all;
                word-wrap:break-word;
            }

            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px dotted #D4D3D3;
            }

            .mt-5 {
                margin-top: 3rem !important;
            }

            .pr-0,
            .px-0 {
                padding-right: 0 !important;
            }

            .pl-0,
            .px-0 {
                padding-left: 0 !important;
            }

            .text-right {
                text-align: right !important;
            }

            .text-center {
                text-align: center !important;
            }

            .text-uppercase {
                text-transform: uppercase !important;
            }
            body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
                line-height: 1.1;
            }
            .party-header {
                font-size: 1.5rem;
                font-weight: 400;
            }
            .total-amount {
                font-size: 12px;
                font-weight: 700;
            }
            .border-0 {
                border-top: none !important;
            }
            .cool-gray {
                color: #6B7280;
            }
        </style>
    </head>

    <body>

        <table style="
            width: 100%;
            margin:auto;
            margin-bottom:.3rem;
            border-bottom:1px solid #8A8A8A ">
            <tbody>
                <tr>
                    <td class="" style="
                    /* border:3px solid #a3d091; */
                    border-top-left-radius: .5rem;
                    border-bottom-right-radius : .5rem;
                    padding:0rem 0.75rem 0.75rem 0.75rem;
                    vertical-align:top ;
                    font-family:jali-bold;
                    font-size:2rem;
                    color:#8A8A8A"
                    >

                    <img src="data:image/png;base64, {!! $qrcode !!}" width="146px">
                </td>
                        <td class="" style="
                            border-top-left-radius: .5rem;
                            border-bottom-right-radius : .5rem;
                            padding:0rem 0.75rem 0.75rem 0.75rem;
                            vertical-align:top ;
                            font-family:jali-bold;
                            font-size:2rem;
                            text-align:left;
                            color:#8A8A8A;
                            width:50%"
                            >
                            <table style="width:100%">
                                <tr>
                                    <td style="text-align:center ">
                                        فاتورة ضريبية
                                    </td>
                                </tr>
                            </table>
                            <table style="width:100%;font-size:1rem; text-align:center;padding-top:15px;font-family:jali-regular">
                                <tr>
                                    <td style="width:50%">
                                        الرقم التسلسلي<br>
                                        INV{{str_pad($paylink->sellerInvoice->id, 4, '0', STR_PAD_LEFT)}}
                                    <td  style="width:50%">
                                        التاريخ<br>
                                       {{ \Carbon\Carbon::parse($paylink->paid_date)->format('Y/m/d')}}
                                    </td>
                                </tr>
                            </table>

                        </td>

                </tr>
            </tbody>
        </table>
        <table style="
        width: 100%;
        margin:auto;
        margin-top:2rem;
        margin-bottom:.3rem;
        ">
            <tbody>
                        <td class="" style="
                            border-top-left-radius: .5rem;
                            border-bottom-right-radius : .5rem;
                            padding:0rem 0.75rem 0.75rem 0.75rem;
                            vertical-align:top ;
                            font-family:jali-bold;
                            font-size:1.4rem;
                            text-align:left;
                            color:#8A8A8A;
                            width:50%"
                            >
                            <table style="width:100%">
                                <tr>
                                    <td style="text-align:right ">
                                        معلومات البائع
                                    </td>
                                </tr>
                            </table>
                            <table style="width:100%;font-size:1rem; text-align:center;padding-top:15px;font-family:jali-regular">
                                <tr>
                                    <td >
                                        رقم السجل التجاري<br>
                                        1010835664
                                    </td>
                                    <td style="border-left:1px solid ">
                                        رقم تسجيل ضريبة القيمة المضافة للبائع<br>
                                        311442732600003
                                    </td>
                                        <td style="text-align:right;border-left:1px solid  ">
                                            اسم البائع<br>
                                            شركة عدسة منظار للاتصالات وتقنية المعلومات
                                        </td>

                                </tr>
                            </table>

                        </td>

                </tr>
            </tbody>
        </table>
        <table style="
        width: 100%;
        margin:auto;
        margin-bottom:.3rem;
        ">
            <tbody>
                        <td class="" style="
                            border-top-left-radius: .5rem;
                            border-bottom-right-radius : .5rem;
                            padding:0rem 0.75rem 0.75rem 0.75rem;
                            vertical-align:top ;
                            font-family:jali-bold;
                            font-size:1.4rem;
                            text-align:left;
                            color:#8A8A8A;
                            width:50%"
                            >
                            <table style="width:100%">
                                <tr>
                                    <td style="text-align:right ">
                                        معلومات المشتري
                                    </td>
                                </tr>
                            </table>
                            <table style="width:100%;font-size:1rem; text-align:center;padding-top:15px;font-family:jali-regular">
                                <tr>
                                    <td  >
                                        رقم تسجيل ضريبة القيمة المضافة للبائع<br>
                                        {{ $paylink->store->vat }}
                                    </td>

                                    <td  style="border-left:1px solid ">
                                        رقم السجل التجاري<br>
                                        {{ $paylink->store->cr_number }}
                                    </td>
                                    <td style="text-align:right; border-left:1px solid  ">
                                        اسم البائع  <br>
                                        {{ $paylink->store->store_display_name }}
                                    </td>

                                </tr>
                            </table>

                        </td>

                </tr>
            </tbody>
        </table>




        <table style="width:100%;
        /* border:3px solid #a3d091; */
        border-top-left-radius: .5rem;
        border-bottom-right-radius : .5rem;
        padding:0rem 0.75rem 0.75rem 0.75rem;
        margin-top:2rem;

        ">
            <tr>
                <td>
                    <table class="table table-items" style=" color : #908F90; margin-top:1.3rem; border-top: 2px dotted #D4D3D3;border-bottom: 2px dotted #D4D3D3;">
                        <thead>
                            <th scope="col" class="text-center" width="24%" >المجموع شامل <br>ضريبة القيمة المضافة</th>

                            <th scope="col" class="text-center"   width="11%" style="border-left:1px dotted">قيمة <br>الضريبة</th>
                            <th scope="col" class="text-center"  width="11%" style="border-left:1px dotted">نسبة <br>الضريبة</th>
                            <th scope="col" class="text-center" width="20%" style="border-left:1px dotted">المجموع الفرعي<br> بدون الضريبة</th>
                            <th scope="col" class="text-center" width="9.6%" style="border-left:1px dotted">الكمية</th>
                            <th scope="col" class="text-center" width="10%" style="border-left:1px dotted">سعر  <br>الوحدة</th>
                            <th scope="col" class="text-center" style="font-family:jali-bold; border-left:1px dotted">المنتجات</th>
                        </thead>
                        <tbody>
                            <tr style="font-size:1.2rem">
                                <td class="border-0 text-center" >{{ $paylink->commission }} </td>
                                    <td class="border-0 text-center" style="border-left:1px dotted">{{ $paylink->commission * 15 / 100 }}</td>

                                    <td class="border-0 text-center" style="border-left:1px dotted"> 15 % </td>
                                    <td class="border-0 text-center" style="border-left:1px dotted">{{ $paylink->commission - ($paylink->commission * 15 / 100)}}</td>
                                    <td class="border-0 text-center" style="border-left:1px dotted">1</td>
                                    <td class="border-0 text-center" style="border-left:1px dotted">{{ $paylink->commission - ($paylink->commission * 15 / 100)}}</td>
                                    <td class="border-0 text-center" style="border-left:1px dotted"> <span style="font-size:1rem;"> {{ $paylink->store->store_display_name }}  </span>رابط دفع </td>

                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <table style="width: 100%;margin-left:auto;margin-top:2rem;margin-bottom:.3rem;

        /* border:3px solid #a3d091; */
        border-top-left-radius: .5rem;
        border-bottom-right-radius : .5rem;
        padding:0px 12px 12px 12px;">
            <tbody>
                <tr style="
                font-size : 1.5rem;
                color : #908F90;
                font-family:jali-bold;
                ">
                        <td  style="vertical-align:top;" >{{ $paylink->commission - ($paylink->commission * 15 / 100)}}</td>

                        <td class="text-right" style="
                        vertical-align:top;
                        width:70%" >إجمالي المبلغ الخاضع للضريبة</td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%;margin-left:auto;margin-bottom:.3rem;
            /* border:3px solid #a3d091; */
            border-top-left-radius: .5rem;
            border-bottom-right-radius : .5rem;
            padding:0px 12px 12px 12px"
        >
            <tbody>
                <tr
                    style="font-size : 1.5rem;
                     color : #908F90;
                    font-family:jali-bold;"
                >
                        <td  >{{ $paylink->commission * 15 / 100 }}</td>

                        <td class="text-right" style="width:70%" ><span>(15%) </span>ضريبة القيمة المضافة </td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%;margin-left:auto;margin-bottom:.5rem;

        /* border:3px solid #a3d091; */
        border-top-left-radius: .5rem;
        border-bottom-right-radius : .5rem;
        padding:0px 12px 12px 12px">
            <tbody>
                <tr style="font-size : 1.5rem;

                font-family:jali-bold;
                color : #908F90
                ">
                        <td  style=" vertical-align:top ; " >{{ $paylink->commission }}   </td>

                        <td class="text-right" style=" vertical-align:top ;  width:70%" ><span>(15%) </span>المجموع مع الضريبة </td>
                </tr>
            </tbody>
        </table>

    </body>
</html>

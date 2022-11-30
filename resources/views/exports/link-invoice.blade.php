<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Link Invoice</title>
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
                border: none !important;
            }
            .cool-gray {
                color: #6B7280;
            }
        </style>
    </head>

    <body>

        <table style="width: auto;margin:auto;">
            <tbody>
                <tr>
                        <td class="text-center" style="
                            /* border:3px solid #a3d091; */
                            border-top-left-radius: .5rem;
                            border-bottom-right-radius : .5rem;
                            padding:0rem 0.75rem 0.75rem 0.75rem;
                            vertical-align:top ;
                            font-family:jali-bold;
                            font-size:2rem;
                            color:#8A8A8A"
                             >فاتورة ضريبية مبسطة</th>
                </tr>
            </tbody>
        </table>

        <table style="
        width: auto;
        margin:auto;
        /* border:3px solid #a3d091; */
        border-top-left-radius: .5rem;
        border-bottom-right-radius : .5rem;
        padding:0px 12px 6px 12px">
            <tbody>
                <tr style="
                font-size : 1.2rem;
                font-family:jali-bold;
                color : #908F90
                ">
                        <td  style=" vertical-align:top ; text-align:right " >
                            <span style="vertical-align:middle ;font-size:1.35rem;font-family:jali-regular">
                                INV{{str_pad($paylink->paylinkInvoice->id, 4, '0', STR_PAD_LEFT);}}
                            </span> رقم الفاتورة :   </td>

                 </tr>
            </tbody>
        </table>
        <table style="width: auto;margin:auto;">
            <tbody>
                <tr>
                        <td class="text-center" style="
                            /* border:3px solid #a3d091; */
                            border-top-left-radius: .5rem;
                            border-bottom-right-radius : .5rem;
                            padding:0rem 0.75rem 0.75rem 0.75rem;
                            vertical-align:top;
                            font-family:jali-bold;
                            font-size:1.5rem;
                            color : #7E7E7F
                            " >{{ $paylink->store->store_display_name }}
                        </th>
                </tr>
            </tbody>
        </table>
        {{-- <table style="width: auto;margin:auto;">
            <tbody>
                <tr>
                        <td class="text-center" style="
                       /* border:3px solid #a3d091; */
                            border-top-left-radius: .5rem;
                            border-bottom-right-radius : .5rem;
                            padding:0rem 0.75rem 0.75rem 0.75rem;
                        vertical-align:top;
                        font-family:jali-bold;
                        font-size:1.5rem;
                        color : #7E7E7F
                        "  >عنوان المتجر
                        </th>
                </tr>
            </tbody>
        </table> --}}

        <table style="
        width: auto;
        margin-left:auto;
        margin-bottom:.3rem;
        margin-top:1rem;
        /* border:3px solid #a3d091; */
        border-top-left-radius: .5rem;
        border-bottom-right-radius : .5rem;
        padding:0px 12px 6px 12px">
            <tbody>
                <tr style="
                font-size : 1.2rem;
                font-family:jali-bold;
                color : #908F90
                ">
                        <td  style=" vertical-align:top ; text-align:right " >
                            <span style="vertical-align:middle ;font-size:1.35rem;font-family:jali-regular">
                                {{ \Carbon\Carbon::parse($paylink->paid_date)->format('Y/m/d')}}
                            </span> تاريخ :   </td>

                 </tr>
            </tbody>
        </table>
        <table style="
        width: 100%;
        margin-left:auto;
        margin-bottom:.5rem;
        /* border:3px solid #a3d091; */
        border-top-left-radius: .5rem;
        border-bottom-right-radius : .5rem;
        padding:0px 12px 12px 12px">
            <tbody>
                <tr style="
                font-size : 1.2rem;
                font-family:jali-bold;
                color : #908F90
                ">
                        <td  style=" vertical-align:top ; text-align:right " >
                            <span style="vertical-align:middle ;font-size:1.35rem;font-family:jali-regular">
                                {{ $paylink->store->vat }}
                            </span> رقم تسجيل ضريبة القيمة المضافة :   </td>

                 </tr>
            </tbody>
        </table>


        <table style="width:100%;
        /* border:3px solid #a3d091; */
        border-top-left-radius: .5rem;
        border-bottom-right-radius : .5rem;
        padding:0rem 0.75rem 0.75rem 0.75rem;
        margin-top:1rem;

        ">
            <tr>
                <td>
                    <table class="table table-items" style=" color : #908F90; margin-top:1.3rem; border-top: 2px dotted #D4D3D3;border-bottom: 2px dotted #D4D3D3;">
                        <thead>
                            <th scope="col" class="text-center" width="30%" >السعر شامل <br>ضريبة القيمة المضافة</th>
                            <th scope="col" class="text-center">ضريبة القيمة <br> المضافة</th>
                            <th scope="col" class="text-center">سعر الوحدة</th>
                            <th scope="col" class="text-center">الكمية</th>
                            <th scope="col" class="text-center" style="font-family:jali-bold; font-size:1.6rem">المنتجات</th>
                        </thead>
                        <tbody>
                            <tr style="font-size:1.5rem;">
                                    <td class="border-0 text-center" style="padding-bottom:0px">{{ $paylink->amount }}</td>
                                    <td class="border-0 text-center" style="padding-bottom:0px">{{ $paylink->amount * 15 / 100 }} </td>
                                    <td class="border-0 text-center" style="padding-bottom:0px"> {{ $paylink->amount - ($paylink->amount * 15 / 100)}}</td>
                                    <td class="border-0 text-center" style="padding-bottom:0px">1</td>
                                    <td class="border-0 text-center" style="padding-bottom:0px; "> <span>1 </span>رابط دفع </td>

                            </tr>
                            <tr style="padding:0px">
                                <td colspan="5" class="border-0" style="padding-top:0px; text-align:right" >{{ $paylink->store->store_display_name}}</td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <table style="width: 100%;margin-left:auto;margin-top:1rem;margin-bottom:.3rem;

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
                        <td  style="vertical-align:top;" >{{ $paylink->amount - ($paylink->amount * 15 / 100)}}</td>

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
                        <td  >{{ $paylink->amount * 15 / 100 }}</td>

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
                        <td  style=" vertical-align:top ; " >{{ $paylink->amount }}   </td>

                        <td class="text-right" style=" vertical-align:top ;  width:70%" ><span>(15%) </span>المجموع مع الضريبة </td>
                </tr>
            </tbody>
        </table>
        <table style="width: auto;margin:auto;margin-bottom:.5rem">
            <tbody>
                <tr
                style="font-size : 1.5rem;
                color : #908F90;
                font-family:jali-bold;
                ";
                    >
                    <td>  -----------------  </td>
                    <td>  إغلاق الفاتورة </td>
                    <td> -----------------  </td>
                </tr>
            </tbody>
        </table>
        <table style="width: auto;margin:auto;margin-bottom:.5rem">
            <tbody>

                <tr>
                        <td class="text-center" style= "
                        /* border:3px solid #a3d091; */
                        border-top-left-radius: .5rem;
                        border-bottom-right-radius : .5rem;  vertical-align:top ; padding: 0.75rem;" >
                            <img src="data:image/png;base64, {!! $qrcode !!}" width="146px">
                        </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>

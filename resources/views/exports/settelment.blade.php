<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Settelment Reports</title>
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
                margin: 36pt;
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
                border-collapse: collapse;
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
                border-bottom: 2px solid #dee2e6;
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

        <table class="table table-items">
            <thead>
                <tr>
                    <th scope="col" class="border-0 ">{{ __('id') }}</th>
                    <th scope="col" class="border-0 ">{{ __('Display Name') }}</th>
                    <th scope="col" class="border-0 ">{{ __('Phone No') }}</th>
                    <th scope="col" class="border-0 ">{{ __('IBAN Bank Account Number') }}</th>
                    <th scope="col" class="border-0 ">{{ __('Total Amount Due') }}</th>
                </tr>
            </thead>
            <tbody>
                {{-- Items --}}
                @foreach($settelments as $settelment)
                <tr>
                        <td>
                            {{ $settelment->id }}
                        </td>
                        <td >{{ $settelment->store_display_name }}</td>
                        <td >{{ $settelment->user->phone_no }}</td>
                        <td >
                            {{ $settelment->iban }}
                        </td>

                        <td >
                            {{  $settelment->due_amount - $settelment->commission_amount   }} ريال
                        </td>
                </tr>
                @endforeach


            </tbody>
        </table>


    </body>
</html>


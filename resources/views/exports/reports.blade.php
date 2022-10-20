<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Merchant Reports</title>
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
        {{-- Header --}}
            {{-- <img src="{{asset('images/logo/logo.png')}}" alt="logo" height="100"> --}}


        {{-- <table class="table mt-5">
            <tbody>
                <tr>
                    <td class="border-0 pl-0" width="70%">
                        <h4 class="text-uppercase">
                            <strong>{{ $invoice->name }}</strong>
                        </h4>
                    </td>
                    <td class="border-0 pl-0">
                        @if($invoice->status)
                            <h4 class="text-uppercase cool-gray">
                                <strong>{{ $invoice->status }}</strong>
                            </h4>
                        @endif
                        <p>{{ __('invoices::invoice.serial') }} <strong>{{ $invoice->getSerialNumber() }}</strong></p>
                        <p>{{ __('invoices::invoice.date') }}: <strong>{{ $invoice->getDate() }}</strong></p>
                    </td>
                </tr>
            </tbody>
        </table> --}}

        {{-- Seller - Buyer --}}
        {{-- <table class="table">
            <thead>
                <tr>
                    <th class="border-0 pl-0 party-header" width="48.5%">
                        {{ __('invoices::invoice.seller') }}
                    </th>
                    <th class="border-0" width="3%"></th>
                    <th class="border-0 pl-0 party-header">
                        {{ __('invoices::invoice.buyer') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-0">
                        @if($invoice->seller->name)
                            <p class="seller-name">
                                <strong>{{ $invoice->seller->name }}</strong>
                            </p>
                        @endif

                        @if($invoice->seller->address)
                            <p class="seller-address">
                                {{ __('invoices::invoice.address') }}: {{ $invoice->seller->address }}
                            </p>
                        @endif

                        @if($invoice->seller->code)
                            <p class="seller-code">
                                {{ __('invoices::invoice.code') }}: {{ $invoice->seller->code }}
                            </p>
                        @endif

                        @if($invoice->seller->vat)
                            <p class="seller-vat">
                                {{ __('invoices::invoice.vat') }}: {{ $invoice->seller->vat }}
                            </p>
                        @endif

                        @if($invoice->seller->phone)
                            <p class="seller-phone">
                                {{ __('invoices::invoice.phone') }}: {{ $invoice->seller->phone }}
                            </p>
                        @endif

                        @foreach($invoice->seller->custom_fields as $key => $value)
                            <p class="seller-custom-field">
                                {{ ucfirst($key) }}: {{ $value }}
                            </p>
                        @endforeach
                    </td>
                    <td class="border-0"></td>
                    <td class="px-0">
                        @if($invoice->buyer->name)
                            <p class="buyer-name">
                                <strong>{{ $invoice->buyer->name }}</strong>
                            </p>
                        @endif

                        @if($invoice->buyer->address)
                            <p class="buyer-address">
                                {{ __('invoices::invoice.address') }}: {{ $invoice->buyer->address }}
                            </p>
                        @endif

                        @if($invoice->buyer->code)
                            <p class="buyer-code">
                                {{ __('invoices::invoice.code') }}: {{ $invoice->buyer->code }}
                            </p>
                        @endif

                        @if($invoice->buyer->vat)
                            <p class="buyer-vat">
                                {{ __('invoices::invoice.vat') }}: {{ $invoice->buyer->vat }}
                            </p>
                        @endif

                        @if($invoice->buyer->phone)
                            <p class="buyer-phone">
                                {{ __('invoices::invoice.phone') }}: {{ $invoice->buyer->phone }}
                            </p>
                        @endif

                        @foreach($invoice->buyer->custom_fields as $key => $value)
                            <p class="buyer-custom-field">
                                {{ ucfirst($key) }}: {{ $value }}
                            </p>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table> --}}

        {{-- Table --}}
        <table class="table table-items">
            <thead>
                <tr>
                    @if(!empty($column))
                            @if(in_array("id", $column))
                                <th scope="col" class="border-0 ">{{ __('id') }}</th>
                            @endif
                            @if(in_array("store_display_name", $column))
                                <th scope="col" class="border-0 ">{{ __('Display Name') }}</th>
                            @endif
                            @if (in_array("phone_no", $column)) {
                                <th scope="col" class="border-0 ">{{ __('Phone No') }}</th>
                            @endif
                            @if (in_array("no_links", $column)) {
                                <th scope="col" class="border-0 ">{{ __('No Links') }}</th>
                            @endif
                            @if (in_array("revenue", $column)) {
                                <th scope="col" class="border-0">{{ __('Revenue') }}</th>
                            @endif
                            @if (in_array("net_profit", $column)) {
                                <th scope="col" class="border-0 ">{{ __('Net profit') }}</th>
                            @endif
                    @else
                        <th scope="col" class="border-0 ">{{ __('id') }}</th>
                        <th scope="col" class="border-0 ">{{ __('Display Name') }}</th>
                        <th scope="col" class="border-0 ">{{ __('Phone No') }}</th>
                        <th scope="col" class="border-0 ">{{ __('No Links') }}</th>
                        <th scope="col" class="border-0 ">{{ __('Revenue') }}</th>
                        <th scope="col" class="border-0 ">{{ __('Net profit') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                {{-- Items --}}
                @foreach($users as $merchant)
                <tr>
                    @if(!empty($column))
                        @if(in_array("id", $column))
                            <td class="pl-0">
                                {{ $merchant->id }}
                            </td>
                        @endif
                        @if(in_array("store_display_name", $column))
                            <td >{{ $merchant->store_display_name }}</td>
                        @endif
                        @if(in_array("phone_no", $column))
                            <td >{{ $merchant->user->phone_no  }}</td>
                        @endif
                        @if(in_array("no_links", $column))
                            <td > 0 </td>
                        @endif
                        @if(in_array("revenue", $column))
                            <td > 0 </td>
                        @endif
                        @if(in_array("net_profit", $column))
                        <td > 0 </td>
                    @endif
                    @else
                        <td class="pl-0">
                            {{ $merchant->id }}
                        </td>
                        <td >{{ $merchant->store_display_name }}</td>
                        <td >{{ $merchant->user->phone_no }}</td>
                        <td >
                          0
                        </td>

                        <td >
                            0
                        </td>
                        <td >
                            0
                        </td>
                    @endif
                </tr>
                @endforeach


            </tbody>
        </table>


    </body>
</html>

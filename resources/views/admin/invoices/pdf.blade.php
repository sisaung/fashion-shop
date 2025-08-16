<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
</head>

<body class="bg-gray-100 p-6">

    <div class="max-w-3xl p-4 my-5 bg-white shadow-sm rounded-xl sm:p-6">
        <div class="space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold">INVOICE</h1>



            </div>

            <!-- Voucher Info -->
            <div class="flex flex-col justify-center items-end">
                <div class="flex items-center gap-x-16">
                    <div class="flex flex-col items-end">
                        <div>
                            <label> Invoice Number </label>
                        </div>
                        <div>
                            <label> Invoice Date </label>
                        </div>
                        <div>
                            <label> Customer </label>
                        </div>
                        <div>
                            <label> Contact Number </label>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <div class="text-gray-500"> {{ $invoice->invoice_number }} </div>
                        <div class="text-gray-500"> {{ date('j M Y', strtotime($invoice->created_at)) }} </div>
                        <div class="text-gray-500"> {{ $invoice->order->customer_name }} </div>
                        <div class="text-gray-500"> {{ $invoice->order->customerAddress->phone_number }} </div>

                    </div>
                </div>

            </div>



            <!-- Table -->
            <div class="overflow-x-auto hide-scrollbar">
                <table class="w-full min-w-[400px]">
                    <thead style="background-color:#f5f5f5;" class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-sm font-normal text-left text-gray-500">Products</th>
                            <th class="px-4 py-3 text-sm font-normal text-center text-gray-500">Size</th>
                            <th class="px-4 py-3 text-sm font-normal text-right text-gray-500">QTY</th>
                            <th class="px-4 py-3 text-sm font-normal text-right text-gray-500">Price</th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">

                        @foreach ($invoice->order->orderItems as $orderItem)
                            <tr class="">

                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    {{ $orderItem->stock->product->product_name }} </td>
                                <td class="px-4 py-4 text-sm text-center"> {{ $orderItem->stock->size->size_name }}
                                </td>
                                <td class="px-4 py-4 text-sm text-right"> {{ $orderItem->quantity }} </td>
                                <td class="px-4 py-4 text-sm text-right"> {{ number_format($orderItem->sale_price) }}
                                    MMK
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

            <!-- Totals -->
            <div class="space-y-3 sm:ml-auto me-3 sm:max-w-[200px]">
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Sub Total</span>
                    <span> {{ number_format($invoice->order->total_amount) }} MMK </span>
                </div>
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Tax</span>
                    <span> {{ number_format($invoice->order->tax_amount) }} MMK </span>
                </div>
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Discount</span>
                    @if ($invoice->order->coupon)
                        <span> {{ number_format($invoice->order->coupon->coupon_disount) }} MMK </span>
                    @else
                        <span> 0 MMK </span>
                    @endif
                </div>
                <div class="flex justify-between pt-3 text-base font-semibold border-t border-gray-200">
                    <span>Total</span>
                    <span> {{ number_format($invoice->order->net_total) }} MMK </span>
                </div>
            </div>
        </div>
    </div>


</body>

</html>

<div class="flex {{ $style ?? '' }}">
    @if ($invoiceStatus === 'generated')
        <span
            class="bg-blue-100 text-blue-800 px-4 rounded-full text-xs font-semibold py-1">{{ ucfirst($invoiceStatus) }}</span>
    @elseif ($invoiceStatus === 'sent')
        <span
            class="bg-yellow-100 text-yellow-800 px-4 rounded-full text-xs font-semibold py-1">{{ ucfirst($invoiceStatus) }}</span>
    @elseif ($invoiceStatus === 'downloaded')
        <span
            class="bg-green-100 text-green-800 px-4 rounded-full text-xs font-semibold py-1">{{ ucfirst($invoiceStatus) }}</span>
    @else
        <span
            class="bg-red-100 text-red-800 px-4 rounded-full text-xs font-semibold py-1">{{ ucfirst($invoiceStatus) }}</span>
    @endif
</div>

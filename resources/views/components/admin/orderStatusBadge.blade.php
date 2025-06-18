<div class="flex {{ $style ?? '' }}">
    @if ($orderStatus === 'pending')
        <span
            class="bg-yellow-100 text-yellow-800 px-4 rounded-full text-xs font-semibold py-1">{{ ucfirst($orderStatus) }}</span>
    @elseif ($orderStatus === 'confirmed')
        <span
            class="bg-blue-100 text-blue-800 px-4 rounded-full text-xs font-semibold py-1">{{ ucfirst($orderStatus) }}</span>
    @elseif ($orderStatus === 'delivered')
        <span
            class="bg-purple-100 text-purple-800 px-4 rounded-full text-xs font-semibold py-1">{{ ucfirst($orderStatus) }}</span>
    @elseif ($orderStatus === 'completed')
        <span
            class="bg-green-100 text-green-800 px-4 rounded-full text-xs font-semibold py-1">{{ ucfirst($orderStatus) }}</span>
    @else
        <span
            class="bg-red-100 text-red-800 px-4 rounded-full text-xs font-semibold py-1">{{ ucfirst($orderStatus) }}</span>
    @endif
</div>

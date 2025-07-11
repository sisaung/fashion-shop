@if ($product->discount_type == 'percentage')
    {{ $product->discount_value }}%
@elseif ($product->discount_type == 'fixed')
    {{ number_format($product->discount_value) }} MMK
@else
    0
@endif

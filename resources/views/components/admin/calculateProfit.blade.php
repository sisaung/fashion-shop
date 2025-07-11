@if ($product->discount_type == 'percentage')
    @php
        $discountedPrice = ($product->discount_value / 100) * $product->sale_price;

    @endphp

    {{ $product->display_price - $product->original_price }}
@elseif ($product->discount_type == 'fixed')
    {{ $product->display_price - $product->original_price }}
@else
    {{ $product->sale_price - $product->original_price }}
@endif

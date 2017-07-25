@php($j=1)
@foreach($products as $product)
    <div class="col-md-4 text-center" style="border: 1px solid #fafafa;">
        <img src="{{ $product->image_url }}" width="100%">
        {{ $product->title }}<br>
        <button class="bg-primary">Buy</button>
    </div>
    @if(0 == $j % 3)
    </div>
    <div class="row">
    @endif
    @php($j++)
@endforeach
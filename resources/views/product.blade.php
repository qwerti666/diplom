@extends('layouts.master')

@section('title', __('main.product'))

@section('content')
    <h2>{{ $skus->product->category->name }}</h2>
    <div class="container" style="border-radius: 15px;  border-top: 1px black solid;">

        <div class="col-md-12">
        <h1>{{ $skus->product->__('name') }}</h1>
        <p>{{ $skus->product->__('description') }}</p>
    <img src="{{ Storage::url($skus->product->image) }}">
            @isset($skus->product->properties)
                @foreach ($skus->propertyOptions as $propertyOption)
                    <h4>{{ $propertyOption->property->__('name') }}: {{ $propertyOption->__('name') }}</h4>
                @endforeach
            @endisset
           <center><div style="width: 50%; border-radius: 15px;  border-top: 1px black solid; border-bottom: 1px black solid; padding: 10px; font-size: 24px;">
            <p>@lang('product.price'): <b>{{ $skus->price }} {{ $currencySymbol }}</b></p>

        <button type="submit" class="btn btn-success" role="button" style="width: 100%;">@lang('product.add_to_cart')</button>
        </div> </center> </div>
    @if($skus->isAvailable())
        <form action="{{ route('basket-add', $skus->product) }}" method="POST">
            @csrf
        </form></div>
    @else

        <span>@lang('product.not_available')</span>
        <br>
        <span>@lang('product.tell_me'):</span>
        <div class="warning">
            @if($errors->get('email'))
                {!! $errors->get('email')[0] !!}
            @endif
        </div>
        <form method="POST" action="{{ route('subscription', $skus) }}">
            @csrf
            <input type="text" name="email"></input>
            <button type="submit">@lang('product.subscribe')</button>
        </form>
    @endif
@endsection

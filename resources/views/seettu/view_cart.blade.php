@extends('seettu.layouts.app')

@section('content')
@php
$total = 0;
@endphp
<div class="container">
        <!-- Cart Wrapper-->
        <div class="cart-wrapper-area py-3">
          <div class="cart-table card mb-3">
            <div class="table-responsive card-body">
              <table class="table mb-0">
                <tbody id="cart-summary">
                @if( Session::has('cart') && count(Session::get('cart')) > 0 )
                   
                    @foreach (Session::get('cart') as $key => $cartItem)
                        @php
                          $product = \App\Product::find($cartItem['id']);
                          $total = $total + $cartItem['price']*$cartItem['quantity'];
                          $product_name_with_choice = $product->getTranslation('name');
                          if ($cartItem['variant'] != null) {
                              $product_name_with_choice = $product->getTranslation('name').' - '.$cartItem['variant'];
                          }
                        @endphp
                        <tr>
                            <th scope="row"><a class="remove-product" href="javascript:void(0);" onclick="removeFromCartView(event, {{ $key }})"><i class="lni lni-close"></i></a></th>
                            <td><img src="{{ uploaded_asset($product->thumbnail_img) }}" alt=""></td>
                            <td><a href="{{ route('seettu.product', $product->slug) }}">{{ $product_name_with_choice }}<span>{{ single_price($cartItem['price']) }} x {{ $cartItem['quantity'] }}</span></a></td>
                            <td>
                            <div class="quantity">
                                <input class="qty-text" type="text" value="{{ $cartItem['quantity'] }}" min="1" max="10" step="1" onchange="updateQuantity(0, this)">
                            </div>
                            </td>
                        </tr>
                    @endforeach

                @else
                    <tr>
                        <td colspan="3">
                            <span class="text-info">Cart is Empty</span>
                        </td>
                    </tr>
                @endif
                </tbody>
              </table>
            </div>
          </div>
          <!-- Coupon Area-->
          @if( Session::has('cart') && count(Session::get('cart')) > 0 )
          <!-- Cart Amount Area-->
          <div class="card cart-amount-area">
            <div class="card-body d-flex align-items-center justify-content-between">
             
              <h5 class="total-price mb-0">Rs. <span class="counter" id="cart-total">{{ $total }}</span></h5>

              @if(Auth::check())
                <a class="btn btn-warning" href="{{ route('seettu.checkout.shipping_info') }}">Continue to Shipping</a>
              @else
                <a class="btn btn-warning" href="{{ route('seettu.checkout.shipping_info') }}">{{ translate('Continue to Shipping')}}</a>
              @endif
              

            </div>
          </div>
        </div>
      </div>
      @else 
        <!-- Cart Amount Area-->
        <div class="card cart-amount-area">
            <div class="card-body d-flex align-items-right justify-content-between">
              <a class="btn btn-info" href="{{ route('seettu.home') }}">Keep Shopping</a>
            </div>
          </div>
        </div>
      </div>

      @endif

@endsection

@section('script')
    <script type="text/javascript">
    function removeFromCartView(e, key){
        e.preventDefault();
        removeFromCart(key);
    }

    function updateQuantity(key, element){
        $.post('{{ route('seettu.cart.updateQuantity') }}', { _token:'{{ csrf_token() }}', key:key, quantity: element.value}, function(data){
          $('#cart-total').text(data);
        });
    }
    </script>
@endsection


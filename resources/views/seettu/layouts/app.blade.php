@include('seettu.inc.head')

@yield('content')

@include('seettu.inc.footer')

@yield('modal')

<!-- All JavaScript Files-->
<!-- SCRIPTS -->
<script src="{{ static_asset('assets/js/vendors.js') }}"></script>
<script src="{{ static_asset('assets/js/aiz-core.js') }}"></script>

<script src="{{ static_asset('seettu_assets/js/jquery.min.js') }}"></script>
<script src="{{ static_asset('seettu_assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ static_asset('seettu_assets/js/waypoints.min.js') }}"></script>
<script src="{{ static_asset('seettu_assets/js/jquery.easing.min.js') }}"></script>
<script src="{{ static_asset('seettu_assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ static_asset('seettu_assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ static_asset('seettu_assets/js/jquery.countdown.min.js') }}"></script>
<script src="{{ static_asset('seettu_assets/js/default/jquery.passwordstrength.js') }}"></script>
<script src="{{ static_asset('seettu_assets/js/wow.min.js') }}"></script>
<script src="{{ static_asset('seettu_assets/js/jarallax.min.js') }}"></script>
<script src="{{ static_asset('seettu_assets/js/jarallax-video.min.js') }}"></script>
<script src="{{ static_asset('seettu_assets/js/default/dark-mode-switch.js') }}"></script>
<script src="{{ static_asset('seettu_assets/js/default/no-internet.js') }}"></script>
<script src="{{ static_asset('seettu_assets/js/default/active.js') }}"></script>
<script src="{{ static_asset('seettu_assets/js/pwa.js') }}"></script>

@yield('script')

<script>
    @foreach(session('flash_notification', collect())-> toArray() as $message)
    notifyProductActions("{{ $message['message'] }}", 'bg-primary');
    @endforeach
</script>

<script>
function addToWishList(id) {
    @if(Auth::check() && (Auth::user()->user_type == 'customer' || Auth::user()->user_type == 'seller'))
    $.post('{{ route('seettu.wishlists.store') }}', {
            _token: AIZ.data.csrf,
            id: id
        },
        function(data) {
            if (data != 0) {
                notifyProductActions('Item has been added to wishlist', 'bg-success');
            } else {
                notifyProductActions("{{ translate('Please login first') }}", 'bg-warning');

            }
        });
    @else
    notifyProductActions("{{ translate('Please login first') }}", 'bg-warning');
    @endif
}

// :: Cart Quantity Button Handler
$(".quantity-button-handler").on("click", function () {
    var value = $(this).parent().find("input.cart-quantity-input").val();
    if ($(this).text() == "+") {
        var newVal = parseFloat(value) + 1;
    } else {
        if (value > 1) {
            var newVal = parseFloat(value) - 1;
        } else {
            newVal = 1;
        }
    }
    $(this).parent().find("input").val(newVal);
    getVariantPrice();
});

$('#option-choice-form input').on('change', function(){
    getVariantPrice();
});

function getVariantPrice(){
    if($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()){
        $.ajax({
            type:"POST",
            url: '{{ route('products.variant_price') }}',
            data: $('#option-choice-form').serializeArray(),
            success: function(data){
                $('#option-choice-form #chosen_price_div').removeClass('d-none');
                $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                $('#available-quantity').html(data.quantity);
                $('.input-number').prop('max', data.quantity);
                //console.log(data.quantity);
                if(parseInt(data.quantity) < 1 && data.digital  == 0){
                    $('.add-to-cart').hide();
                }
                else{
                    $('.add-to-cart').show();
                }
            }
        });
    }
}

function checkAddToCartValidity(){
    var names = {};
    $('#option-choice-form input:radio').each(function() { // find unique names
            names[$(this).attr('name')] = true;
    });
    var count = 0;
    $.each(names, function() { // then count them
            count++;
    });

    if($('#option-choice-form input:radio:checked').length == count){
        return true;
    }

    return false;
}

$('#option-choice-form').submit(function (evt) {
    evt.preventDefault();
});

function addToCart(){
    if(checkAddToCartValidity()) {
        $.ajax({
            type:"POST",
            url: '{{ route('cart.addToCart') }}',
            data: $('#option-choice-form').serializeArray(),
            success: function(data){
                notifyProductActions('Item has been added to your cart', 'bg-success');
            }
        });
    }
    else{
        notifyProductActions('Please choose all the options', 'bg-warning');
    }
}

function removeFromCart(key){
    $.post('{{ route('cart.removeFromCart') }}', {_token: AIZ.data.csrf, key:key}, function(data){
        notifyProductActions('Item has been removed from cart', 'bg-success');
        location.reload();
    });
}

</script>

</body>

</html>
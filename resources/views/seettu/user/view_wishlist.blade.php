@extends('seettu.layouts.app')

@section('content')
<!-- Top Products-->
<div class="top-products-area py-3">
        <div class="container">
          <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1">Your Wishlist ({{ count($wishlists) }})</h6>
            <!-- Layout Options-->
            <!-- <div class="layout-options"><a class="active" href="wishlist-grid.html"><i class="lni lni-grid-alt"></i></a><a href="wishlist-list.html"><i class="lni lni-radio-button"></i></a></div> -->
          </div>
          <div class="row g-3">
          @foreach ($wishlists as $key => $wishlist)
            @if ($wishlist->product != null)
            <!-- Single Top Product Card-->
            <div class="col-6 col-md-4 col-lg-3" id="wishlist_{{ $wishlist->id }}">
              <div class="card top-product-card">
                <div class="card-body"><a class="wishlist-btn" href="#"><i class="lni lni-heart"></i></a><a class="product-thumbnail d-block" href="{{ route('seettu.product', $wishlist->product->slug) }}"><img class="mb-2" src="{{ uploaded_asset($wishlist->product->thumbnail_img) }}" alt=""></a><a class="product-title d-block" href="{{ route('seettu.product', $wishlist->product->slug) }}">{{ $wishlist->product->getTranslation('name') }}</a>
                  <p class="sale-price">
                  {{ home_discounted_base_price($wishlist->product->id) }}
                  @if(home_base_price($wishlist->product->id) != home_discounted_base_price($wishlist->product->id))
                  <span>
                  {{ home_base_price($wishlist->product->id) }}
                  </span>
                  @endif
                  </p>
                  <div class="product-rating">{{ renderStarRating($wishlist->product->rating) }}</div><a class="btn btn-success btn-sm add2cart-notify" href="javascript:void(0)" onclick="showAddToCartModal({{ $wishlist->product->id }})"><i class="lni lni-plus"></i></a>
                </div>
              </div>
            </div>
            @endif
            @endforeach

          </div>
        </div>
      </div>
@endsection

@section('modal')

<div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="c-preloader">
                <i class="fa fa-spin fa-spinner"></i>
            </div>
            <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div id="addToCart-modal-body">

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function removeFromWishlist(id){
            $.post('{{ route('seettu.wishlists.remove') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                $('#wishlist').html(data);
                $('#wishlist_'+id).hide();
                AIZ.plugins.notify('success', '{{ translate('Item has been renoved from wishlist') }}');
            })
        }
    </script>
@endsection

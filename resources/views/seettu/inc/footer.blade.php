</div>
<!-- Internet Connection Status-->
<div class="internet-connection-status" id="internetStatus"></div>
<!-- Footer Nav-->
<div class="footer-nav-area" id="footerNav">
    <div class="container h-100 px-0">
        <div class="suha-footer-nav h-100">
            <ul class="h-100 d-flex align-items-center justify-content-between pl-0">
                <li class="{{ areActiveRoutes(['seettu.home'])}}"><a href="{{ route('seettu.home') }}"><i class="lni lni-home"></i>Home</a></li>
                <!-- <li><a href="message.html"><i class="lni lni-life-ring"></i>Support</a></li> -->
                <li class="{{ areActiveRoutes(['seettu.request'])}}"><a href="{{ route('seettu.request') }}"><i class="lni lni-plus"></i>Request</a></li>
                <li class="{{ areActiveRoutes(['seettu.cart'])}}"><a href="{{ route('seettu.cart') }}"><i class="lni lni-shopping-basket"></i>Cart</a></li>
                <li class="{{ areActiveRoutes(['seettu.wishlists.index'])}}"><a href="{{ route('seettu.wishlists.index') }}"><i class="lni lni-heart"></i>Wishlist</a></li>
                <!-- <li><a href="settings.html"><i class="lni lni-cog"></i>Settings</a></li> -->
            </ul>
        </div>
    </div>
</div>

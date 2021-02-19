@section('navigation')
<div class="header-area" id="headerArea">
    <div class="container h-100 d-flex align-items-center justify-content-between">
        <!-- Back Button-->
        <div class="back-button"><a href="{{ route('seettu.home') }}"><i class="lni lni-arrow-left"></i></a></div>
        <!-- Page Title-->
        <div class="page-heading">
            <h6 class="mb-0">Seettu</h6>
        </div>
        <!-- Filter Option-->
        <div class="filter-option" id="suhaNavbarToggler"><i class="lni lni-cog"></i></div>
    </div>
</div>
<!-- Sidenav Black Overlay-->
<div class="sidenav-black-overlay"></div>
<!-- Side Nav Wrapper-->
<div class="suha-sidenav-wrapper filter-nav" id="sidenavWrapper">
    <!-- Catagory Sidebar Area-->
    <div class="catagory-sidebar-area">
        <!-- Catagory-->
        <div class="widget catagory mb-4">
            <h6 class="widget-title mb-3">{{ translate('Categories')}}</h6>
            <div class="widget-desc">
                @foreach(\App\Category::all() as $category)
                <!-- Single Checkbox-->
                    <a class="text-reset" href="{{ route('seettu.products.category', $category->slug) }}"><button class="btn btn-light">{{ $category->getTranslation('name') }}</button></a>
                @endforeach
            </div>
        </div>
        <!-- Color-->
        <div class="widget color mb-4">
            <h6 class="widget-title mb-3">Color Family</h6>
            <div class="widget-desc">
            @foreach ($all_colors as $key => $color)
                <!-- Single Checkbox-->
                <div class="form-check">
                    <input class="form-check-input" id="{{ $color }}" style="background-color:{{ $color }};border-color:{{ $color }};" type="checkbox" checked>
                    <label class="form-check-label font-weight-bold" style="color:{{ $color }};" for="{{ $color }}" @if(isset($selected_color) && $selected_color == $color) checked @endif>{{ \App\Color::where('code', $color)->first()->name }}</label>
                </div>
                @endforeach
            </div>
        </div>
        @foreach ($attributes as $key => $attribute)
        @if (\App\Attribute::find($attribute['id']) != null)
        <!-- Size-->
        <div class="widget size mb-4">
            <h6 class="widget-title mb-3">
            {{ translate('Filter by') }} {{ \App\Attribute::find($attribute['id'])->getTranslation('name') }}
            </h6>
            <div class="widget-desc">
                <!-- Single Checkbox-->
                @if(array_key_exists('values', $attribute))
                    @foreach ($attribute['values'] as $key => $value)
                        @php
                            $flag = false;
                            if(isset($selected_attributes)){
                                foreach ($selected_attributes as $key => $selected_attribute) {
                                    if($selected_attribute['id'] == $attribute['id']){
                                        if(in_array($value, $selected_attribute['values'])){
                                            $flag = true;
                                            break;
                                        }
                                    }
                                }
                            }
                        @endphp
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="attribute_{{ $attribute['id'] }}[]" value="{{ $value }}" @if ($flag) checked @endif>
                    <label class="form-check-label font-weight-bold">{{ $value }}</label>
                </div>
                @endforeach
                @endif

            </div>
        </div>
        @endif
        @endforeach
        <!-- Apply Filter-->
        <div class="apply-filter-btn"><a class="btn btn-success" href="">Apply Filter</a></div>
    </div>
    <!-- Go Back Button-->
    <div class="go-home-btn" id="goHomeBtn"><i class="lni lni-arrow-left"></i></div>
</div>
@endsection
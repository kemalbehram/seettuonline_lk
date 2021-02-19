@extends('seettu.layouts.app')

@section('content')
<style>

.wrapper {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
}

h1 {
  font-family: inherit;
  margin: 0 0 0.75em 0;
  color: #728c8d;
  text-align: center;
}

.box {
  display: block;
  min-width: 300px;
  height: 300px;
  margin: 10px;
  background-color: white;
  border-radius: 5px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  overflow: hidden;
}

.upload-options {
  position: relative;
  height: 75px;
  background-color: #1a99d3;
  cursor: pointer;
  overflow: hidden;
  text-align: center;
  transition: background-color ease-in-out 150ms;
}
.upload-options:hover {
  background-color: #7fb1b3;
}
.upload-options input {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.upload-options label {
  display: flex;
  align-items: center;
  width: 100%;
  height: 100%;
  font-weight: 400;
  text-overflow: ellipsis;
  white-space: nowrap;
  cursor: pointer;
  overflow: hidden;
}
.upload-options label::after {
  content: "\ea03";
  font-family: "LineIcons";
  position: absolute;
  font-size: 2.5rem;
  color: #e6e6e6;
  top: calc(50% - 2.5rem);
  left: calc(50% - 1.25rem);
  z-index: 0;
}
.upload-options label span {
  display: inline-block;
  width: 50%;
  height: 100%;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
  vertical-align: middle;
  text-align: center;
}
.upload-options label span:hover i.material-icons {
  color: lightgray;
}

.js--image-preview {
  height: 225px;
  width: 100%;
  position: relative;
  overflow: hidden;
  background-image: url("");
  background-color: white;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
}
.js--image-preview::after {
  content: "\eaeb";
  font-family: "LineIcons";
  position: relative;
  font-size: 4.5em;
  color: #e6e6e6;
  top: calc(50% - 3rem);
  left: calc(50% - 2.25rem);
  z-index: 0;
}
.js--image-preview.js--no-default::after {
  display: none;
}
.js--image-preview:nth-child(2) {
  background-image: url("http://bastianandre.at/giphy.gif");
}

i.material-icons {
  transition: color 100ms ease-in-out;
  font-size: 2.25em;
  line-height: 55px;
  color: white;
  display: block;
}

.drop {
  display: block;
  position: absolute;
  background: rgba(95, 158, 160, 0.2);
  border-radius: 100%;
  transform: scale(0);
}

.animate {
  -webkit-animation: ripple 0.4s linear;
          animation: ripple 0.4s linear;
}

@-webkit-keyframes ripple {
  100% {
    opacity: 0;
    transform: scale(2.5);
  }
}

@keyframes ripple {
  100% {
    opacity: 0;
    transform: scale(2.5);
  }
}
</style>
<div class="container">
    <div class="profile-wrapper-area py-3">
        <!-- User Information-->
        <div class="card user-info-card">
            <div class="card-body p-4 d-flex align-items-center">

                <div class="user-info">
                    <h5 class="mb-0 text-white">Request Your Item</h5>
                    <p class="mb-0 text-white">We'll buy that for you!</p>
                </div>
            </div>
        </div>
        <!-- User Meta Data-->
        <div class="card user-data-card">
            <div class="card-body">
            
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('seettu.request.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="title mb-2"><i class="lni lni-user"></i><span>Product Name</span></div>
                        <input class="form-control" type="text" name="product_name" value=""required>
                    </div>

                    <div class="title mb-2"><i class="lni lni-image"></i><span>Upload Image</span></div>
                    <div class="wrapper">
                        <div class="box">
                            <div class="js--image-preview"></div>
                            <div class="upload-options">
                                <label>
                                    <input type="file" class="image-upload" name="product_image" accept="image/*" required/>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="title mb-2"><i class="lni lni-user"></i><span>Description</span></div>
                        <input class="form-control" type="text" name="description" required value="">
                    </div>
                    <div class="mb-3">
                        <div class="title mb-2"><i class="lni lni-user"></i><span>Full Name</span></div>
                        <input class="form-control" type="text" name="fullname" required value="">
                    </div>
                    <div class="mb-3">
                        <div class="title mb-2"><i class="lni lni-phone"></i><span>Phone</span></div>
                        <input class="form-control" type="text" name="phone" required value="">
                    </div>
                    <div class="mb-3">
                        <div class="title mb-2"><i class="lni lni-envelope"></i><span>Email Address</span></div>
                        <input class="form-control" type="email" name="email" required value="">
                    </div>
                    <div class="mb-3">
                        <div class="title mb-2"><i class="lni lni-map-marker"></i><span>Shipping Address</span></div>
                        <input class="form-control" type="text" name="shipping" required value="">
                    </div>
                    <button class="btn btn-success w-100" type="submit">Find My Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
function initImageUpload(box) {
    let uploadField = box.querySelector('.image-upload');

    uploadField.addEventListener('change', getFile);

    function getFile(e) {
        let file = e.currentTarget.files[0];
        checkType(file);
    }

    function previewImage(file) {
        let thumb = box.querySelector('.js--image-preview'),
            reader = new FileReader();

        reader.onload = function () {
            thumb.style.backgroundImage = 'url(' + reader.result + ')';
        }
        reader.readAsDataURL(file);
        thumb.className += ' js--no-default';
    }

    function checkType(file) {
        let imageType = /image.*/;
        if (!file.type.match(imageType)) {
            throw 'Datei ist kein Bild';
        } else if (!file) {
            throw 'Kein Bild gewählt';
        } else {
            previewImage(file);
        }
    }

}

// initialize box-scope
var boxes = document.querySelectorAll('.box');

for (let i = 0; i < boxes.length; i++) {
    let box = boxes[i];
    initDropEffect(box);
    initImageUpload(box);
}



/// drop-effect
function initDropEffect(box) {
    let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;

    // get clickable area for drop effect
    area = box.querySelector('.js--image-preview');
    area.addEventListener('click', fireRipple);

    function fireRipple(e) {
        area = e.currentTarget
        // create drop
        if (!drop) {
            drop = document.createElement('span');
            drop.className = 'drop';
            this.appendChild(drop);
        }
        // reset animate class
        drop.className = 'drop';

        // calculate dimensions of area (longest side)
        areaWidth = getComputedStyle(this, null).getPropertyValue("width");
        areaHeight = getComputedStyle(this, null).getPropertyValue("height");
        maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

        // set drop dimensions to fill area
        drop.style.width = maxDistance + 'px';
        drop.style.height = maxDistance + 'px';

        // calculate dimensions of drop
        dropWidth = getComputedStyle(this, null).getPropertyValue("width");
        dropHeight = getComputedStyle(this, null).getPropertyValue("height");

        // calculate relative coordinates of click
        // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
        x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10) / 2);
        y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10) / 2) - 30;

        // position drop and animate
        drop.style.top = y + 'px';
        drop.style.left = x + 'px';
        drop.className += ' animate';
        e.stopPropagation();

    }
}

@if(session('message'))
notifyProductActions("{{ $message['message'] }}", 'bg-primary');
@endif

</script>
@endsection

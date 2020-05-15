@extends('layouts.offer')

@section('title','Edit offer ajax')

@section('content')

<div class="container">
    
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            {{__('messages.Update your offer')}}

        </div>
'
            <div id="success_msg" class="alert alert-success" role="alert" style="display: none;">
            </div>

            <div id="error_msg" class="alert alert-danger" role="alert" style="display: none;">
            </div>

        <br>
        <form method="POST" id="myform" action="">
            @method('PUT')
            @csrf

            <input type="hidden"  name="id" value="{{$offer -> id}}">

            <div class="form-group">
                <label for="exampleInputEmail1">أختر صوره العرض</label>
                <input type="file" id="file" class="form-control" name="photo">
                @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
         
            <div class="form-group">
                <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                <input type="text" class="form-control" name="name_ar" value="{{$offer -> name_ar}}" placeholder="{{__('messages.Offer Name')}}">
                <small id="name_ar_error" class="form-text text-danger"></small>

            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                <input type="text" class="form-control" name="name_en" value="{{$offer -> name_en}}"  placeholder="{{__('messages.Offer Name')}}">
                <small id="name_en_error" class="form-text text-danger"></small>

            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Offer Price')}}</label>
                <input type="text" class="form-control" name="price"  value="{{$offer -> price}}" placeholder="{{__('messages.Offer Price')}}">
                <small id="price_error" class="form-text text-danger"></small>

            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Offer details ar')}}</label>
                <input type="text" class="form-control " name="details_ar" value="{{$offer -> details_ar}}" placeholder="{{__('messages.Offer details')}}">
                <small id="details_ar_error" class="form-text text-danger"></small>

            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Offer details en')}}</label>
                <input type="text" class="form-control" name="details_en" value="{{$offer -> details_en}}"  placeholder="{{__('messages.Offer details')}}">
                <small id="details_en_error" class="form-text text-danger"></small>

            </div>

            <button id="update_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
        </form>


    </div>
</div>

    
</div>

@endsection

@section('scripts')
<script>


    $(document).on('click','#update_offer',function(e){
            e.preventDefault();

            $('#photo_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');


            $('#success_msg').text('').css("display", "none");
            $('#error_msg').text('').css("display", "none");

            var formData = new FormData($('#myform')[0]);


            $.ajax({  
                  type:'post',
                  enctype: 'multipart/form-data',
                  url:"{{route('ajax.offers.update')}}",
                  data:formData,
                  processData: false,
                  contentType: false,
                  cache: false,
                  success: function(data){
                    if (data.status == true) {

                        $('#success_msg').text(data.msg).show();

                        }
                        else{

                            $('#error_msg').text(data.msg).show();

                        }
                  },
                  error: function(reject){
                        var response = $.parseJSON(reject.responseText);
                        $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                       });
                  },
  
                  });

    });

    



</script>
@endsection


@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
@endpush

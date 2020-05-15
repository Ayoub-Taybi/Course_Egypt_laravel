@extends('layouts.offer')

@section('title','Craete offer ajax')

@section('content')
    
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            {{__('messages.Add your offer')}} Ajax
        </div>

        <br>

        <div id="success_msg" class="alert alert-success" role="alert" style="display:none;">
        </div>

        
        <form method="POST" action=""  id="offerForm" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="exampleInputEmail1">أختر صوره العرض</label>
                <input type="file" class="form-control " name="photo">
                <small id="photo_error" class="form-text text-danger"></small>
            </div>

           

            <div class="form-group">
                <label >{{__('messages.Offer Name ar')}}</label>
               <input type="text" class="form-control " name="name_ar" value="{{ old('name_ar') }}" placeholder="{{__('messages.Enter name')}} ar">
               <small id="name_ar_error" class="form-text text-danger"></small>
            </div>

            
            <div class="form-group">
                <label >{{__('messages.Offer Name en')}}</label>
               <input type="text" class="form-control " name="name_en" value="{{ old('name_en') }}" placeholder="{{__('messages.Enter name')}} en">
               <small id="name_en_error" class="form-text text-danger"></small>
              
            </div>

            <div class="form-group">
                <label >{{__('messages.Offer Price')}}</label>
                <input type="text" class="form-control " name="price" value="{{ old('price') }}" placeholder="{{__('messages.Price')}}">
                <small id="price_error" class="form-text text-danger"></small>
            </div>

            <div class="form-group">
                <label >{{__('messages.Offer details ar')}}</label>
                <input type="text" class="form-control " name="details_ar" value=" {{old('details_ar')}} " placeholder="details ar">
                <small id="details_ar_error" class="form-text text-danger"></small>
            </div>

            <div class="form-group">
                <label >{{__('messages.Offer details en')}}</label>
                <input type="text" class="form-control " name="details_en" value=" {{old('details_en')}} " placeholder="details en">
                <small id="details_en_error" class="form-text text-danger"></small>

            </div>

           

            <button id="save_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
        </form>


    </div>
</div>

@stop

@section('scripts')

<script>

    $(document).on('click', '#save_offer', function (e) {
        e.preventDefault();

        $('#photo_error').text('');
        $('#name_ar_error').text('');
        $('#name_en_error').text('');
        $('#price_error').text('');
        $('#details_ar_error').text('');
        $('#details_en_error').text('');

        $('#success_msg').text('').css("display", "none");

        var formData = new FormData($('#offerForm')[0]);

        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{route('ajax.offers.store')}}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {

                if (data.status == true) {
                    $('#success_msg').text(data.msg).show();
                }


            }, error: function (reject) {
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function (key, val) {
                    $("#" + key + "_error").text(val[0]);
                });
            }
        });
    });


</script>


@endsection

@push('scripts')
       <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
@endpush
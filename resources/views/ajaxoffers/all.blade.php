@extends('layouts.offer')

@section('title','all offers')
    
@section('content')

<div class="container">


    @if (Session::has('error'))
        <div id="error_msg" class="alert alert-danger" role="alert">
          {{Session::get('error')}}
        </div>
    @endif

    <div id="success_msg" class="alert alert-success" role="alert" style="display:none;">
    </div>

    <div id="error_msg" class="alert alert-danger" role="alert" style="display:none;">
    </div>

    
    
    
    
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('messages.Offer Name')}}</th>
            <th scope="col">{{__('messages.Offer Price')}}</th>
            <th scope="col">{{__('messages.Offer details')}}</th>
            <th scope="col">صوره العرض</th>
            <th scope="col">{{__('messages.operation')}}</th>
    
        </tr>
        </thead>
        <tbody>
    
        @each('ajaxoffers.rows', $offers, 'offer')
         
        </tbody>
    </table>
    
    
</div>

@stop



@section('scripts')

    <script>
       
        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();
             
              $('#success_msg').text('').css("display", "none");
              $('#error_msg').text('').css("display", "none");

              var offer_id =  $(this).attr('offer_id');

            $.ajax({
                type: 'post',
                 url: "{{route('ajax.offers.delete')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :offer_id
                },
                success: function (data) {
                    if(data.status == true){

                        $('#success_msg').text(data.msg).show();
                        $('.offerRow'+data.id).remove();
                    }
                    else{

                        $('#error_msg').text(data.msg).show();
                    }
                }, error: function (reject) {

                }
            });
        });
    </script>



@endsection

@push('scripts')
       <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
@endpush
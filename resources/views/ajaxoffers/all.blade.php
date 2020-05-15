@extends('layouts.offer')

@section('title','all offers')
    
@section('content')

<div class="container">


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
    
    
        @foreach($offers as $offer)
            <tr class='offerRow{{$offer -> id}}'>
                <th scope="row">{{$offer -> id}}</th>
                <td>{{$offer -> name}}</td>
                <td>{{$offer -> price}}</td>
                <td>{{$offer -> details}}</td>
                <td>
                    <img  style="width: 90px; height: 90px;" src="{{asset('/images/offers/'.$offer->photo)}}">
                </td>
                <td>

                    <a href="{{url('offers/edit/'.$offer -> id)}}" class="btn btn-success"> {{__('messages.update')}}</a>
                    <a href="#" offer_id="{{$offer -> id}}"  class="delete_btn btn btn-danger"> حذف اجاكس     </a>
                
                </td>
    
            </tr>
        @endforeach
    
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

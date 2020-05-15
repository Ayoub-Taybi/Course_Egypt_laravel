@extends('layouts.offer')


@section('title','All Offers')


@section('content')
    


<div class="container">

@if(Session::has('success'))

<div class="alert alert-success">
       {{Session::get('success')}}
</div>
@endif


@if(Session::has('error'))
 <div class="alert alert-danger">
     {{Session::get('error')}}
 </div>
@endif


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


    @forelse($offers as $offer)
        <tr>
            <th scope="row">{{$offer -> id}}</th>
            <td>{{$offer -> name}}</td>
            <td>{{$offer -> price}}</td>
            <td>{{$offer -> details}}</td>
            <td>
                <img  style="width: 90px; height: 90px;" src="{{asset('/images/offers/'.$offer->photo)}}">
            </td>

            <td>
                <a href="{{url('offers/edit/'.$offer -> id)}}" class="btn btn-success"> {{__('messages.update')}}</a>
                  {{-- this line when we use delete with mehode get --}}
                <a href="{{route('offers.delete',$offer -> id)}}" class="btn btn-danger"> {{__('messages.delete')}}</a>
            </td>


        </tr>

    @empty
    @endforelse

    </tbody>
</table>


</div>


@endsection



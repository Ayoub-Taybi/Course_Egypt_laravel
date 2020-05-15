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
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <br>
        <form method="POST" action="{{route('offers.update',$offer -> id)}}">
            @method('PUT')

            @csrf

            {{-- <input name="_token" value="{{csrf_token()}}"> --}}
            <div class="form-group">
                <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                <input type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{$offer -> name_ar}}" placeholder="{{__('messages.Offer Name')}}">
                @error('name_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                <input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{$offer -> name_en}}"  placeholder="{{__('messages.Offer Name')}}">
                @error('name_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Offer Price')}}</label>
                <input type="text" class="form-control" name="price"  value="{{$offer -> price}}" placeholder="{{__('messages.Offer Price')}}">
                @error('price')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Offer details ar')}}</label>
                <input type="text" class="form-control @error('details_ar') is-invalid @enderror" name="details_ar" value="{{$offer -> details_ar}}" placeholder="{{__('messages.Offer details')}}">
                @error('details_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Offer details en')}}</label>
                <input type="text" class="form-control @error('details_en') is-invalid @enderror" name="details_en" value="{{$offer -> details_en}}"  placeholder="{{__('messages.Offer details')}}">
                @error('details_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
        </form>


    </div>
</div>

    
</div>

@endsection
@extends('layouts.offer')

@section('title','Create Offer')
    
@section('content')
    
<div class="container">

    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{__('messages.Add your offer')}}
            </div>
    
         @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
               {{ Session::get('success') }}
            </div>
         @endif
    
            <br>
            <form method="POST" action="{{route('offers.store')}}" enctype="multipart/form-data">
                @csrf
    
                <div class="form-group">
                    <label for="exampleInputEmail1">أختر صوره العرض</label>
                    <input type="file" class="form-control @error('name_ar') is-invalid @enderror" name="photo">
                    @error('photo')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
    
               
    
                <div class="form-group">
                    <label >{{__('messages.Offer Name ar')}}</label>
                   <input type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{ old('name_ar') }}" placeholder="{{__('messages.Enter name')}} ar">
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
    
                
                <div class="form-group">
                    <label >{{__('messages.Offer Name en')}}</label>
                   <input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en') }}" placeholder="{{__('messages.Enter name')}} en">
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
    
                <div class="form-group">
                    <label >{{__('messages.Offer Price')}}</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="{{__('messages.Price')}}">
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
    
                <div class="form-group">
                    <label >{{__('messages.Offer details ar')}}</label>
                    <input type="text" class="form-control @error('details_ar') is-invalid @enderror" name="details_ar" value=" {{old('details_ar')}} " placeholder="details ar">
                    @error('details_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
    
                <div class="form-group">
                    <label >{{__('messages.Offer details en')}}</label>
                    <input type="text" class="form-control @error('details_en') is-invalid @enderror" name="details_en" value=" {{old('details_en')}} " placeholder="details en">
                    @error('details_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
    
               
    
                <button type="submit" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
            </form>
    
    
        </div>
    </div>
    
</div>

@stop
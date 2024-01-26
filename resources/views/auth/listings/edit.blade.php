   
@extends('layouts.template')
   
   @section('content')
       <div class="row">
           <div class="col-lg-12 margin-tb">
               <div class="pull-left">
                   <h2>Edit Listings</h2>
               </div>
           </div>
       </div>
      
       @if ($errors->any())
           <div class="alert alert-danger">
               <strong>Whoops!</strong> There were some problems with your input.<br><br>
               <ul>
                   @foreach ($errors->all() as $error)
                       <li>{{ $error }}</li>
                   @endforeach
               </ul>
           </div>
       @endif
     
       <form action="{{ route('listings.update',$listing->id) }}" method="POST">
           @csrf
           @method('PUT')
      
            <div class="row">
               <input type="hidden" name="id" value="{{ $listing->id }}"> <br/>
   
               <div class="col-xs-12 col-sm-12 col-md-12">
                   <div class="form-group">
                       <strong>Name:</strong>
                       <input type="text" name="name" value="{{ $listing->name }}" class="form-control" placeholder="Name">
                   </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-12">
                   <div class="form-group">
                       <strong>Latitude:</strong>
                       <input type="type" class="form-control" name="latitude" value="{{ $listing->latitude }}" placeholder="Email"></input>
                   </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-12">
                   <div class="form-group">
                       <strong>Longitude:</strong>
                       <input type="type" class="form-control" name="longitude" value="{{ $listing->longitude }}" placeholder="Email"></input>
                   </div>
               </div>

               <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                 <button type="submit" class="btn btn-primary">Submit</button>
                   <a class="btn btn-primary" href="{{ route('listings.index') }}"> Back</a>
               </div>
           </div>
      
       </form>
   @endsection
   
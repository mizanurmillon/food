@extends('layouts.app')

@section('content')
<div class="main__body">
    <div class="profile-inner">
        <div class="container">
            <div class="row pt-2">
                <div class="col-md-3 col-lg-3">
                    @include('customer.sideber')
                </div>
                <div class="col-md-9 col-lg-9 pt-3">
                    <div class="row">
                        <div class="col-lg-9 mt-2">
                            <div class="card p-4">
                                @isset($check)
                                <h3>Update Your Review:</h3>
                                <form action="{{ route('clientsay.update') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $check->id }}">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Select Rating</label>
                                    <select class="form-control" name="rating">
                                        <option value="1" @if($check->rating==1) selected @endif>1 Star</option>
                                        <option value="2" @if($check->rating==2) selected @endif>2 Star</option>
                                        <option value="3" @if($check->rating==3) selected @endif>3 Star</option>
                                        <option value="4" @if($check->rating==4) selected @endif>4 Star</option>
                                        <option value="5" @if($check->rating==5) selected @endif>5 Star</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Message</label>
                                    <textarea class="form-control" rows="4" name="message">{{ $check->message }}</textarea>
                                  </div>
                                  <button type="submit" class="btn btn-success">Update</button>
                                </form>
                                @else
                                <h3>Write Your Review:</h3>
                                <form action="{{ route('clientsay.store') }}" method="post">
                                    @csrf
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Select Rating</label>
                                    <select class="form-control" name="rating">
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5">5 Star</option>
                                    </select>
                                    
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Message</label>
                                    <textarea class="form-control" rows="4" name="message"></textarea>
                                  </div>
                                  <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">I write my own review</label>
                                  </div>
                                  <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection

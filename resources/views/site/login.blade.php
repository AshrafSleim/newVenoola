@extends('site.layouts.index')
@section('content')
           <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="title-left">
                        <h3>Account Login</h3>
                    </div>
                    <h5><a data-toggle="collapse" href="#formLogin" role="button" aria-expanded="false">Click here to Login</a></h5>
                    <form class="mt-3 collapse review-form-box" id="formLogin" method="post" action="{{route('sitePostLogin')}}">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Enter Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <input class="form-control" type="hidden" name="last_url"  value="{{$last_url}}">

                        <button type="submit" class="btn hvr-hover">Login</button>
                    </form>
                </div>
@endsection

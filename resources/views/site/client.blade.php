@extends('site.layouts.index')
@section('content')
             <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="title-left">
                        <h3>Create New Account</h3>
                    </div>
                    <h5><a data-toggle="collapse" href="#formRegister" role="button" aria-expanded="false">Click here to Register</a></h5>
                    <form class="mt-3 collapse review-form-box" id="formRegister" method="post" action="{{route('sitePostRegister')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" class="mb-0">Your Name</label>
                                <input type="text" class="form-control" id="name" placeholder=" Your Name" name="name" value="{{old('name')}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class="mb-0">Phone</label>
                                <input type="text" class="form-control" id="phone" placeholder=" Your phone" name="phone" value="{{old('phone')}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="mb-0">Email Address</label>
                                <input type="text" class="form-control" id="email" placeholder=" Your email" name="email" value="{{old('email')}}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="password" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            <input class="form-control" type="hidden" name="last_url"  value="{{$last_url}}">

                        </div>
                        <button type="submit" class="btn hvr-hover">Register</button>
                    </form>
                </div>


@endsection

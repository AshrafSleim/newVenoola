@extends('site.layouts.index')
@section('content')
             <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="title-left">
                        <h3>Create New Account</h3>
                    </div>
                    <h5><a data-toggle="collapse" href="#formRegister" role="button" aria-expanded="false">Click here to Register</a></h5>
                    <form class="mt-3 collapse review-form-box" id="formRegister"method="POST"  action="{{route('PostVendorRegister')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" class="mb-0">First Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" placeholder="First Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class="mb-0">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone')}}" placeholder="Last Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="market" class="mb-0">Market Name</label>
                                <input type="text" class="form-control" id="market" name="market" value="{{old('market')}}" placeholder="Market Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="image" class="mb-0">Market Logo</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/x-png,image/gif,image/jpg,image/jpeg" required>
                            </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Register</button>
                    </form>
                </div>
</div>

@endsection

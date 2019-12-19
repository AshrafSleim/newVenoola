@extends('site.layouts.index')
@section('content')
           <div class="col-sm-6 col-lg-6 mb-3" style="margin: auto;margin-top: 66px;">
                    <div class="title-left">
                        <h3 align="center" style="color:black;" >Forget Password</h3>
                    </div>
                    <form class="mt-3  review-form-box" id="" method="post" action="{{route('postResetPassword')}}">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email" class="mb-0">{{trans('site.Email Address')}} </label>
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="{{trans('site.Email Address')}}">
                            </div>
                        </div>

                        <button type="submit" class="btn hvr-hover">Send</button>
                    </form>
                </div>
@endsection

@extends('site.layouts.index')
@section('content')
           <div class="col-sm-6 col-lg-6 mb-3" style="margin: auto;margin-top: 66px;">
                    <div class="title-left">
                        <h3 align="center" style="color:black;" >Reset Password</h3>
                    </div>
                    <form class="mt-3  review-form-box" id="" method="post" action="#">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password" class="mb-0">{{trans('site.Password')}}</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="{{trans('site.Password')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password" class="mb-0">{{trans('site.Password')}}</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Confirm {{trans('site.Password')}}">
                            </div>
                            
                        </div>
                        

                        <button type="submit" class="btn hvr-hover">Reset</button>
                    </form>
                </div>
@endsection

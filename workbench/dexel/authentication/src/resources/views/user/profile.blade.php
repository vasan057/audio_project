@extends("web.main")
@section('css')
<link rel="stylesheet" href="{{asset('assets/coach/css/jquery-ui.css')}}">
<style>
    label { text-align: left!important; }
</style>
@stop
@section('content')
<img src="{{asset('assets/web/images/stressfit_logo_text.png')}}" class="landing_logo" alt="">
<div class="streak_header col-md-12">
   <div class="webx-page-title user-edit-profile-title col-md-5 pull-right" 
   style="background: url({{asset('assets/web/images/streak-header-audio.png')}})no-repeat bottom right;">
       <h2>Edit Profile</h2>
   </div>
   <div class="clearboth"></div>
    <span class="streak-header"></span>
</div>
<div class="container dexel-customercoach-Container">
    <div id="page">
        <form role="form" class="col-md-offset-2 col-md-8 col-sm-10 col-sm-offset-1 col-xs-12 "  method="post" enctype= multipart/form-data>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(Session::has('message'))
                <p>{{ Session::get('message') }}</p>
            @endif
        	<div class="tab-content">
                <div class="form-horizontal dexel-coach-form">

                    <div class="form-group">
                        <label for="inputName3" class="col-sm-4 col-xs-12">First name</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="" value="{{old('fname',$user->fname)}}">
                            {!!$errors->first('fname','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>
        			<div class="form-group">
                        <label for="inputName3" class="col-sm-4 col-xs-12">Last name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="" value="{{old('lname',$user->lname)}}">
                            {!!$errors->first('lname','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>
        			<div class="form-group">
                        <label for="inputName3" class="col-sm-4 col-xs-12">Contact number</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="" value="{{old('phone',$user->phone)}}">
                            {!!$errors->first('phone','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>
        			<div class="form-group">
                        <label for="inputName3" class="col-sm-4 col-xs-12">Email</label>
                        <div class="col-sm-8">{{$user->email}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName3" class="col-sm-4 col-xs-12">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            {!!$errors->first('password','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName3" class="col-sm-4 col-xs-12">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                            {!!$errors->first('confirm_password','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>
        			<div class="form-group">
                        <label for="inputName3" class="col-sm-4 col-xs-12">Gender</label>
                        <div class="col-sm-8 text-left" >
                        <?php $gender= old('gender',$user->profile->gender); ?>
                        @foreach(['M'=>'Male','F'=>'Female','O'=>'Others'] as $key=>$value)
                        <?php $selected=''; if($gender == $key) { $selected ='checked="checked"'; } ?>
                        <div >
                            <input type="radio" name="gender" placeholder="" value="{{$key}}" {{$selected}}>&nbsp;{{$value}} <br/>
                        </div>

                            
                        @endforeach
                             {!!$errors->first('gender','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>
        			<div class="form-group">
                        <label for="inputName3" class="col-sm-4 col-xs-12">Date of birth</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="dob" name="dob" placeholder="dd-mm-yyyy" value="{{old('dob',date('d-m-Y',strtotime($user->profile->dob)))}}">
                            {!!$errors->first('dob','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputName3" class="col-sm-4 col-xs-12">Profile Picture</label>
                        <div class="col-sm-8">
                            <img src="{{cdn($user->profile->photo)}}" width="100"/>
                            <input type="file" class="form-control" id="photo" name="photo" placeholder="" value="{{old('photo')}}">
                            {!!$errors->first('photo','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>
        			<div class="form-group">
                        <label for="inputName3" class="col-sm-4 col-xs-12">About</label>
                        <div class="col-md-8">
                            <textarea id="about" class="form-control" name="about">{{old('about',$user->profile->about)}}</textarea>
                            {!!$errors->first('about','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>
        			<div class="form-group">
                        <label for="inputName3" class="col-sm-4 col-xs-12">Address</label>
                        <div class="col-sm-8">
        					<textarea class="form-control" id="address" name="address[street]">{{old('address.street',$user->profile->address['street'])}}</textarea>
                            {!!$errors->first('address.street','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>
        			<div class="form-group">
                        <label for="inputName3" class="col-sm-4 col-xs-12">Suburb</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="suburb" name="address[suburb]" placeholder="" value="{{old('address.suburb',$user->profile->address['suburb'])}}">
                            {!!$errors->first('address.suburb','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>
        			<div class="form-group">
                        <label for="inputName3" class="col-sm-4 col-xs-12">Postal code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="postal_code" name="address[postal_code]" placeholder="" value="{{old('address.postal_code',$user->profile->address['postal_code'])}}">
                            {!!$errors->first('address.postal_code','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>
        			<div class="form-group">
                        <label for="inputName3" class="col-sm-4 col-xs-12">State</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="state" name="address[state]" placeholder="" value="{{old('address.state',$user->profile->address['state'])}}">
                            {!!$errors->first('address.state','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>
        			<div class="form-group">
                        <label for="inputName3" class="col-sm-4 col-xs-12">Country</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="country" name="address[country]" placeholder="" value="{{old('address.country',$user->profile->address['country'])}}">
                            {!!$errors->first('address.country','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>
                </div>

                <ul class="dexel-reg-btn">
                    <li class="col-md-12">
                        <button type="submit" class="btn btn-primary next-step" id="register_id">Update</button>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>
</div>
@stop
@section('script')
<script src="{{asset('assets/coach/js/jquery-ui.js')}}"></script>
<script type="text/javascript">
    $( "#dob" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"
        });
</script>
@stop

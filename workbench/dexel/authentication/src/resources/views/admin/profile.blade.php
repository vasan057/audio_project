@extends("admin::main")
@section('css')
<link rel="stylesheet" href="{{asset('assets/coach/css/jquery-ui.css')}}">
@stop
@section('content')

<nav class="navbar dexel-coach-navbar2">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand header-brand" href="#">Edit Profile</a>
    </div>
  </div>
</nav>

<form role="form" class="col-md-offset-3 col-md-7 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 app-page"  method="post" enctype= multipart/form-data>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @if(Session::has('message'))
        <p>{{ Session::get('message') }}</p>
    @endif
	<div class="tab-content">
       
        <div class="form-horizontal dexel-coach-form">

            <div class="form-group">
                <label for="inputName3" class="col-sm-4">First name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="" value="{{old('fname',$user->fname)}}">
                    {!!$errors->first('fname','<span class="form-error">:message</span>')!!}
                </div>
            </div>
			<div class="form-group">
                <label for="inputName3" class="col-sm-4">Last name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="" value="{{old('lname',$user->lname)}}">
                    {!!$errors->first('lname','<span class="form-error">:message</span>')!!}
                </div>
            </div>
			<div class="form-group">
                <label for="inputName3" class="col-sm-4">Contact number</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="" value="{{old('phone',$user->phone)}}">
                    {!!$errors->first('phone','<span class="form-error">:message</span>')!!}
                </div>
            </div>
			<div class="form-group">
                <label for="inputName3" class="col-sm-4">Email</label>
                <div class="col-sm-8">{{$user->email}}
                </div>
            </div>
            <div class="form-group">
                <label for="inputName3" class="col-sm-4">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    {!!$errors->first('password','<span class="form-error">:message</span>')!!}
                </div>
            </div>
            <div class="form-group">
                <label for="inputName3" class="col-sm-4">Confirm Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                    {!!$errors->first('confirm_password','<span class="form-error">:message</span>')!!}
                </div>
            </div>
			<div class="form-group">
                <label for="inputName3" class="col-sm-4">Gender</label>
                <div class="col-sm-8">
                <?php $gender= old('gender',$user->profile->gender); ?>
                @foreach(['M'=>'Male','F'=>'Female','O'=>'Others'] as $key=>$value)
                <?php $selected=''; if($gender == $key) { $selected ='checked="checked"'; } ?>

                    {{$value}}<input type="radio" name="gender" placeholder="" value="{{$key}}" {{$selected}}>&nbsp;
                @endforeach
                     {!!$errors->first('gender','<span class="form-error">:message</span>')!!}
                </div>
            </div>
			<div class="form-group">
                <label for="inputName3" class="col-sm-4">Date of birth</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="dob" name="dob" placeholder="dd-mm-yyyy" value="{{old('dob',date('d-m-Y',strtotime($user->profile->dob)))}}">
                    {!!$errors->first('dob','<span class="form-error">:message</span>')!!}
                </div>
            </div>

            <div class="form-group">
                <label for="inputName3" class="col-sm-4">Profile Picture</label>
                <div class="col-sm-8">
                    <img src="{{cdn($user->profile->photo)}}" width="100"/>
                    <input type="file" class="form-control" id="photo" name="photo" placeholder="" value="{{old('photo')}}">
                    {!!$errors->first('photo','<span class="form-error">:message</span>')!!}
                </div>
            </div>
            <div class="form-group">
                <label for="inputName3" class="col-sm-4">Cover Image</label>
                <div class="col-sm-8">
                    <img src="{{cdn($user->profile->cover_img)}}" height="100" width="100%"/>
                    <input type="file" class="form-control" id="cover_img" name="cover_img" placeholder="" value="{{old('cover_img')}}">
                    {!!$errors->first('cover_img','<span class="form-error">:message</span>')!!}
                </div>
            </div>
            <div class="form-group">
                <label for="inputName3" class="col-sm-4">Tag Line</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="tag_line" name="tag_line" placeholder="" value="{{old('tag_line',$user->profile->tag_line)}}">
                    {!!$errors->first('tag_line','<span class="form-error">:message</span>')!!}
                </div>
            </div>
			<div class="form-group">
                <label for="inputName3" class="col-sm-4">About</label>
                <div class="col-md-6 col-sm-8">
                    <textarea id="about" class="form-control" name="about">{{old('about',$user->profile->about)}}</textarea>
                    {!!$errors->first('about','<span class="form-error">:message</span>')!!}
                </div>
            </div>
			<div class="form-group">
                <label for="inputName3" class="col-sm-4">Address</label>
                <div class="col-sm-8">
					<textarea class="form-control" id="address" name="address[street]">{{old('address.street',$user->profile->address['street'])}}</textarea>
                    {!!$errors->first('address.street','<span class="form-error">:message</span>')!!}
                </div>
            </div>
			<div class="form-group">
                <label for="inputName3" class="col-sm-4">Suburb</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="suburb" name="address[suburb]" placeholder="" value="{{old('address.suburb',$user->profile->address['suburb'])}}">
                    {!!$errors->first('address.suburb','<span class="form-error">:message</span>')!!}
                </div>
            </div>
			<div class="form-group">
                <label for="inputName3" class="col-sm-4">Postal code</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="postal_code" name="address[postal_code]" placeholder="" value="{{old('address.postal_code',$user->profile->address['postal_code'])}}">
                    {!!$errors->first('address.postal_code','<span class="form-error">:message</span>')!!}
                </div>
            </div>
			<div class="form-group">
                <label for="inputName3" class="col-sm-4">State</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="state" name="address[state]" placeholder="" value="{{old('address.state',$user->profile->address['state'])}}">
                    {!!$errors->first('address.state','<span class="form-error">:message</span>')!!}
                </div>
            </div>
			<div class="form-group">
                <label for="inputName3" class="col-sm-4">Country</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="country" name="address[country]" placeholder="" value="{{old('address.country',$user->profile->address['country'])}}">
                    {!!$errors->first('address.country','<span class="form-error">:message</span>')!!}
                </div>
            </div>
            <div class="form-group">
                <label for="inputName3" class="col-sm-4">Expertise</label>
                <div class="col-sm-8">
                <?php $user_experts = $user->expertise()->select('expertise.id')->get(); ?>
                    @foreach($expertise as $expert)
                        <?php
                            $selected ='';
                            foreach ($user_experts as $user_expert)
                            {
                               if($user_expert->id == $expert->id)
                               {
                                $selected ='checked="checked"';
                                break;
                               }
                            }
                       ?>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type='checkbox' name='expert_in[]' value="{{$expert->id}}" {{$selected}} data="expert{{$expert->title}}" id="expert{{$expert->id}}" class="chk"/>
                            <span class="text-center">{{$expert->title}}</span>
                        </div>
                    @endforeach
                    {!!$errors->first('expert_in','<div class="col-md-12"><span class="form-error">:message</span></div>')!!}
                </div>
            </div>
            <div class="form-group">
                <label for="inputName3" class="col-sm-4">Custom Expertise</label>
                <div class="col-sm-8" id="dexel-coach-expertise">
                    <input type="text" class="form-control" id="custom_expertise" maxlength="25"/>
                    <span id="add_custom_expertise" class=" fa fa-plus add-expertise-btn"></span>
                    @if(($custom_expertise = count(old('custom_expertise'))))
                        @foreach(range(0, $custom_expertise-1) as $index)
                            <div class="col-md-12">
                                <input name="custom_expertise[]" readonly  type="hidden" value="{{old('custom_expertise')[$index]}}">
                                <span class="text-center custom_expertise_txt">{{old('custom_expertise')[$index]}}</span>
                                <span class="remove_expertise fa fa-close"></span>
                                {!!$errors->first("custom_expertise.".$index,"<span class='form-error'>:message</span>")!!}
                            </div>
                        @endforeach
                    @elseif($user->custom_expertise->count())
                        @foreach($user->custom_expertise as $custom_expertise)
                            <div class="col-md-12">
                                <input name="custom_expertise[]" readonly  type="hidden" value="{{$custom_expertise->title}}">
                                <span class="text-center custom_expertise_txt">{{$custom_expertise->title}}</span>
                                <span class="remove_expertise fa fa-close">remove</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="inputName3" class="col-sm-4">Facebook</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="social_link[facebook]" placeholder="" value="{{old('social_link.facebook',$user->profile->social_link['facebook'])}}">
                    {!!$errors->first('social_link.facebook','<span class="form-error">:message</span>')!!}
                </div>
            </div>
            <div class="form-group">
                <label for="inputName3" class="col-sm-4">Google Plus</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="social_link[gplus]" placeholder="" value="{{old('social_link.gplus',$user->profile->social_link['gplus'])}}">
                    {!!$errors->first('social_link.gplus','<span class="form-error">:message</span>')!!}
                </div>
            </div>
            <div class="form-group">
                <label for="inputName3" class="col-sm-4">Twitter</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="social_link[twitter]" placeholder="" value="{{old('social_link.twitter',$user->profile->social_link['twitter'])}}">
                    {!!$errors->first('social_link.twitter','<span class="form-error">:message</span>')!!}
                </div>
            </div>
            <div class="form-group">
                <label for="inputName3" class="col-sm-4">Instagram</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="social_link[instagram]" placeholder="" value="{{old('social_link.instagram',$user->profile->social_link['instagram'])}}">
                    {!!$errors->first('social_link.instagram','<span class="form-error">:message</span>')!!}
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
    $('#custom_expertise').keypress(function(e){
        if (e.keyCode === 10 || e.keyCode === 13)
        {
            e.preventDefault();
            add_cust_exp();
        }
    });
    $('#add_custom_expertise').click(function(event) {
        add_cust_exp();
        //return false;
    });
    $('#dexel-coach-expertise').on('click', '.remove_expertise', function(event) {
        event.preventDefault();
        $(this).parent().remove();
    });
    function add_cust_exp()
    {
        var expert = $.trim($('#custom_expertise').val());
        if(expert.length > 0)
        {
            $('#dexel-coach-expertise').append('<div class="col-md-12"><input name="custom_expertise[]" readonly  type="hidden" value="'+expert+'"><span class="text-center custom_expertise_txt">'+expert+'</span> <span class="remove_expertise fa fa-close"></span></div>');
            $('#custom_expertise').val('');
        }
    }
</script>
@stop

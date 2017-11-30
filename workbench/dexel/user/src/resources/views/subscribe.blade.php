<form class="form-horizontal" role="form" method="POST" id="subscribe-popup-form" >
    {{csrf_field()}}
    @if(Session::has('message'))
        <span class="help-block ">
            <strong id="subscribe-popup-message">{{Session::get('message')}}</strong>
        </span>
    @endif
    <div class="form-group formx-each">
    <br/>
        {{-- <label for="email" class="col-md-12 control-label">Email</label> --}}
        <div class="col-md-6 col-lg-4 col-lg-offset-4 col-md-offset-3">
            <input id="email" type="text" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
            {!!$errors->first('email','<span class="form-error">:message</span>')!!}
        </div>

    </div>
    <div class="form-group formx-each">
        <div class="col-md-6 col-lg-4 col-lg-offset-4 col-md-offset-3">
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{old('name')}}">
            {!!$errors->first('name','<span class="form-error">:message</span>')!!}
        </div>
    </div>
    <div class="form-group formx-each">
        <div class="col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 subscribe-pop-recaptcha">
            <?php echo Recaptcha::render(); ?>
            {!!$errors->first('g-recaptcha-response','<span class="form-error">:message</span>')!!}
        </div>
    </div>
    <div class="form-group formx-each">
        <div class="col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4  subscribe-btn-row">
            <span class="btn-primary btn-lg" id="subscribe-popup-form-btn">Submit</span>
            <span class="btn-primary btn-lg home-subscribe-cancel" >Cancel</span>
        </div>
    </div>
</form>
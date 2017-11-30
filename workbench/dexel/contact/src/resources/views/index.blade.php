@extends("web.main")
@section('content')
<!-- |===[:::::::::::::> New header section start -->
<div class="streak_header_space"></div>
    <!--<img src="{{asset('assets/web/images/stressfit_logo_text.png')}}" class="landing_logo" alt="">-->
    <div class="streak_header col-md-12">
       <div class="webx-page-title pull-right" >
           <div class="header-character pull-right">
            <div class="halo">
                    <span class="halo_ring1"></span>
                    <span class="halo_ring3"></span>
                    <span class="halo_ring4"></span>
                </div>
               <img src="{{asset('assets/web/images/header-character.png')}}" class="header-character-char" alt="">
            </div>
            <h2 class="pull-right">Get in contact</h2>
       </div>
       <div class="clearboth"></div>
        <span class="streak-header-space"></span>
    </div>
<!-- |===[:::::::::::::> New header section end -->
<div class="container-fluid">
<section class="contact-Info">
  <div class="col-md-10 col-md-offset-1 text-center dexel-heading">

          <p>Our head office is located in Melbourne - Australia, and our coaches are located all across the globe. Contact us for any information you require, and we will do our best to help you be Stress Fit.</p>

        </div>
        <section class="map-Area">
            <div class="container">
                    <div class="row">
                        <div class="col-sm-5 text-center">
                            <div class="map-Cnt">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.2915228498937!2d144.96171751535374!3d-37.83006057974941!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642aaf6044979%3A0xfb1e119ccb69fcf6!2s01%2F210+Kings+Way%2C+South+Melbourne+VIC+3205%2C+Australia!5e0!3m2!1sen!2sin!4v1492760312545" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                        </div>

                        <div class="col-sm-7 map-content">
                            <ul class="row" style="list-style-type:none">
                                <li class="col-sm-8">
                                    <address>
                                        <b>Address:</b><p>&nbsp;Suite G 01, </p><br/>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;210 Kings Way,</p><br/>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Melbourne,</p><br/>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VIC 3000 </p><br/>

                                        <b>Phone:</b><p>&nbsp;+61 400 580 195 </p><br/>
                                        <b>Email:</b><p>&nbsp;<a href="mailto:#"> info@stressfit.com</a></p>
                                        <div class="clearboth"></div>
                                    </address>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
          </section>
          <section class="contact-page">
  <div class="container">
      <div class="col-md-10 col-md-offset-1 text-center dexel-heading">
          <h2 style="text-transform: none;">Send us a Message</h2>
          <p class="lead">Use the contact form below to say hello, share with us your experience or ask us a question. </p>
          <p>StressFit is a young site, and we welcome any feedback or comments you have for us. We believe in teamwork and the good community spirit, so if you have a suggestion or have had any issues with using our website, we welcome you to write to us and we will get back to you as soon as we can.</p><br/>
          <p> Peace & Love - The StressFit Team </p>
      </div>
      <div class="clearboth"></div>
      <div class="row contact-wrap">
          <form id="main-contact-form" class="contact-form" name="contact-form" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          @if(Session::has('message'))
              <p class="form-success" style=" margin-bottom: 20px;">{{ Session::get('message') }}</p>
          @endif
            <div class="col-sm-5 col-sm-offset-1">
                <div class="form-group">
                    <label>First Name *</label>
                    <input type="text" name="fname" class="form-control"  value="{{old('fname')}}">{!!$errors->first('fname','<span class="form-error">:message</span>')!!}

                </div>
                <div class="form-group">
                    <label>Last Name *</label>
                    <input type="text" name="lname" class="form-control"  value="{{old('lname')}}">{!!$errors->first('lname','<span class="form-error">:message</span>')!!}

                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" class="form-control" value="{{old('email')}}"
                    >
                    {!!$errors->first('email','<span class="form-error">:message</span>')!!}
                </div>
                <div class="form-group">
                    <label>Phone *</label>
                    <input type="tel" class="form-control" name="phone" value="{{old('phone')}}">
                    {!!$errors->first('phone','<span class="form-error">:message</span>')!!}
                </div>
                <label>* All fields are mandatory</label>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <label>Message *</label>
                    <textarea name="message" id="message" class="form-control" rows="10" value="{{old('message')}}"></textarea>
                    {!!$errors->first('message','<span class="form-error">:message</span>')!!}
                </div>
                <div class="form-group">
                    {!!Recaptcha::render()!!}
                    {!!$errors->first('g-recaptcha-response','<span class="form-error">:message</span>')!!}
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"  type="submit" name="submit" required="required">Submit</button>
                </div>
            </div>
          </form>
      </div><!--/.row-->
  </div><!--/.container-->
</section>
</div>
@stop

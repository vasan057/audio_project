@extends("web.main")
@section('content')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/user/css/accountstyle.css')}}">
@stop

<div class="row">
   <div class="panel with-nav-tabs panel-primary">
      <div class="panel-heading">
         <div class="container ">
            <div class="row">
               <div class="col-md-8 col-sm-8 col-xs-8 col-md-offset-2">
                  <ul class="nav nav-tabs nav-justified">
                     <li class="active"><a href="#tab1primary" data-toggle="tab">Dashboard</a>
                    </li>
                    <li><a href="#tab2primary" data-toggle="tab">Buy Credit</a>
                     </li>
                     <li><a href="#tab3primary" data-toggle="tab">Gifts</a>
                     </li>
                     <li><a href="#tab4primary" data-toggle="tab">Transactions</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <div class="panel-body">
        <div class="col-md-12 col-sm-12 col-xs-12 tab-content">
           <!--Start Credit Dashboard-->
           <div class="tab-pane fadein active" id="tab1primary">
              <div class="tab-content-header text-left">
                 <label>
                 <span></span> Samples
                 </label>
              </div>
              <div class="row">
                                 <div class="dexel-customerAppheader">
                                    <div class="col-md-2 col-sm-12 col-xs-12">
                                       <img src="" alt="stressfit guru">
                                    </div>
                                    <div class="col-md-8 col-sm-12 col-xs-12 pull-right">
                                       <label class="text-left">Get 4 Credit by sending a Free Gift. </label>
                                       <p class="text-left">Hi, Welcome to stressfit, For spreading well being, and to promote the site
you have 25 free which you can send to any new user to invite them to website
for each gift you will receive 4 credits.</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="dexel-customerAppheadercount">
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                       <p class="text-left">SEND FREE GIFT (24 Remaining)</p>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                       <label class="text-right">Total credits received: <span>4</span></label>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="dexel-customerAppThemearea">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <label class="text-left">SELECT OCCATION / THEME</label>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12 pull-right">
                                       <div id="custom-search-input">
                                          <div class="input-group col-md-12">
                                             <span class="input-group-btn">
                                             <button class="btn btn-info btn-md"
                                             type="button">
                                                <i class="fa fa-search"></i>
                                             </button>
                                             </span>
                                             <input type="text" class="form-control input-md" placeholder="Search payments, purchased, history" />
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="dexel-customerAppThemeselection">
                                       <a class="active" href="javascript:void(0);">BIRTHDAY</a>
                                       <a href="javascript:void(0);">NEW YEAR</a>
                                       <a href="javascript:void(0);">CHRISTMAS</a>
                                       <a href="javascript:void(0);">MENTORING</a>
                                       <a href="javascript:void(0);">GENERAL</a>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-5 col-sm-6 col-xs-12">
                                    <div class="dexel-themePanel">
                                       <label class="text-left">ADD YOUR MESSAGE</label>
                                       <div class="dexel-themeCard">
                                          <input type="text" placeholder="Add Message here" value="" class="pull-left">
                                          <input type="text" placeholder="if extended" value="" class="pull-left" style="width:55%">
                                          <label class="pull-left text-center"><span>10</span> Credits</label>
                                          <h6 class="pull-right">From Mike</h6>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-7 col-sm-6 col-xs-12">
                                    <div class="dexel-themePanel">
                                       <label class="text-left">SEND TO</label>
                                       <div class="dexel-themeSendcard">
                                          <input type="text" placeholder="Name" value="" class="pull-left">
                                          <input type="text" placeholder="Email ID" value="" class="pull-left">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-11 col-sm-11 col-xs-12">
                                    <button id="gift-Btn">SEND GIFT</button>
                                 </div>
                                 <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="dexel-sentConfirmationPanel">
                                       <div class="col-md-3 col-sm-3 col-xs-12">
                                          <img src="" alt="avatar">
                                       </div>
                                       <div class="col-md-9 col-sm-9 col-xs-12">
                                          <label>Hi Gift Successfully sent, 4 credits added.</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
           </div>
<!--End Credit Dashboard-->
           <!--Buy Credits-->
            <div class="tab-pane fade" id="tab2primary">
               <div class="tab-content-header text-left">
                  <label>
                  <span></span> Samples
                  </label>
               </div>
               <div class="dexel-creditsContainer">
                   <div class="row">
                     <div class="col-md-3 col-sm-3 col-xs-8">
                       <div class="dexel-creditsCountpanel">
                         <h4 style="margin: 0;">Credits
                         </h4>
                         <div class="dot">
                         </div>
                         <span>
                         </span>
                         <label>300
                         </label>
                       </div>
                     </div>
                   </div>
                   <div class="dexel-creditCardcontainer">
                     <div class="row">
                       <div class="col-md-12 col-sm-12 col-xs-12">
                         <label class="text-left pull-left">BUY CREDITS
                         </label>
                         <span>select credit
                         </span>
                       </div>
                     </div>
                     <div class="row dexel-creditCardPanel">
                       <div class="col-md-5 col-sm-6 col-xs-12">
                         <div class="dexel-creditCard creditCard-1 animate-box">
                           <div class="dexel-creditCardheader">
                             <h2>Basic
                             </h2>
                             <h4>$ 10
                             </h4>
                           </div>
                           <div class="imgContent">
                           </div>
                           <label class="pull-right text-center">
                             <span>55
                             </span> CREDITS
                           </label>
                         </div>
                       </div>
                       <div class="col-md-5 col-sm-6 col-xs-12">
                         <div class="dexel-creditCard creditCard-2 animate-box">
                           <div class="dexel-creditCardheader">
                             <h2>Black
                             </h2>
                             <h4>$ 15
                             </h4>
                           </div>
                           <div class="imgContent">
                           </div>
                           <label class="pull-right text-center">
                             <span>115
                             </span> CREDITS
                           </label>
                         </div>
                       </div>
                       <div class="col-md-5 col-sm-6 col-xs-12">
                         <div class="dexel-creditCard creditCard-3 animate-box">
                           <div class="dexel-creditCardheader">
                             <h2>Silver
                             </h2>
                             <h4>$ 25
                             </h4>
                           </div>
                           <div class="imgContent">
                           </div>
                           <label class="pull-right text-center">
                             <span>255
                             </span> CREDITS
                           </label>
                         </div>
                         <div class="pull-right popular-tags">Most Popular
                         </div>
                       </div>
                       <div class="col-md-5 col-sm-6 col-xs-12">
                         <div class="dexel-creditCard creditCard-4 animate-box">
                           <div class="dexel-creditCardheader">
                             <h2>Gold
                             </h2>
                             <h4>$ 40
                             </h4>
                           </div>
                           <div class="imgContent">
                           </div>
                           <label class="pull-right text-center">
                             <span>355
                             </span> CREDITS
                           </label>
                         </div>
                       </div>
                     </div>
                     <!-- Payment Section -->
                     <div class="row">
                       <div class="dexel-Paymentpanel col-md-12 col-sm-12 col-xs-12">
                         <div class="row">
                           <div class="dexel-Paymentheader">
                             <div class="col-md-8 col-sm-8 col-xs-8">
                               <label class="text-left">Payment
                               </label>
                             </div>
                             <div class="col-md-2 col-sm-4 col-xs-4 pull-right">
                               <a href="#">
                               </a>
                               <a href="#">
                               </a>
                             </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="dexel-PaymentBuy">
                             <div class="col-md-2 col-sm-2 col-xs-2">
                               <label class="text-left">BUY
                               </label>
                             </div>
                             <div class="col-md-4 col-sm-8 col-xs-12">
                               <div class="BuycreditCard">
                                 <div class="BuycreditCardheader">
                                   <h2>Gold
                                   </h2>
                                   <h4>$ 40
                                   </h4>
                                 </div>
                                 <div class="imgContent">
                                 </div>
                                 <label class="pull-right text-center">
                                   <span>355
                                   </span> CREDITS
                                 </label>
                               </div>
                             </div>
                           </div>
                           <div class="dexel-Usecard">
                             <div class="col-md-8 col-sm-8 col-xs-12" style="border-right:1px solid #CCC;">
                               <label class="text-left">Use
                               </label>
                               <div class="dexel-useCreditcard">
                                 <div class="dexel-useCreditcardheader">
                                   <input class="pull-left" type="text">
                                   <img src="images/visa-icon.png" alt="visa">
                                 </div>
                                 <div class="dexel-useCardcontainer">
                                   <div class="row">
                                     <div class="col-md-3 col-sm-3 col-xs-6">
                                       <input class="pull-left" type="tel" value="">
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-6">
                                       <input class="pull-left" type="tel" value="">
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-6">
                                       <input class="pull-left" type="tel" value="">
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-6">
                                       <input class="pull-left" type="tel" value="">
                                     </div>
                                   </div>
                                   <div class="row">
                                     <div class="col-md-6 col-sm-6 col-xs-6">
                                       <span>
                                         <img src="images/timer.png" alt="timer">
                                       </span>
                                       <input type="text" value="">
                                     </div>
                                     <div class="col-md-6 col-sm-6 col-xs-6">
                                       <span>
                                         <img src="images/ccv.png" alt="timer">
                                       </span>
                                       <input type="text" value="">
                                     </div>
                                   </div>
                                 </div>
                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                 <button class="pull-left" id="credit-Buy"> Buy Now
                                 </button>
                               </div>
                             </div>
                             <div class="col-md-4 col-sm-4 col-xs-12">
                               <label class="text-left">Use different card
                               </label>
                               <div class="dexel-useCreditcard fade-card">
                                 <div class="dexel-useCreditcardheader">
                                   <input class="pull-left" type="text" disabled>
                                   <img src="images/visa-icon.png" alt="visa">
                                 </div>
                                 <div class="dexel-useCardcontainer">
                                   <div class="row">
                                     <div class="col-md-3 col-sm-3 col-xs-6">
                                       <input class="pull-left" type="tel" value="" disabled>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-6">
                                       <input class="pull-left" type="tel" value="" disabled>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-6">
                                       <input class="pull-left" type="tel" value="" disabled>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-6">
                                       <input class="pull-left" type="tel" value="" disabled>
                                     </div>
                                   </div>
                                   <div class="row">
                                     <div class="col-md-6 col-sm-6 col-xs-6">
                                       <span>
                                         <img src="images/timer.png" alt="timer">
                                       </span>
                                       <input type="text" value="" disabled>
                                     </div>
                                     <div class="col-md-6 col-sm-6 col-xs-6">
                                       <span>
                                         <img src="images/ccv.png" alt="timer">
                                       </span>
                                       <input type="text" value="" disabled>
                                     </div>
                                   </div>
                                 </div>
                               </div>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
                     <!-- Payment Successful Section -->
                     <div class="row">
                       <div class="dexel-Paymentpanel col-md-12 col-sm-12 col-xs-12">
                         <div class="row">
                           <div class="dexel-Paymentheader">
                             <div class="col-md-8 col-sm-8 col-xs-8">
                               <label class="text-left">Payment Successful
                               </label>
                             </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="dexel-Paymentsuccesspanel">
                             <div class="dexel-PaymentAvatarPanel" style="height:250px;">
                             </div>
                             <div class="dexel-PaymentsuccessCnt animate-box">
                               <label>Hi Thanks for purchasing gold card
                               </label>
                               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis erat odio, ac varius metus dignissim ac. Vivamus varius efficitur lectus, in rhoncus turpis convallis et.
                               </p>
                               <button>GO TO ARENA
                               </button>
                               <button>GO TO COACHES
                               </button>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
            </div>
            <!--End buy Credits-->
            <!--Gifts body --><div class="tab-pane fade" id="tab3primary">
               <div class="tab-content-header text-left">
                  <label>
                  <span></span> Samples
                  </label>
                </div>
                  <div class="tab-pane fade in active" id="tab2primary">
                  <div class="dexel-creditsContainer">
                    <div class="row">
                      <div class="col-md-3 col-sm-3 col-xs-8">
                        <div class="dexel-creditsCountpanel">
                          <h4 style="margin: 0;">Credits
                          </h4>
                          <div class="dot">
                          </div>
                          <span>
                          </span>
                          <label>655
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="dexel-creditCardcontainer">
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label class="text-left pull-left">CREATE &amp; BUY GIFT CARDS
                          </label>
                          <span class="text-right pull-right">select GIFT
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="dexel-customerAppThemearea">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="text-left">SELECT OCCATION / THEME
                          </label>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 pull-right">
                          <div id="custom-search-input">
                            <div class="input-group col-md-12">
                              <span class="input-group-btn">
                                <button class="btn btn-info btn-md" type="button">
                                  <i class="fa fa-search">
                                  </i>
                                </button>
                              </span>
                              <input type="text" class="form-control input-md" placeholder="Search payments, purchased, history">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="dexel-customerAppThemeselection">
                          <a class="active" href="javascript:void(0);">BIRTHDAY
                          </a>
                          <a href="javascript:void(0);">NEW YEAR
                          </a>
                          <a href="javascript:void(0);">CHRISTMAS
                          </a>
                          <a href="javascript:void(0);">MENTORING
                          </a>
                          <a href="javascript:void(0);">GENERAL
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="dexel-customerAppThemearea">
                        <div class="col-md-12 col-sm-12 col-sm-12">
                          <label class="text-left">SELECT WHAT TO GIFT
                          </label>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="dexel-customerAppThemeselection">
                          <a class="active" href="javascript:void(0);">CREDIT
                          </a>
                          <a href="javascript:void(0);">COURSES
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="dexel-customerAppThemearea">
                        <div class="col-md-12 col-sm-12 col-sm-12">
                          <label class="text-left">SELECT WHAT TO GIFT
                          </label>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="dexel-customerAppThemeselection">
                          <a href="javascript:void(0);">25
                          </a>
                          <a class="active" href="javascript:void(0);">55
                          </a>
                          <a href="javascript:void(0);">115
                          </a>
                          <a href="javascript:void(0);">225
                          </a>
                          <a href="javascript:void(0);">550
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-5 col-sm-6 col-xs-12">
                        <div class="dexel-themePanel">
                          <label class="text-left">ADD YOUR MESSAGE
                          </label>
                          <div class="dexel-themeCard">
                            <input type="text" placeholder="Add Message here" value="" class="pull-left">
                            <input type="text" placeholder="if extended" value="" class="pull-left" style="width:55%">
                            <label class="pull-left text-center">
                              <span>50
                              </span> Credits
                            </label>
                            <h6 class="pull-right">From Mike
                            </h6>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12 pull-right">
                        <div class="dexel-PurchaseBtn">
                          <div class="dexel-PurchaseLeft">
                          </div>
                          <label class="text-left">Purchase with card
                          </label>
                          <span class="text-left">$10
                          </span>
                          <b class="fa fa-chevron-right">
                          </b>
                        </div>
                        <div class="dexel-PurchaseBtn">
                          <div class="dexel-PurchaseLeft">
                          </div>
                          <label class="text-left">Purchase with credits
                          </label>
                          <span class="text-left">25
                          </span>
                          <b class="fa fa-chevron-right">
                          </b>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12 dexel-cerditNotification">
                        <label class="text-left">You will receive 5 credits for the spirit of gifting!
                        </label>
                      </div>
                    </div>
                    <!-- Payment Section -->
                    <div class="row">
                      <div class="dexel-Paymentpanel col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                          <div class="dexel-Paymentheader">
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <label class="text-left">Payment
                              </label>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-4 pull-right">
                              <a href="#">
                              </a>
                              <a href="#">
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="dexel-PaymentBuy">
                            <div class="col-md-2 col-sm-2 col-xs-2">
                              <label class="text-left">BUY
                              </label>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12" style="transform:scale(0.8)">
                              <div class="dexel-themeCard">
                                <input type="text" placeholder="Add Message here" value="" class="pull-left">
                                <input type="text" placeholder="if extended" value="" class="pull-left" style="width:55%">
                                <label class="pull-left text-center">
                                  <span>50
                                  </span> Credits
                                </label>
                                <h6 class="pull-right">From Mike
                                </h6>
                              </div>
                            </div>
                          </div>
                          <div class="dexel-toForm">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <label class="text-left">To
                              </label>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <input type="text" placeholder="Name" class="pull-left">
                              <input type="email" placeholder="Email" class="pull-left">
                            </div>
                          </div>
                          <div class="dexel-Usecard">
                            <div class="col-md-8 col-sm-8 col-xs-12" style="border-right:1px solid #CCC;">
                              <label class="text-left">Use
                              </label>
                              <div class="dexel-useCreditcard">
                                <div class="dexel-useCreditcardheader">
                                  <input class="pull-left" type="text">
                                  <img src="images/visa-icon.png" alt="visa">
                                </div>
                                <div class="dexel-useCardcontainer">
                                  <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                      <input class="pull-left" type="tel" value="">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                      <input class="pull-left" type="tel" value="">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                      <input class="pull-left" type="tel" value="">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                      <input class="pull-left" type="tel" value="">
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                      <span>
                                        <img src="images/timer.png" alt="timer">
                                      </span>
                                      <input type="text" value="">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                      <span>
                                        <img src="images/ccv.png" alt="timer">
                                      </span>
                                      <input type="text" value="">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <button class="pull-left" id="credit-Buy"> Buy Now
                                </button>
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <label class="text-left">Use different card
                              </label>
                              <div class="dexel-useCreditcard fade-card">
                                <div class="dexel-useCreditcardheader">
                                  <input class="pull-left" type="text" disabled>
                                  <img src="images/visa-icon.png" alt="visa">
                                </div>
                                <div class="dexel-useCardcontainer">
                                  <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                      <input class="pull-left" type="tel" value="" disabled>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                      <input class="pull-left" type="tel" value="" disabled>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                      <input class="pull-left" type="tel" value="" disabled>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                      <input class="pull-left" type="tel" value="" disabled>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                      <span>
                                        <img src="images/timer.png" alt="timer">
                                      </span>
                                      <input type="text" value="" disabled>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                      <span>
                                        <img src="images/ccv.png" alt="timer">
                                      </span>
                                      <input type="text" value="" disabled>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Payment Successful Section -->
                    <div class="row">
                      <div class="dexel-Paymentpanel col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                          <div class="dexel-Paymentheader">
                            <div class="col-md-8 col-sm-12 col-xs-12">
                              <label class="text-left">Payment Successful
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="dexel-Paymentsuccesspanel">
                            <div class="dexel-PaymentAvatarPanel" style="height:250px;">
                            </div>
                            <div class="dexel-PaymentsuccessCnt animate-box">
                              <label>You have successfully gifted
                              </label>
                              <p>For the spirit of gifting. You have received 5 credits
                              </p>
                              <button>GO TO ARENA
                              </button>
                              <button>GO TO COACHES
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

               </div><!--end gifts body-->
            </div>
            <div class="tab-pane fade" id="tab4primary">Primary 3</div>
         </div>
      </div>
   </div>
</div>
@stop
@section('javascript')
<script>
   $('.dexel-customerAppThemeselection').find('a').on('click', function(){
      $(this).parent().find('a').removeClass('active');
      $(this).addClass('active');
   });
</script>
@stop

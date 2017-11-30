<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" href="{{asset('editor/froala_style.css')}}">
   <link rel="stylesheet" href="{{asset('share/jquery.sharebox.css')}}">
   <style>
    #page{height: auto!important;}
    .footerx-bottom{ margin-top: -2px!important; }
    .social-panel li a i{ line-height: 43px; }
    .fr-view ul li{ list-style: disc outside none;
display: list-item;
margin-left: 2em;}
    .fr-view ol li{  list-style: decimal outside none;
display: list-item;
margin-left: 2em; }

.fr-view a{ color:#4285f4!important; text-decoration: underline; cursor: pointer;}
.fr-view a *{ color:#4285f4!important; }
.fr-view a:hover{ color:#8a28c2!important; text-decoration: underline; }
.fr-view a:hover *{ color:#8a28c2!important; }
    .fr-view em{ font-style: italic!important; }
   .fr-view strong{ font-weight: bold!important; }
.fr-view strong *{  font-weight: bold!important;  }
.sticky {
     position: fixed;
     top: 0;
     width: 24%;
     height: 100%;
  }



.sticky .article_style1_right_box1, .sticky .article_style1_right_box2{ height: 47%; }
.sticky .ad-content-inner{ padding-top: 20%; }

.fr-view p, .fr-view p span, .fr-view strong span, .fr-view ul li span{ line-height: 1.5em; }
@media(max-width:1024px){
  .fr-fic{ height:auto!important; }
.fr-view p span{ font-size: 19px!important; } 
 }

@media(max-width:600px){
.fr-view p span{ font-size: 16px!important; } 
 }


    </style>
</head>
<body>
<div class="fr-view">
    {!!$science->description!!}
</div>
</body>
</html>

<?php
session_start();
if(!$_SESSION['logged_in']){
    $si = "Sign-In";
    $li = "/account/?local=1";
} else {
    $si = $_SESSION['username'];
    $li = "/account/logout";
}
?>
<style>
    .brand {
        height: 120px !important;
        width: 120px !important;
        margin-left: 60px !important;
        position: absolute !important;
        background-image: url("/assets/favicon.ico");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
    .brand-mobile {
        height: 80px !important;
        width: 80px !important;
        margin-left: 60px !important;
        position: absolute !important;
        background-image: url("/assets/favicon.ico");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;

    }
    .brand-box {
        background-color: seagreen !important;
    }
    .left {
        margin-top: 2px;
        margin-left: 20px;
    }
    .right {
        margin-right:20px !important;
    }
    .jumbotron {
        background-color:silver !important;
        height: auto !important;
    }
    .jumbo {
        width:100% !important;
        padding-left: 10% !important;
        padding-right: 10% !important;
    }
    .jumbo-mobile {
        width: 100% !important;
    }
    .coursesoffered {
        background-color:seagreen !important;
        width:100% !important;
        padding-top: 5% !important;
        padding-bottom: 2% !important;
        padding-left: 10% !important;
        padding-right:10% !important;
    }
    .ssdata {
        display: none;
    }
    .jumboImage{
        max-width: 100%;
        height:400px;
        background-image: url("/assets/cover.jpg");
        background-repeat: no-repeat;
        background-position: left top;
        background-size: cover;
    }
</style>
<body>
        <!-- SplashScreen Display -->
        <div class="splashscreen valign-wrapper" id="splashscreen">
            <h3 class="valign center-block white-text">
              <center class="ssdata">
                <b>Holy Child Montessori</b><br><br>
                <font size="3">Loading Site</font>
                </center>
            </h3>
        </div>
        <a href="/">
            
            <!-- Logo for larger window and desktop -->
            <div class="hide-on-small-only">
                <div class="brand-box">
                    <div class="brand z-depth-5 hoverable hcm-logo"></div>
                </div>
            </div>
            <!-- Logo for mobile images and small windows -->
            <div class="hide-on-med-and-up">
                <div class="brand-box">
                    <div class="brand-mobile z-depth-5 hoverable hcm-logo"></div>
                </div>
            </div>

        </a>
        <nav class="<?=$primary_color?>">
            <a href="#" data-activates="mobile-demo" class="button-collapse show-on-large left"><i class="material-icons">menu</i></a>
            <a href="<?=$li?>" class="right"><?=$si?></a>            
            <a href="<?=$li?>" class="right"><i class="material-icons">person</i></a>

            <ul class="side-nav" id="mobile-demo">
                <li class="userView">
                    <div class="background">
                        <img src="/assets/thumb1.png" width="100%">
                    </div>
                    <p><b>Welcome Montessorian!</b></p>
                </li>
                <li><a href="/pages/aboutus">About Us</a></li>
                <li><a href="/pages/admissions">Admissions</a></li>
                <li><a href="/pages/alumni">Alumni</a></li>
                <li><div class="divider"></div></li>
                <li><a href="/pages/schoolofexcellence">School of Excellence</a></li>
                <li><a href="/pages/continuingeducation">School of Continuing Education</a></li>
                <li><a href="/pages/onlineschool">Online School</a></li>
                <li><div class="divider"></div></li>
                <li><a href="/pages/library">School Library</a></li>
                <li><a href="/pages/research">Research and Publication</a></li>
                <li><a href="/pages/community">Community Engagement</a></li>
                <li><div class="divider"></div></li>
                <li><a href="<?=$li?>"><?=$si?></a></li>
            </ul>

        </nav>
        
        <!-- Jumbotron for larger window and desktop -->
        <div class="jumbotron hide-on-small-only">
            <div class="jumboImage jumbo"></div>
        </div>

        <!-- Jumbotron for mobile images and small windows -->
        <div class="jumbotron-mobile hide-on-med-and-up">
            <div class="jumboImage jumbo-mobile"></div>
        </div>

        <div class="container">
            <br>
            <br>
            <h4 class="seagreen-text"><b>Why Choose Montessori?</b></h4><br><br>
            <div class="cards-container">
                <div class="col s4 reveal">
                    <center class="seagreen-text">
                        <div class="hide-on-small-only">
                            <i class="large material-icons">public</i>
                            <h5 class='truncate'><b>World-Class</b></h5>
                        </div>
                        <div class="hide-on-med-and-up">
                            <i class="medium material-icons">public</i>
                            <p class='truncate'><font size='4'><b>World-Class</b></font></p>
                        </div>
                    <p class="grey-text text-darken-2">Our world-class curriculum helps your child to be ready for life wherever they maybe.</p>
                    </center>
                </div>
                <div class="col s4 reveal">
                    <center class="seagreen-text">
                        <div class="hide-on-small-only">
                            <i class="large material-icons">school</i>
                            <h5 class='truncate'><b>25 Years<br>in the Industry</b></h5>
                        </div>
                        <div class="hide-on-med-and-up">
                            <i class="medium material-icons">school</i>
                            <p class='truncate'><font size='4'><b>25 Years<br>in the Industry</b></font></p>
                        </div>
                   <p class="grey-text text-darken-2">We have mastered the best approach for your child's education.</p>
                    </center>
                </div>
                <div class="col s4 reveal">
                    <center class="seagreen-text">
                        <div class="hide-on-small-only">
                            <i class="large material-icons">local_atm</i>
                            <h5 class='truncate'><b>Affordable</b></h5>
                        </div>
                        <div class="hide-on-med-and-up">
                            <i class="medium material-icons">local_atm</i>
                            <p class='truncate'><font size='4'><b>Affordable</b></font></p>
                        </div>
                    <p class="grey-text text-darken-2">The only school that doesn't sacrifice quality for affordability.</p>
                    </center>
                </div>               
                 <div class="col s4 reveal">
                    <center class="seagreen-text">
                        <div class="hide-on-small-only">
                            <i class="large material-icons">cloud</i>
                            <h5 class='truncate'><b>School<br>in the Cloud</b></h5>
                        </div>
                        <div class="hide-on-med-and-up">
                            <i class="medium material-icons">cloud</i>
                            <p class='truncate'><font size='4'><b>School<br>in the Cloud</b></font></p>
                        </div>
                    <p class="grey-text text-darken-2">Know your child's progress whenever, wherever in any device.</p>
                    </center>
                </div>
               
                <div class="col s4 reveal">
                    <center class="seagreen-text">
                        <div class="hide-on-small-only">
                            <i class="large material-icons">group</i>
                            <h5 class='truncate'><b>Caring<br>Community</b></h5>
                        </div>
                        <div class="hide-on-med-and-up">
                            <i class="medium material-icons">group</i>
                            <p class='truncate'><font size='4'><b>Caring<br>Community</b></font></p>
                        </div>
                    <p class="grey-text text-darken-2">Your child is treated like family in a community that cares for one another.</p>
                    </center>
                </div>
                <div class="col s4 reveal">
                    <center class="seagreen-text">
                        <div class="hide-on-small-only">
                            <i class="large material-icons">thumb_up</i>
                            <h5 class='truncate'><b>Highly<br>Recommended</b></h5>
                        </div>
                        <div class="hide-on-med-and-up">
                            <i class="medium material-icons">thumb_up</i>
                            <p class='truncate'><font size='4'><b>Highly<br>Recommended</b></font></p>
                        </div>
                    <p class="grey-text text-darken-2">We are a well-known school that provides quality education since 1992.</p>
                    </center>
                </div>
            </div>
            <br>
        </div>

        <div class="coursesoffered">
            <style>
                .kinder {
                    background-image: url("assets/thumb2.png");
                    max-width: 100%;
                    height: 180px;
                    background-repeat: no-repeat;
                    background-position: center;
                    background-size: cover;
                }
                .tutorial {
                    background-image: url("assets/thumb1.png");
                    max-width: 100%;
                    height: 180px;
                    background-repeat: no-repeat;
                    background-position: center;
                    background-size: cover;
                }
            </style>
            <h4 class="white-text"><b>Courses Offered</b></h4><br>
            <div class="cards-container">
                
                <div class="col s6 reveal">
                    <div class="card hoverable">
                        <div class="card-img">
                            <div class="kinder"></div>
                        </div>
                        <div class="card-content">
                            <center class="seagreen-text"><h5 class='truncate'><b>Kindergarten</b></h5></center>
                        </div>
                    </div>
                </div>
                <div class="col s6 reveal">
                    <div class="card hoverable">
                        <div class="card-img">
                            <div class="tutorial"></div>
                        </div>
                        <div class="card-content">
                            <center class="seagreen-text"><h5 class='truncate'><b>Tutorial Services</b></h5></center>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- Courses Offered -->

        <div class="container">
        <br>
        <br>
        <h4 class="seagreen-text"><b>Contact Us</b></h4><br>
        <div class="cards-container">
            <div class="col s6 reveal">
                <a class="btn btn-large btn-block blue waves-effect waves-light" href="https://fb.com/montessorians"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
            </div>
            <div class="col s6 reveal">
                <a class="btn btn-large btn-block light-blue waves-effect waves-light" href="https://twitter.com/hcmofgasak"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
            <div class="col s6 reveal">
                <a class="btn btn-large btn-block red waves-effect waves-light" href="mailto:hcmontessori@gmail.com"><i class="fa fa-google" aria-hidden="true"></i></a>
            </div>
            <div class="col s6">
            </div>
        </div>
        
        </div><!-- container -->
        <br><br><br>
        <iframe
         width="100%"
         height="300"
         frameborder="0" style="border:0"
         src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCuNfQSkwl85bk38k4de_QR-DwBGL-069o&q=Holy+Child+Montessori,+Carnation+St,+Navotas,+Metro+Manila,+Philippines" allowfullscreen>
        </iframe>

<footer class="page-footer blue-grey darken-1">
	<div class="container footercont">
        <div class="row">
		<div class="col s4">
			<h5 class="white-text">Get in Touch</h5>
			<a class="white-text" href="http://fb.com/montessorians">Facebook</a><br>
			<a class="white-text" href="http://twitter.com/hcmofgasak">Twitter</a><br>
			<a class="white-text" href="mailto:hcmontessori@gmail.com">E-Mail</a>
		</div>
	<div class="col s4">
		<h5 class="white-text">Quick Links</h5>
		<a href="account" class="white-text">Sign-In</a><br>
		<a href="https://holychildmontessori.edu20.org" class="white-text">Online School</a><br>
		<a href="alumni" class="white-text">Alumni Portal</a>
	</div>
    <div class="col s4">
        <h5 class="white-text">About Us</h5>
        <p class="white-text">
            We are an institution located at #3 Ilang-Ilang St., Merville, Tanza Navotas City. We are providing quality education since 1992.
        </p>
    </div>
    </div><!--row-->
	</div><!--padding-->
    <br>
	<div class="footer-copyright">
		<div class="container">
			Copyright <?=date("Y");?> <?=$site_title?>
		</div>
	</div>
</footer>
</body>
<script>
    // Initialization
    $(document).ready(function(){
        $("meta[name='theme-color']").attr("content", "seagreen");
        initSplashScreen();
        $(".hcm-logo").hide();
        window.sr = ScrollReveal();
        sr.reveal('.reveal', {reset: false});
        $(".button-collapse").sideNav({closeOnClick: true});
        $(".hcm-logo").slideDown(10000);

    }).keypress(function(e){
		var key = e.which;
		if(key == 13){
			window.location.replace("account/?local=1");
		}
	});

    function initSplashScreen(){
        var splashscreen = localStorage.getItem("hcm-splashscreen");
        if(!splashscreen){
            var time = 5000;
            $(".ssdata").show();
            splash(time);
            localStorage.setItem("hcm-splashscreen", "1");
        } else {
            $("#splashscreen").fadeOut();
        }
    }
    function splash(param){
        var time = param;
        setTimeout(function(){
            $("#splashscreen").fadeOut();
        },time);
    }
</script>
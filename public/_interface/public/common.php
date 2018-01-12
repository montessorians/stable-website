<?php
// Start Session
session_start();

// Check if logged in
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
        background-image: url("/assets/imgs/logo.jpg");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    .brand-mobile {
        height: 80px !important;
        width: 80px !important;
        margin-left: 60px !important;
        position: absolute !important;
        background-image: url("/assets/imgs/logo.jpg");
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
        background-color: seagreen !important;
        width:100% !important;
        padding-top: 5% !important;
        padding-bottom: 4% !important;
        padding-left: 10% !important;
        padding-right:10% !important;
    }

    .ssdata {
        display: none;
    }
    
    .jumboImage{
        max-width: 100%;
        height:400px;
        background-image: url("/assets/imgs/cover.jpg");
        background-repeat: no-repeat;
        background-position: left top;
        background-size: cover;
    }
</style>
<body>
        <!-- SplashScreen Display -->
        <div class="splashscreen valign-wrapper" id="splashscreen">
            <h3 class="valign center-block white-text">
                <noscript>
                    <b class="white-text">
                    <center>
                        <h4>Sorry!</h4>
                        <h5>This web application requires Javascript to be turned-on.</h5>
                    </center>
                    </b>
                </noscript>

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
                        <img src="/assets/imgs/thumb1.png" width="100%">
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
                
            <div id="app">
                <div class="row hide-on-med-and-up">
                    <mobile-choose
                        icon="public"
                        title="World-Class"
                        content="Our world-class curriculum helps your child to be ready for life wherever they maybe.">
                    </mobile-choose>
                    <mobile-choose
                        icon="school"
                        title="25 Years in the Industry"
                        content="We have mastered the best approach for your child's education.">
                    </mobile-choose>
                    <mobile-choose
                        icon="local_atm"
                        title="Affordable"
                        content="The only school that doesn't sacrifice quality for affordability.">
                    </mobile-choose>
                    <mobile-choose
                        icon="cloud"
                        title="School in the Cloud"
                        content="Know your child's progress whenever, wherever in any device.">
                    </mobile-choose>
                    <mobile-choose
                        icon="group"
                        title="Caring Community"
                        content="Your child is treated like family in a community that cares for one another.">
                    </mobile-choose>
                    <mobile-choose
                        icon="thumb_up"
                        title="Highly Recommended"
                        content="We are a well-known school that provides quality education since 1992.">
                    </mobile-choose>
                </div>

                <div class="hide-on-small-only">

                <div class="row">
                        <choose
                            icon="public"
                            title="World-Class"
                            content="Our world-class curriculum helps your child to be ready for life wherever they maybe.">
                        </choose>
                        <choose
                            icon="school"
                            title="25 Years in the Industry"
                            content="We have mastered the best approach for your child's education.">
                        </choose>
                </div>
                <div class="row">
                        <choose
                            icon="local_atm"
                            title="Affordable"
                            content="The only school that doesn't sacrifice quality for affordability.">
                        </choose>
                        <choose
                            icon="cloud"
                            title="School in the Cloud"
                            content="Know your child's progress whenever, wherever in any device.">
                        </choose>
                </div>
                <div class="row">
                        <choose
                            icon="group"
                            title="Caring Community"
                            content="Your child is treated like family in a community that cares for one another.">
                        </choose>
                        <choose
                            icon="thumb_up"
                            title="Highly Recommended"
                            content="We are a well-known school that provides quality education since 1992.">
                        </choose>
                    </div>

                </div>                    
            </div>
                
        <br>
        </div>

        <div class="coursesoffered">
            <style>
                .kinder {
                    background-image: url("assets/imgs/thumb2.png");
                    max-width: 100%;
                    height: 180px;
                    background-repeat: no-repeat;
                    background-position: center;
                    background-size: cover;
                }
                .tutorial {
                    background-image: url("assets/imgs/thumb1.png");
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
                    <div class="card hoverable z-depth-3">
                        <div class="card-img">
                            <div class="kinder"></div>
                        </div>
                        <div class="card-content">
                            <center class="seagreen-text"><h5 class='truncate'><b>Kindergarten</b></h5></center>
                        </div>
                    </div>
                </div>
                <div class="col s6 reveal">
                    <div class="card hoverable z-depth-3">
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
            <a class="tooltipped btn btn-large blue waves-effect waves-light hoverable" data-position="top" data-tooltip="Facebook" href="https://fb.com/montessorians"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
            <a class="tooltipped btn btn-large light-blue waves-effect waves-light hoverable" data-position="top" data-tooltip="Twitter" href="https://twitter.com/hcmofgasak"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a class="tooltipped btn btn-large red waves-effect waves-light hoverable" data-position="top" data-tooltip="GMail" href="mailto:hcmontessori@gmail.com"><i class="fa fa-google" aria-hidden="true"></i></a>
        </div><!-- container -->
        <br><br><br>
        <iframe
         width="100%"
         height="300"
         frameborder="0"
         style="border:0"
         src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCuNfQSkwl85bk38k4de_QR-DwBGL-069o&q=Holy+Child+Montessori,+Carnation+St,+Navotas,+Metro+Manila,+Philippines" allowfullscreen>
        </iframe>

<footer class="page-footer blue-grey darken-1">
	<div class="container footercont">
        <div class="row">
		<div class="col s4">
			<h5 class="white-text">Get in Touch</h5>
			<a class="white-text" href="https://fb.com/montessorians" target="_blank" rel="noopener">Facebook</a><br>
			<a class="white-text" href="https://twitter.com/hcmofgasak" target="_blank" rel="noopener">Twitter</a><br>
			<a class="white-text" href="mailto:hcmontessori@gmail.com" target="_blank" rel="noopener">E-Mail</a>
		</div>
	<div class="col s4">
		<h5 class="white-text">Quick Links</h5>
		<a href="account" class="white-text">Sign-In</a><br>
		<a href="https://holychildmontessori.edu20.org" class="white-text"  target="_blank" rel="noopener">Online School</a><br>
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
			Copyright <?=date("Y");?>. <?=$site_title?>. All Rights Reserved.
		</div>
	</div>
</footer>
</body>
<script type="text/javascript">
// Initialization
$(document).ready(function(){

    $("meta[name='theme-color']").attr("content", "seagreen");
    initSplashScreen();
    $(".hcm-logo").hide();
    window.sr = ScrollReveal();
    sr.reveal('.reveal', {reset: false});
    $(".button-collapse").sideNav({closeOnClick: true});
    $(".hcm-logo").slideDown(10000);
    $('.tooltipped').tooltip({delay: 50});

}).keypress(function(e){

    var key = e.which;

    if(key == 13){

        window.location.replace("account/?local=1");

    }

});

/*
    initSplashScreen
    Check if splashscreen data will be shown or not
*/
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

/*
    splash
    Splashscreen handler
 */
function splash(param){
    var time = param;
    setTimeout(function(){
        $("#splashscreen").fadeOut();
    },time);
}

Vue.component('mobile-choose',{
    props:['icon','title','content'],
    template: `
        <div class="col s12 reveal">
            <center class="seagreen-text">
                <i class="medium material-icons">{{icon}}</i>
                <h5 class="truncate"><b>{{title}}</b></h5>
                <p class="grey-text text-darken-2">{{content}}</p>
            </center>
        </div>
    `
});

Vue.component('choose',{
    props:['icon','title','content'],
    template: `
        <div class="col s6 reveal">
            <center class="seagreen-text">
                <i class="large material-icons">{{icon}}</i>
                <h5 class="truncate"><b>{{title}}</b></h5>
                <p class="grey-text text-darken-2">{{content}}</p>
            </center>
        </div>
    `    
});

new Vue({
    el: '#app'
})
</script>

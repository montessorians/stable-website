
    <!--
      Meta Tags
      These Meta tags are important in rendering the page
      and for robots to determine the information and look of
      the page.
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="<?=$theme_color?>">
    <link rel="manifest" href="/manifest.json">

    <!--
      Critical User Safety Scripts
      These are important in securing both the website and
      the user. These may not work along with the other scripts
      needed to render the page if javascript is disabled.
    -->
    <script type="text/javascript">
	    console.error(
        "%c\n\nHoly Child Montessori\n\n This is meant for developer's use only. If someone told you to access this tool, they might be able to gain access to your account and steal personal information.\n\nVisit https://fb.com/montessorians for information.\n\n\n",
        "color: red; padding-left:2%; font-size: x-large; text-align:center"
        );
    </script>

    <!--
      CSS
      These gives the page the design that you see when
      it is rendered on the browser.
    -->
    <link
      rel="stylesheet"
      href="/assets/iconfont/material-icons.css">
    <!--link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css"-->
      <link
      rel="stylesheet"
      href="/assets/materialize/css/materialize-0.98.1.min.css">
    <link
      rel="stylesheet"
      href="/assets/custom-styles.css">
    <link
      rel="stylesheet"
      href="/assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--
      Javascripts
      These are necessary to make the page interactive.
      The site may not render or even work well with
      javascript turned off.
    -->
    <script
      type="text/javascript"
      src="/assets/vue.min.js">
    </script>
    <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous">
    </script>
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js">
    </script>
    <!--script
      type="text/javascript"
      src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.min.js">
    </script-->
    <script
      type="text/javascript"
      src="/assets/scrollreveal.min.js">
    </script>

    <!--
      Google Analytics
      Required in determining the page's reach and audience.
    -->
    <script type="text/javascript">
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-79559064-1', 'auto');
      ga('send', 'pageview');
    </script>
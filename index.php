<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IDTEST - Pale Blue Consulting</title>

    <link href="reset.css" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,600" type="text/css" rel="stylesheet">
    <link href="main.css" rel="stylesheet">
    <!-- Adding additional parameters to alter behaviour in Heroku console  -->
    <meta name="salesforce-community" content="https://<?php echo getenv('SALESFORCE_COMMUNITY_URL'); ?>">
    <meta name="salesforce-client-id" content="<?php echo getenv('SALESFORCE_CLIENT_ID'); ?>">
    <meta name="salesforce-redirect-uri"
          content="https://<?php echo getenv('SALESFORCE_HEROKUAPP_URL'); ?>/_callback.php">
    <meta name="salesforce-mode" content="<?php echo getenv('SALESFORCE_MODE'); ?>">
    <meta name="salesforce-namespace" content="<?php echo getenv('SALESFORCE_NAMESPACE'); ?>">
    <meta name="salesforce-target" content="#pbc-sign-in-link">
    <meta name="salesforce-save-access-token" content="true">
    <meta name="salesforce-forgot-password-enabled"
          content="<?php echo getenv('SALESFORCE_FORGOT_PASSWORD_ENABLED'); ?>">
    <meta name="salesforce-self-register-enabled" content="<?php echo getenv('SALESFORCE_SELF_REGISTER_ENABLED'); ?>">
    <meta name="salesforce-login-handler" content="onLogin">
    <meta name="salesforce-logout-handler" content="onLogout">
    <meta name="salesforce-cache-max-age" content="<?php echo getenv('SALESFORCE_CACHE_MAX_AGE'); ?>">
    <!-- <meta name="salesforce-logout-on-browser-close" content="<?php echo getenv('SALESFORCE_LOGOUT_ON'); ?>">
    <meta name="salesforce-mask-redirects" content="<?php echo getenv('SALESFORCE_MASK_REDIR'); ?>">-->


    <meta name="salesforce-self-register-starturl-enabled"
          content="<?php echo getenv('SALESFORCE_REG_STARTURL_ENABLED'); ?>">
          <meta name="salesforce-expid" content="<?php echo getenv('SALESFORCE_EXPID'); ?>">
    <link href="https://<?php echo getenv('SALESFORCE_COMMUNITY_URL'); ?>/servlet/servlet.loginwidgetcontroller?type=css"
          rel="stylesheet" type="text/css"/>
    <script src="https://<?php echo getenv('SALESFORCE_COMMUNITY_URL'); ?>/servlet/servlet.loginwidgetcontroller?type=javascript_widget"
            async defer></script>
</head>

<body>
<div id="pbc-sign-in-link" style="position: absolute; top: 20px;right: 20px;"></div>
<header>
    <div class="masthead-elements-row-1">
        <div class="element-left"></div>
        <div class="element-middle">
            <img class="logo" src="images/branding/pbc-logo.jpg" alt="Pale Blue Consulting">
            <br>
            <span class="logo-text">Pale Blue Consulting</span>
        </div>
        <div class="element-right">
        </div>
    </div>
</header>

<footer>

    <div class="trailer-logo">
        <img class="logo" src="images/branding/pbc-logo.jpg" alt="Fix">
        <br>
        <span class="logo-text">Pale Blue Consulting</span>
    </div>

    <div class="trailer-links">
        <ul class="internal-links">
            <li><a href="https://heroku.github.io/fix">About</a></li>
            <li><a href="https://heroku.github.io/fix">Support</a></li>
            <li><a href="https://heroku.github.io/fix">Contact Us</a></li>
        </ul>
        <ul class="social-links">
            <li><a href="#">
                    <img class="social-logo" src="images/social/twitter.png" alt="">
                    <span class="social-verb">Follow on</span>
                    <span class="social-name">Twitter</span></a></li>
            <li><a href="#">
                    <img class="social-logo" src="images/social/facebook.png" alt="">
                    <span class="social-verb">Like Us on</span>
                    <span class="social-name">Facebook</span></a></li>
            <li><a href="#">
                    <img class="social-logo" src="images/social/instagram.png" alt="">
                    <span class="social-verb">Follow on</span>
                    <span class="social-name">Instagram</span></a></li>
        </ul>
    </div>

</footer>


<script>


    function onLogin(identity) {

        var targetDiv = document.querySelector(SFIDWidget.config.target);

        var avatar = document.createElement('a');
        avatar.href = "javascript:showIdentityOverlay();";


        var img = document.createElement('img');
        img.src = identity.photos.thumbnail;
        img.className = "sfid-avatar";

        var username = document.createElement('span');
        username.innerHTML = identity.username;
        username.className = "sfid-avatar-name";

        var iddiv = document.createElement('div');
        iddiv.id = "sfid-identity";

        avatar.appendChild(img);
        avatar.appendChild(username);
        iddiv.appendChild(avatar);

        targetDiv.innerHTML = '';
        targetDiv.appendChild(iddiv);

        var aero = document.getElementById("aero_link");
        aero.href = "/datasheets/AeroPress-Instr-English-Rev.-D2.pdf";
        aero.innerHTML = 'Datasheet';

        var reactor = document.getElementById("reactor_link");
        reactor.href = "/datasheets/Reactor_StovInst_EURO_EN.pdf";
        reactor.innerHTML = 'Datasheet';

        var chemex = document.getElementById("chemex_link");
        chemex.href = "/datasheets/2014_ChemexBrewGuide.pdf";
        chemex.innerHTML = 'Datasheet';

    }


    function showIdentityOverlay() {

        var lightbox = document.createElement('div');
        lightbox.className = "sfid-lightbox";
        lightbox.id = "sfid-login-overlay";
        lightbox.setAttribute("onClick", "SFIDWidget.cancel();");

        var wrapper = document.createElement('div');
        wrapper.id = "identity-wrapper";
        wrapper.onclick = function (event) {
            event = event || window.event // cross-browser event

            if (event.stopPropagation) {
                // W3C standard variant
                event.stopPropagation()
            } else {
                // IE variant
                event.cancelBubble = true
            }
        }

        var content = document.createElement('div');
        content.id = "sfid-content";

        var community = document.createElement('a');
        var commURL = document.querySelector('meta[name="salesforce-community"]').content;
        community.href = commURL;
        community.innerHTML = "Go to the Community";
        community.setAttribute("style", "float:left");
        content.appendChild(community);


        var logout = document.createElement('a');
        logout.href = "javascript:SFIDWidget.logout();SFIDWidget.cancel();";
        logout.innerHTML = "logout";
        logout.setAttribute("style", "float:right");
        content.appendChild(logout);

        var t = document.createElement('div');
        t.id = "sfid-token";
        t.className = "sfid-mb24";

        var p = document.createElement('pre');
        p.innerHTML = JSON.stringify(SFIDWidget.openid_response, undefined, 2);
        t.appendChild(p);

        content.appendChild(t);


        wrapper.appendChild(content);
        lightbox.appendChild(wrapper);

        document.body.appendChild(lightbox);

    }


    function onLogout() {
        SFIDWidget.init();

        var aero = document.getElementById("aero_link");
        aero.href = "#";
        aero.innerHTML = 'Login for more info';

        var reactor = document.getElementById("reactor_link");
        reactor.href = "#";
        reactor.innerHTML = 'Login for more info';

        var chemex = document.getElementById("chemex_link");
        chemex.href = "#";
        chemex.innerHTML = 'Login for more info';

    }


</script>

</body>
</html>
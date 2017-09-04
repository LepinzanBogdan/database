<?php include_once("head.php"); ?>

<body class="login">
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <form class="login-form" action="<?php echo URL_SITE; ?>index.php?action=UserController_submitLogin" method="post">
            <h3 class="form-title">Sign In</h3>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>
			Enter any username and password. </span>
            </div>
            <input class="form-control form-control-solid placeholder-no-fix" type="hidden" autocomplete="off" name="id_user1"
                   value="<?php
                         if(isset($_SESSION['id_user1'])){
                             echo $_SESSION['id_user1'];
                         }
                   ?>"/>
            <input class="form-control form-control-solid placeholder-no-fix" type="hidden" autocomplete="off" name="id_user2"
                   value="<?php
                   if(isset($_SESSION['id_user2'])){
                       echo $_SESSION['id_user2'];
                   }
                   ?>"/>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Username</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success uppercase">Login</button>
            </div>

            <div class="create-account">
                <p>
                    <a href="<?php echo URL_SITE;?>register" id="register-btn" class="uppercase">Create an account</a>
                </p>
            </div>

        </form>
        <!-- END LOGIN FORM -->

    </div>
</body>

<?php include_once("footer.php"); ?>
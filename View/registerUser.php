<?php include_once("head.php"); ?>

    <div class="portlet box red">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Register
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form id='formArticle' action="<?php echo URL_SITE; ?>index.php?action=UserController_createAccount" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-4">
                            <input type="text" name="username" class="form-control input-circle" placeholder="Username" value="<?php if(isset($this->parameters{'user'})) {echo $this->parameters{'user'}['username'];} ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Password</label>
                        <div class="col-md-4">
                            <input type="password" name="password" class="form-control input-circle" placeholder="Password" value="<?php if(isset($this->parameters{'user'})) {echo $this->parameters{'user'}['password'];} ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Age</label>
                        <div class="col-md-4">
                            <input type="text" name="age" class="form-control input-circle" placeholder="Age" value="<?php if(isset($this->parameters{'user'})) {echo $this->parameters{'user'}['age'];} ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Role</label>
                        <div class="col-md-4">
                            <input type="text" name="role" class="form-control input-circle" placeholder="Role" value="<?php if(isset($this->parameters{'user'})) {echo $this->parameters{'user'}['role'];} ?>">
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-circle blue">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
<?php include_once("footer.php") ?>
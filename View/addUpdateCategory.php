<?php include_once("head.php"); ?>

    <div class="portlet box red">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Edit
            </div>
            <div class="tools">
                <p><i class="fa fa-user"></i></p><?php echo $_SESSION['login_user'];?> </p>
                <p><a href = "<?php echo URL_SITE; ?>index.php?action=UserController_logout" style="color : black;">Sign Out</a></p>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form id='formCategory' action="<?php echo URL_SITE; ?>index.php?action=ArticleController_actionSaveCategory" class="form-horizontal" method="post" enctype="multipart/form-data">
                <input type="text" name="id" class="form-control input-circle hidden" placeholder="Enter text" value="<?php if(isset($this->parameters{'idCategory'})) { echo $this->parameters{'category'}['id'];} ?>">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-4">
                            <input type="text" name="name" class="form-control input-circle" placeholder="Enter text" value="<?php if(isset($this->parameters{'idCategory'})) {echo $this->parameters{'category'}['name'];} ?>">
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
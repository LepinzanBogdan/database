<?php include_once("head.php"); ?>

    <div class="portlet box red">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Add or Edit
            </div>
            <div class="tools">
                <p><i class="fa fa-user"></i> <?php echo $_SESSION['login_user'][$this->id_user];?> </p>
                <p><a href = "login.php" style="color : black;">Sign Out</a></p>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form id='formArticle' action="<?php echo URL_SITE; ?>index.php?action=ArticleController_actionSaveArticle&id_user=<?php echo $this->id_user; ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                <input type="text" name="id" class="form-control input-circle hidden" placeholder="Enter text" value="<?php if(isset($this->parameters{'article'})) {echo $this->parameters{'article'}['id'];} ?>">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Title</label>
                        <div class="col-md-4">
                            <input type="text" name="title" class="form-control input-circle" placeholder="Enter text" value="<?php if(isset($this->parameters{'article'})) {echo $this->parameters{'article'}['title'];} ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Short Description</label>
                        <div class="col-md-4">
                            <input type="text" name="short_description" class="form-control input-circle" placeholder="Short Description" value="<?php if(isset($this->parameters{'article'})) {echo $this->parameters{'article'}['short_description'];} ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Text</label>
                        <div class="col-md-4">
                            <textarea type="text" name="text_article" class="form-control input-circle" placeholder="Text-Article" ><?php if(isset($this->parameters{'article'})) {echo $this->parameters{'article'}['text_article'];} ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Image</label>
                        <div class="col-md-4 fileupload-buttonbar">
                                <span class="btn fileinput-button">
								    <input type="file" name="image[]" multiple="">
								</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Categories</label>
                        <div class="col-md-4">
                            <?php
                            echo "<select name='categories[]' multiple class='form-control'>";
                            if(isset($this->parameters{'article'})) {
                                foreach ($this->categories as $value) {
                                    if(in_array($value['id'],$this->idCategories)) {
                                        echo "<option value='" . $value['id'] . "' selected>" . $value['name'] . "</option>";
                                    }else {
                                        echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                                    }
                                }
                            }else {
                                foreach ($this->categories as $value) {
                                    echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                                }
                            }
                            echo "</select>";
                            ?>
                            <span class="help-block">Press ctrl for selected more categories. </span>
                        </div>
                    </div>
                    <div class="form-group last">
                        <label class="col-md-3 control-label">Visible</label>
                        <div class="col-md-1">
                            <input type="hidden" name="visible" value="0">
                            <input type='checkbox' name='visible' value='1'>
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
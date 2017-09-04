<?php include_once("head.php"); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-table"></i>Articles Table
                    </div>
                    <div class="tools">
                        <p><i class="fa fa-user"></i> <?php echo $_SESSION['login_user'][$_SESSION['id_user2']];?> </p>
                        <p><a href = "<?php echo URL_SITE; ?>index.php?action=UserController_logout&id_user=<?php echo $this->id_user;?>" style="color : black;">Sign Out</a></p>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a id="sample_editable_1_new" class="btn blue" href="<?php echo URL_SITE; ?>category-add-edit/<?php echo $_GET['id_user']; ?>">
                                        Add New <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($this->categories as $key => $value){
                            echo "<tr>
                                        <td class='center'>
                                            {$value['name']}
                                        </td>
                                        <td>
                                            <a class='edit' href='" . URL_SITE . "category-add-edit/{$value['id']}/{$_GET['id_user']}'>
                                                    Edit </a>
                                             <a class='deleteCategory' id='".$value['id']."' class='delete'>
                                                    Delete </a>
                                           </td>
                                    </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include_once("footer.php") ?>
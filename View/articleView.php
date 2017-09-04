<?php include_once("head.php"); ?>
<?php include_once("category.php"); ?>


<?php
foreach ($this->articles as $key => $value) {
    echo "<div class='col-md-2 col-sm-1 ' style='height: 300px;' >
            <div class='mix-inner' >
                <img class='img-responsive' src = '" . ASSETS_PATH . "admin/pages/media/works/img1.jpg' alt = '' >
                    <div class='mix-details' >
                        <h6 > {$value['title']} </h6 >
                        <h6> <i class='fa fa-calendar'></i> {$value['date']} <i class='fa fa-user'> {$value['vizualizari']}</i> <i class='fa fa-star-o'> {$value['rating']}</i></h6>
                    </div >
                </div >
        </div >";
}
?>


<?php include_once("footer.php"); ?>
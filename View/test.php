<?php include_once("head.php"); ?>

<?php
foreach ($this->articlesRandom as $key => $value) {
    echo "<div class='recent-work-item'>";
    echo "<em>
                                <img src='" . ASSETS_PATH . "frontend/pages/img/works/img1.jpg' alt='Amazing Project' class='img-responsive'>
                                <a href='" . URL_SITE . "/show-details-article/{$value['id_article']}/{$value['id_category']}' class='fancybox-button' title='Project Name #1' data-rel='fancybox-button'><i class='fa fa-search'></i></a>
                              </em>";
    echo "</div>";
}
?>

<?php include_once("footer.php") ?>
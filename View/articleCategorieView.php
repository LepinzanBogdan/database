<?php include_once("head.php"); ?>

<?php include_once("category.php"); ?>


    <div class="col-md-9 col-sm-9 blog-posts">

        <hr class="blog-post-sep">
        <div class="row">
            <?php
            if (isset($this->parameters['articlesCategory'])) {
                foreach ($this->articlesCategory as $key => $value)
                    echo "<div class='col-md-6 col-sm-8 margin-bottom-20'>
                        <h2><a href='" . URL_SITE . "/show-details-article/{$value['id_article']}/{$value['id_category']}'>" . $value['title'] . "</a></h2>
                        <ul class='blog-info''>
                            <li><i class='fa fa-calendar'></i>{$value['date']}</li>
                            <li><i class='fa fa-user'></i> {$value['vizualizari']}</li>
                            <li><i class='fa fa-star-o'></i> {$value['rating']}</li>
                        </ul>
                    <p>{$value['short_description']}</p>
                    <p>{$value['text_article']}</p>
                    </div>
                    <div class='col-md-2 col-sm-4 margin-bottom-20'>
                        <img class='img-responsive' alt='' src='" . ASSETS_PATH . "frontend/pages/img/works/img4.jpg'>
                    </div>";
            } else {
                echo "Articles doesn't exist";
            }
            ?>
        </div>

        <hr class="blog-post-sep">
        <ul class="pagination" style="margin-left: 400px;">
            <?php
            $prevPage = $_GET['page'] - 1;
            $nextPage = $_GET['page'] + 1;
            if ($_GET['page'] != 1) {
                echo "<li><a href = '{$prevPage}'>Prev</a></li>";
            }
            if (isset($this->parameters['numberArticles'])) {
                if ($this->numberArticles % 5 == 0)
                    $comparePage = $this->numberArticles / 5 + 1;
                else
                    $comparePage = $this->numberArticles / 5;
                if ($_GET['page'] < $comparePage) {
                    echo "<li><a href='{$nextPage}'>Next</a></li>";
                }
            }
            ?>
        </ul>
    </div>

<?php include_once("footer.php"); ?>
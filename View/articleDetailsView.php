<?php include_once("head.php"); ?>


<?php include_once("category.php"); ?>

<div class="main">
    <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
            <div class="col-md-12 col-sm-12">
                <div class="content-page">
                    <div class="row margin-bottom-30">
                        <!-- BEGIN CAROUSEL -->
                        <div class="col-md-5 front-carousel">
                            <div class="carousel slide" id="myCarousel">
                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img alt="" src="<?php echo ASSETS_PATH; ?>frontend/pages/img/works/img2.jpg">
                                        <div class="carousel-caption">
                                            <p><?php echo "{$this->article['short_description']}"; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END CAROUSEL -->

                        <!-- BEGIN PORTFOLIO DESCRIPTION -->

                        <div class="col-md-7">
                            <h1><?php echo "{$this->article['title']}"; ?></h1>
                            <p><i class="fa fa-calendar"></i> <?php echo "{$this->article['date']}"; ?></p>
                            <p><?php echo "{$this->article['text_article']}"; ?></p>
                            <p style="display: inline">Vizualizari: <i class="fa fa-child"></i></p>
                            <p id='vizualizari' style="display: inline"><?php echo "{$this->article['vizualizari']}"; ?></p>
                            <p><?php echo "Rating : <i class='fa fa-star-o'></i> {$this->article['rating']}"; ?></p>
                            <p style="display: none" id="id_article"><?php echo "{$this->article['id']}"; ?></p>

                            <br>
                        </div>
                        <!-- END PORTFOLIO DESCRIPTION -->
                    </div>


                    <!-- BEGIN RECENT WORKS -->
                    <div class="row recent-work margin-bottom-40">
                        <div>
                            <h2>Recommended articles</h2>
                        </div>

                        <?php
                        foreach ($this->articlesRandom as $key => $value) {
                            echo "<div class='col-md-4'>
                          <div class='recent-work-item'>
                              <em>
                                <img src='" . ASSETS_PATH . "frontend/pages/img/works/img1.jpg' alt='Amazing Project' class='img-responsive' >                      
                              </em>
                              <a class='recent-work-description' href='" . URL_SITE . "/show-details-article/{$value['id_article']}/{$value['id_category']}'>
                                    <strong>" . $value['title'] . "</strong>
                              </a>
                          </div>
                          </div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- END RECENT WORKS -->
        </div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- BEGIN SIDEBAR & CONTENT -->
</div>
</div>


<?php include_once("footer.php"); ?>


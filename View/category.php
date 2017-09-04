<div class="col-md-2 col-sm-3 blog-sidebar float-right">
    <!-- CATEGORIES START -->
    <h2 class="no-top-space">Categories</h2>
    <?php
    echo "<ul class='nav sidebar-categories margin-bottom-40'>";
    foreach ($this->categories as $key => $value) {
        if (isset($this->parameters['articlesCategory']) && $this->articlesCategory[0]['id'] == $value['id']) {
            echo "
                    <li>
                        <a href='" . URL_SITE . "show-category-articles/{$value['id']}/1' style='color:red'>" . $value['name'] . "</a >
                    </li >
                ";
        } else {
            if (isset($this->parameters['article']) && $this->id_category == $value['id']) {
                echo "
                    <li color='#ffff00'>
                        <a href='" . URL_SITE . "show-category-articles/{$value['id']}/1' style='color:red'>" . $value['name'] . "</a >
                    </li >
                ";
            } else
                echo "
                    <li>
                        <a href='" . URL_SITE . "show-category-articles/{$value['id']}/1' >" . $value['name'] . "</a >
                    </li >
                ";
        }
    }
    echo "<li>
            <a href='" . URL_SITE . "show-article'>All articles</a>            
          </li>";
    echo "</ul>";
    ?>
</div>
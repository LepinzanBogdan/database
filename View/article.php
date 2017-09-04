<div class="tab-pane active" id="tab_1_1">
    <div class="scroller" style="height: 500px; overflow-y: scroll;" data-always-visible="1" data-rail-visible="0">
        <ul class="feeds">
            <li>
                <?php
                if (count($this->articles) != 0) {
                    foreach ($this->articles as $key => $value) {
                        echo "<div class='col1'>
                                        <div class='cont'>
                                            <div class='cont-col2'>
                                                <a href='" . URL_SITE . "show-details-article/{$value['id_article']}/{$value['id_category']}'>" . $value['title'] . "</a >            
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col1'>
                                        <div class='cont'>
                                            <div class='cont-col2'>
                                                <div class='desc'>        
                                                    {$value['short_description']}
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                    <div class='col2'>     
                                            {$value['date']}
                                    </div>";
                    }
                } else {
                    echo "No articles found.";
                }
                ?>
            </li>
        </ul>
    </div>
</div>




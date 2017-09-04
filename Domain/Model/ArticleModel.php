<?php
/**
 * Created by PhpStorm.
 * Date: 24-Aug-17
 * Time: 12:10 PM
 */

class ArticleModel extends BaseModel {

    protected $table = 'articole';
    protected $id;
    protected $title;
    protected $text_article;
    protected $image;
    protected $rating;
    protected $vizualizari;
    protected $author_id;
    protected $date;
    protected $short_description;
    protected $visible;

    public function __construct($table = false, $pk = false)
    {
        parent::__construct($table, $pk);
    }

}
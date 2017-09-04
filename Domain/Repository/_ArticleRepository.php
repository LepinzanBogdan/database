<?php
/**
 * Created by PhpStorm.
 * User: Robert Nemeti
 * Date: 17-Aug-17
 * Time: 3:34 PM
 */

Class _ArticleRepository extends BaseRepository
{
    protected $table = "articole";

    /**
     * @return : Get all article
     */
    public function getArticle()
    {
        return $this->db->getAll("Select * From {$this->table}");
    }

    /**
     * @param $categorie
     * @first - first element selected
     * @last - how many elements were selected
     * @orderBy
     *
     * Get all articles from a certain category if paramaters first is false or
     * Get all articles from a certain category ordered by {$orderBy} and taken {$last} per query if paramters first it's a number
     *
     * @return :
     */
    public function getArticleByCategorie($categorie, $orderBy = false, $first = false, $last = false)
    {
        if ($last) {
            return $this->db->getAll("Select * from {$this->table}
                      left join article_category on {$this->table}.id = article_category.id_article
                      left JOIN categorie on categorie.id = article_category.id_category
                      where categorie.id = {$categorie}
                      order by {$orderBy}
                      limit {$first},{$last}");
        } else {
            return $this->db->getAll("Select * from {$this->table}
                left join article_category on {$this->table}.id = article_category.id_article
                left JOIN categorie on categorie.id = article_category.id_category
                where categorie.id = {$categorie}");
        }
    }

    /**
     * @param $orderBy
     * @param $number_articles
     * Return the first ($number_articles) articles ordered by ($orderBy)
     * @return mixed
     */
    public function getAllArticle($orderBy, $number_articles)
    {
        return $this->db->getAll("Select * from {$this->table}
               inner join article_category on {$this->table}.id = article_category.id_article
               INNER JOIN categorie on categorie.id = article_category.id_category
               order by $orderBy
               limit {$number_articles}");
    }

    /**
     * @param $search
     * @return mixed
     */
    public function searchArticle($search)
    {
        return $this->db->getAll("Select * from {$this->table}
                    inner join article_category on {$this->table}.id = article_category.id_article
                    INNER JOIN categorie on categorie.id = article_category.id_category
                    WHERE text_article LIKE '%{$search}%'
                    OR short_description LIKE '%{$search}%'
                    OR title LIKE '%{$search}%'");
    }
}
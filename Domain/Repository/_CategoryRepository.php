<?php
/**
 * Created by PhpStorm.
 * Date: 17-Aug-17
 * Time: 3:23 PM
 */

Class _CategoryRepository extends BaseRepository {

    protected $table = "categorie";

    /**
     * @return : Get all categories
     */
    public function getCategories(){
        return $this->db->getAll("SELECT * FROM {$this->table}");
    }


}
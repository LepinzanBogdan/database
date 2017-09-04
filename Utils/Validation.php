<?php
/**
 * Created by PhpStorm.
 * Date: 30-Aug-17
 * Time: 11:06 AM
 */

class Validation
{

    protected $validator;

    public function __construct($validator)
    {
        $this->validator = $validator;
    }


    public function validationForm($data)
    {
        $ok = true;
        foreach ($this->validator as $key => $value) {
            $field = explode(',', $value);
            foreach ($field as $valueField) {
                $valueField = explode(':',$valueField);

                if ($valueField[0] == 'required' && $valueField[1] == true) {
                    if(strlen($data[$key]) == 0){
                        echo $key." is required <br />";
                        $ok=false;
                    }
                }
                //number of charaters
                if ($valueField[0] == 'minLength') {
                    if(strlen($data[$key]) < $valueField[1]){
                        echo $key." length is less than ".$valueField[1]." <br />";
                        $ok=false;
                    }
                }
                if ($valueField[0] == 'maxLength') {
                    if(strlen($data[$key]) > $valueField[1]){
                        echo $key." length is greater than ".$valueField[1]." <br />";
                        $ok=false;
                    }
                }
                //number of words
                if ($valueField[0] == 'minWords') {
                    if(str_word_count($data[$key]) < $valueField[1]){
                        echo "The number of words for ".$key." is less than ".$valueField[1]." <br />";
                        $ok=false;
                    }
                }
                if ($valueField[0] == 'maxWords') {
                    if(str_word_count($data[$key]) > $valueField[1]){
                        echo "The number of words for ".$key." is greater than ".$valueField[1]." <br />";
                        $ok=false;
                    }
                }
            }
        }
        return $ok;
    }

    /*public function check($test, $data , $columnName)
    {
        $ok=true;
        foreach ($test as $value) {
            $value = explode(':',$value);

            if ($value[0] == 'required' && $value[1] == true) {
                if(strlen($data) == 0){
                    echo $columnName." is required <br />";
                    $ok=false;
                }
            }
            //number of charaters
            if ($value[0] == 'minLength') {
                if(strlen($data) < $value[1]){
                    echo $columnName." length is less than ".$value[1]." <br />";
                    $ok=false;
                }
            }
            if ($value[0] == 'maxLength') {
                if(strlen($data) > $value[1]){
                    echo $columnName." length is greater than ".$value[1]." <br />";
                    $ok=false;
                }
            }
            //number of words
            if ($value[0] == 'minWords') {
                if(str_word_count($data) < $value[1]){
                    echo "The number of words for ".$columnName." is less than ".$value[1]." <br />";
                    $ok=false;
                }
            }
            if ($value[0] == 'maxWords') {
                if(str_word_count($data) > $value[1]){
                    echo "The number of words for ".$columnName." is greater than ".$value[1]." <br />";
                    $ok=false;
                }
            }
        }
        return $ok;
    }*/
}
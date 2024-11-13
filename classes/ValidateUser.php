<?php

class ValidateUser implements Validate {
    private $data;

    public function __construct($data) 
    {
        $this->data = $data;
    }

    public function validate() {
        $this->empty();
        $this->minPassword(8);
    }
    public function empty() 
    {
        foreach($this->data as $key => $value) {
            if(trim($value) == ''){
                throw new Exception('empty_' . $key);
            }
        }
        return $this;
    }    

    public function minPassword($minLength) 
    {
        if(strLen($this->data['password']) < $minLength) {
            throw new Exception('min_length_password');
        }
        return $this;
    }
}
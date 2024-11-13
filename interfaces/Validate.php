<?php

interface Validate {
    public function __construct($data);

    public function validate();
    public function empty();
    public function minPassword($minLength);
}
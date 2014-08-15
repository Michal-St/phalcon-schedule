<?php
/*
 * Copyright 2014 Michał Strzelczyk
 * mail: kontakt@michalstrzelczyk.pl
 */
namespace Modules;

class Datetime {

    /**
     * Datetime configuration
     *
     * @var array 
     */
    public $options = array();

    /**
     * Inject config
     * 
     * @param type $options
     */
    public function __construct($options) {
        $this->options = $options;
    }

    /**
     * Zwraca datę odpowiednio dla environtmentu
     * 
     * @return string
     */
    public function datetime() {
        if ($this->options->{APP_ENVIROMENT} == 'normal')
            return date('Y-m-d H:i:s');

        return $this->options->{APP_ENVIROMENT};
    }

}

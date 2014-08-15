<?php

/*
 * Copyright 2014 Michał Strzelczyk
 * mail: kontakt@michalstrzelczyk.pl
 */

namespace Modules\Models;

class Schedule extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $schedule_id;

    /**
     *
     * @var datetime
     */
    protected $start;

    /**
     *
     * @var datetime
     */
    protected $end;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $type;

    /**
     * Method to set the value of field slide_id
     *
     * @param integer $schedule_id
     * @return Nucleo\Models\Schedle;
     */
    public function setScheduleId($schedule_id)
    {
        $this->schedule_id = $schedule_id;

        return $this;
    }

    /**
     * Ustawia date poczatkowa
     * 
     * @param type $start
     * @return \Nucleo\Models\Schedule
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }
    
    /**
     * Ustawia date koncowa
     * 
     * @param type $end
     * @return \Nucleo\Models\Schedule
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }
    
    /**
     * Ustawia nazwe
     * 
     * @param type $name
     * @return \Nucleo\Models\Schedule
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * Ustawia typ
     * 
     * @param type $type
     * @return \Nucleo\Models\Schedule
     */
    public function setType($type)
    {
        $this->type = $type;
        
        return $this;
    }
    
    /**
     * Zwraca id
     * 
     * @return type
     */
    public function getScheduleId()
    {
        return $this->schedule_id;
    }

    /**
     * Zwraca date rozpoczecia
     * 
     * @return type
     */
    public function getStart()
    {
        return $this->start;
    }
    
    /**
     * Zwraca date zakonczenia
     * 
     * @return type
     */
    public function getEnd()
    {
        return $this->end;
    }
    
    /**
     * Zwraca nazwe
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Zwraca typ
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'schedule_id' => 'schedule_id', 
            'start' => 'start', 
            'end' => 'end', 
            'name' => 'name',             
            'type' => 'type'
        );
    }

    /**
     * Czy punkt jest aktywny
     * 
     * @return type
     */
    public function isActive()
    {
        return $this->getStatus() == 'active';
    }
    
    /**
     * Czy punkt jest przed
     * 
     * @return type
     */
    public function isBefore()
    {
        return $this->getStatus() == 'before';
    }
    
    /**
     * Czy punkt jest aktywny
     * 
     * @return type
     */
    public function isAfter()
    {
        return $this->getStatus() == 'after';
    }
    
    /**
     * Zwraca status
     * 
     * @return string
     */
    public function getStatus()
    {
        $today = $this->getDI()->get('datetime')->datetime();
        
        if(strtotime($this->getStart()) > strtotime($today))
            return 'before';
        
        if(strtotime($this->getEnd()) < strtotime($today))
            return 'after';
        
        return 'active';        
    }
}

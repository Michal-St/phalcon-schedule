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
     * @return Modules\Models\Schedle;
     */
    public function setScheduleId($schedule_id)
    {
        $this->schedule_id = $schedule_id;

        return $this;
    }

    /**
     * Set schedule point start time
     * 
     * @param type $start
     * @return \Modules\Models\Schedule
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }
    
    /**
     * Set schedule point end time
     * 
     * @param type $end
     * @return \Modules\Models\Schedule
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }
    
    /**
     * Set schedule point name
     * 
     * @param type $name
     * @return \Modules\Models\Schedule
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * Set schedule point type
     * 
     * @param type $type
     * @return \Modules\Models\Schedule
     */
    public function setType($type)
    {
        $this->type = $type;
        
        return $this;
    }
    
    /**
     * @return type
     */
    public function getScheduleId()
    {
        return $this->schedule_id;
    }

    /**
     * @return type
     */
    public function getStart()
    {
        return $this->start;
    }
    
    /**
     * @return type
     */
    public function getEnd()
    {
        return $this->end;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
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
     * Is point active
     * 
     * @return type
     */
    public function isActive()
    {
        return $this->getStatus() == 'active';
    }
    
    /**
     * Is point before
     * 
     * @return type
     */
    public function isBefore()
    {
        return $this->getStatus() == 'before';
    }
    
    /**
     * Is active point
     * 
     * @return type
     */
    public function isAfter()
    {
        return $this->getStatus() == 'after';
    }
    
    /**
     * Return status: before, active, after
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

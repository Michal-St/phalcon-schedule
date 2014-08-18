<?php

/*
 * Copyright 2014 Michał Strzelczyk
 * mail: kontakt@michalstrzelczyk.pl
 */
namespace Modules;

class Schedule {

    /**
     * @var \Phalcon\Mvc\Model\Resultset\Simple
     */
    public $collection;
    
    /**
     * Current index
     * 
     * @var type 
     */
    private $_index = 0;

    /**
     * Get all schedule points by type
     * 
     * @param string $type
     * @return \Modules\Schedule
     */
    public function getByType($type) {
        $this->collection = \Modules\Models\Schedule::query()
                ->where("type = :type:")
                ->bind(array(
                    "type" => $type
                ))
                ->orderBy("schedule_id ASC")
                ->execute();

        $this->_index = 0;
        return $this;
    }

    /**
     * Get all schedule points by type
     * 
     * @param string $datetime
     * @return \Modules\Schedule
     */
    public function getByDate($datetime) {
        $this->collection = \Modules\Models\Schedule::query()
                ->where("start >= :start:")
                ->andWhere("end <= :end:")
                ->bind(array(
                    "start" => $datetime,
                    "end" => $datetime,
                ))
                ->orderBy("schedule_id ASC")
                ->execute();

        $this->_index = 0;
        return $this;
    }

    /**
     * Return all collection
     * 
     * @return \Phalcon\Mvc\Model\Resultset\Simple
     */
    public function getAll() {
        return $this->collection;
    }

    /**
     * Get first collection element
     * 
     * @return \Modules\Models\Schedule
     */
    public function getFirst() {
        $this->_index = 0;
        if ($this->collection->offsetExists($this->_index))
            return $this->collection->offsetGet($this->_index);

        return null;
    }

    /**
     * Get last collection element
     * 
     * @return \Modules\Models\Schedule
     */
    public function getLast() {
        $this->_index = $this->collection->count() - 1;
        if ($this->collection->offsetExists($this->_index))
            return $this->collection->offsetGet($this->_index);

        return null;
    }

    /**
     * Get next collection element
     * 
     * @return \Modules\Models\Schedule
     */
    public function getNext() {
        if ($this->collection->offsetExists($this->_index + 1)) {
            $this->_index++;
            return $this->collection->offsetGet($this->_index);
        }

        return null;
    }

    /**
     * Get previous collection element
     * 
     * @return \Modules\Models\Schedule
     */
    public function getPrevious() {
        if ($this->collection->offsetExists($this->_index - 1)) {
            $this->_index--;
            return $this->collection->offsetGet($this->_index);
        }

        return null;
    }

    /**
     * Get current collection element
     * 
     * @return \Modules\Models\Schedule
     */
    public function getCurrent() {
        if ($this->collection->offsetExists($this->_index)) 
            return $this->collection->offsetGet($this->_index);

        return null;
    }

    /**
     * Get active collection element
     * 
     * @return \Modules\Models\Schedule
     */
    public function getActive() {
        foreach ($this->collection as $schedule) {
            if ($schedule->isActive())
                return $schedule;
        }

        return null;
    }

}

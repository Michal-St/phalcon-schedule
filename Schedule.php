<?php

/*
 * Copyright 2014 AlterPage Sp. z o.o. licence, Version 1.0;
 * all rights reserved 
 *
 * AlterPage Sp. z o.o. 
 * al. Jana Pawła II 70 lok. 47
 * 00-175 Warsaw, Poland
 * kontakt@alterpage.pl
 * http://alterpage.pl
 *
 * developer: Arrow.
 */

namespace Nucleo;

class Schedule {

    /**
     * @var \Phalcon\Mvc\Model\Resultset\Simple
     */
    public $collection;
    
    /**
     * Obecny index kolekcji
     * 
     * @var type 
     */
    private $_index = 0;

    /**
     * Pobiera wszystkie punkty harmonogramu
     * 
     * @param type $type
     * @return \Nucleo\Schedule
     */
    public function getByType($type) {
        $this->collection = \Nucleo\Models\Schedule::query()
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
     * Pobiera wszystkie punkty na podstawie daty
     * 
     * @param type $datetime
     * @return \Nucleo\Schedule
     */
    public function getByDate($datetime) {
        $this->collection = \Nucleo\Models\Schedule::query()
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
     * Zwraca kolekcję
     * 
     * @return \Phalcon\Mvc\Model\Resultset\Simple
     */
    public function getAll() {
        return $this->collection;
    }

    /**
     * Zwraca pierwszy element kolekcji
     * 
     * @return \Nucleo\Models\Schedule
     */
    public function getFirst() {
        $this->_index = 0;
        if ($this->collection->offsetExists($this->_index))
            return $this->collection->offsetGet($this->_index);

        return null;
    }

    /**
     * Zwraca ostatni element kolekcji
     * 
     * @return \Nucleo\Models\Schedule
     */
    public function getLast() {
        $this->_index = $this->collection->count() - 1;
        if ($this->collection->offsetExists($this->_index))
            return $this->collection->offsetGet($this->_index);

        return null;
    }

    /**
     * Zwraca kolejny element kolekcji
     * 
     * @return \Nucleo\Models\Schedule
     */
    public function getNext() {
        if ($this->collection->offsetExists($this->_index + 1)) {
            $this->_index++;
            return $this->collection->offsetGet($this->_index);
        }

        return null;
    }

    /**
     * Zwraca poprzedni element kolekcji
     * 
     * @return \Nucleo\Models\Schedule
     */
    public function getPrevious() {
        if ($this->collection->offsetExists($this->_index - 1)) {
            $this->_index--;
            return $this->collection->offsetGet($this->_index);
        }

        return null;
    }

    /**
     * Zwraca aktualny element kolekcji
     * 
     * @return \Nucleo\Models\Schedule
     */
    public function getCurrent() {
        if ($this->collection->offsetExists($this->_index)) 
            return $this->collection->offsetGet($this->_index);

        return null;
    }

    /**
     * Zwraca aktywny element kolekcji
     * 
     * @return \Nucleo\Models\Schedule
     */
    public function getActive() {
        foreach ($this->collection as $schedule) {
            if ($schedule->isActive())
                return $schedule;
        }

        return null;
    }

}

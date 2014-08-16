phalcon-schedule
================

Schedule and Datetime module for Phalcon Framework

In my projects the application logic often depends on the time. For example some
forms can be avaible in specified period or some views need to change after competition.
Moreover projects managers and testers woud like to change application time.
This modules can do this in an easy way. For each enviroment developer can
set custom datetime.

===
### Instalation

Copy the main folder into your project where you keep libraries or modules.
For example (libs/ or app/vendor or /vendor). In \Phalcon\Loader() register
new namespace 'Modules'.


## 1. Datetime

in index.php set global var with your enviroment

```php
    define('APP_ENVIROMENT', getenv('AppEnviroment'));
```

or if your enviroment in VirtualHost is not set: 

```php
    define('APP_ENVIROMENT', 'development');
```

add datetime configuration in your global or module config file

```php
    /**
     * Config for datetime
     */
    'datetime' => array(
        'production' => 'normal',
        'staging' => 'normal',
        'testing' => 'normal',
        'development' => '2014-02-01 15:45:00'
    ),
```

in your Bootstrap file or in index.php you can add datetime to your DI

```php
    $config = $this->getConfig();
    $this->getDi()->set('datetime', function () use ($config) {
        return new \Modules\Datetime($config->datetime);
    }, true);
```

### Usage

in any file where DI is included

```php
    public function indexAction() {        
        $datetime = $this->getDi()->get('datetime')->datetime();
    }
```

===
## 2. Schedule

run schedule.sql file into your MySql database.

add schedule to DI

```php
    $this->getDi()->set('schedule', function () {
        return new \Modules\Schedule();
    }, true);
```

### Usage

Each of schedule point has start and end time, so it can have one of three status:
- before
- active
- after

Also each schedule point has it's own type so we can configurate many points with different types.
Class \Modules\Schedule has two major methods:

- getByType($type) - get all schedule points with the same type

- getByDate($datetime) - get all schedule points (with all types) where start >= $datetie <= end


when we choose interesting schedule points we can move between them using methods:

- getFirst()
- getNext()
- getPrevious()
- getLast()
- getCurrent()

- getActive() return point which status is 'active'


### Examples
//insert testing

```php
-- ----------------------------
--  Records of `schedule`
-- ----------------------------
BEGIN;
INSERT INTO `schedule` VALUES 
('1', 'competition', 'photo-upload', '2014-07-22 00:00:00', '2014-07-22 23:59:59'), 
('2', 'competition', 'moderator-accept', '2014-07-23 00:00:00', '2014-07-31 23:59:59'), 
('3', 'competition', 'voting', '2014-08-01 00:00:00', '2014-08-16 23:59:59'),
('4', 'promoCode', 'show sales codes', '2014-08-01 00:00:00', '2014-08-01 20:00:00');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
```

//Check promo code time

```php
    $schedule = $this->getDi()->get('schedule');
    $showPromoCodes = $schedule->getByType('promoCode')->getFirst()->isActive();
```

//voting schedule validator
```php
    
    ...

    $schedule = $this->getDi()->get('schedule');
    $votingSchedulePoint = $schedule->getByType('competition')->getLast();

    if($votingSchedulePoint->isBefore())
        $message = "You aren't able to vote before: ".$votingSchedulePoint->getStart();

    if($votingSchedulePoint->isActive())
        $message = "Thank's for voting";

    if($votingSchedulePoint->isAfter())
        $message = "Voting time is over";

    ...

```


I encourage you to clone repo and test it :)

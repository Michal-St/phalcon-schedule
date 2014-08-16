phalcon-schedule
================

Schedule and Datetime module for Phalcon Framework

In my projects the application logic often depends on the time. For example some
forms can be avaible in specified period or some views needs to change after competition.
Moreover projects managers and testers woud like to change application time.
This modules can do this in easy way. For each enviroment developer can
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

or if you don't have set enviroment in VirtualHost

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

Each of schedule point has start and end time, so it might have one of three status:
- before
- active
- after

Also each schedule point has own type so we can configurate many points with different types.
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

//Check promo code time

```php
    $schedule = $this->getDi()->get('schedule');
    $showPromoCodes = $schedule->getByType('promoCode')->getFirst()->isActive();
```

//vouting schedule validator
```php
    
    ...

    $schedule = $this->getDi()->get('schedule');
    $votingSchedulePoint = $schedule->getByType('competition')->getLast();

    if($votingSchedulePoint->isBefore())
        $message = 'You aren't able to vote before: '.$votingSchedulePoint->getStart();

    if($votingSchedulePoint->isActive())
        $message = 'Thank's for voting';

    if($votingSchedulePoint->isAfter())
        $message = 'Voting time is over';

    ...
```

I encourage you to clone repo and test it :)

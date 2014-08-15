phalcon-schedule
================

Schedule and Datetime module for Phalcon Framework

In my projects the application logic often depends on the time. For example some
forms can be avaible in specified period or some views needs to change after competition.
Moreover projects managers and testers woud like to change application time.
This modules can do this in a very easy way.

===
1. Datetime

## Instalation


in index.php set global var with your enviroment

<code>
    define('APP_ENVIROMENT', getenv('AppEnviroment'));
</code>

or if you don't have set enviroment in VirtualHost

<code>
    define('APP_ENVIROMENT', 'development');
</code>

add datetime configuration in your global or module config file

<code>
    /**
     * Config for datetime
     */
    'datetime' => array(
        'production' => 'normal',
        'staging' => 'normal',
        'testing' => 'normal',
        'development' => '2014-02-01 15:45:00'
    ),
</code>

in your Bootstrap file or in index.php you can add datetime to your DI

<code>
    $config = $this->getConfig();
    $this->getDi()->set('datetime', function () use ($config) {
        return new \Nucleo\Datetime($config->datetime);
    }, true);
</code>

## Usage

in any file where DI is included

<code>
    public function indexAction() {        
        $datetime = $this->getDi()->get('datetime')->datetime();
    }
</code>

===
2. Datetime
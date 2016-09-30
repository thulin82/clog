# thulin82/clog

[![Build Status](https://travis-ci.org/thulin82/clog.svg?branch=master)](https://travis-ci.org/thulin82/clog)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/thulin82/clog/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/thulin82/clog/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/thulin82/clog/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/thulin82/clog/?branch=master)

## License

This software is free software and carries a MIT license.

## Using CLog in Anax-MVC
First update your composer.json with the following:
```
    "require": {
        "thulin82/clog": "dev-master"
    },
```

Then update with:
```
composer update
```

To add CLog, the easiest way is either add it as a shared service:
```php
$this->setShared('log', function () {
    $log = new \thulin82\CLog\CLog();
    return $log;
});
```

or to initialize it when/where you need it:
```php
$log = new \thulin82\CLog\CLog();
```

## Examples
An example file is located in webroot/CLogExample.php to show off the different ways you can use CLog
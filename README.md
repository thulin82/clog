# thulin82/clog

[![GitHub Actions](https://github.com/thulin82/clog/actions/workflows/github-actions.yml/badge.svg)](https://github.com/thulin82/clog/actions/workflows/github-actions.yml)

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

## Docker

### Build

```bash
docker build -t clog .
```

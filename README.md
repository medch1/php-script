# php-script
run using
`php robo.phar search` 


**Modern and simple PHP task runner** inspired by Gulp and Rake aimed to automate common tasks:

## Installing

### Phar

[Download robo.phar >](https://robo.li/robo.phar)

```
wget https://robo.li/robo.phar
```

To install globally put `robo.phar` in `/usr/bin`. (`/usr/local/bin/` in OSX 10.11+)

```
chmod +x robo.phar && sudo mv robo.phar /usr/bin/robo
```

OSX 10.11+
```
chmod +x robo.phar && sudo mv robo.phar /usr/local/bin/robo
```

Now you can use it simply via `robo`.

### Composer

* Run `composer require consolidation/robo:^4`
* Use `vendor/bin/robo` to execute Robo tasks.

## Usage

All tasks are defined as **public methods** in `RoboFile.php`. It can be created by running `robo init`.
All protected methods in traits that start with `task` prefix are tasks and can be configured and executed in your tasks.

## Examples

The best way to learn Robo by example is to take a look into [its own RoboFile](https://github.com/consolidation/Robo/blob/2.x/RoboFile.php)
or [RoboFile of Codeception project](https://github.com/Codeception/Codeception/blob/2.4/RoboFile.php). There are also some basic example commands in `examples/RoboFile.php`.





## Credits

Follow [@robo_php](https://twitter.com/robo_php) for updates.

Brought to you by [Consolidation Team](https://github.com/orgs/consolidation/people) and our [awesome contributors](https://github.com/consolidation/Robo/graphs/contributors).

## License

[MIT](https://github.com/consolidation/Robo/blob/3.x/LICENSE)
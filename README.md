# php-script
 



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
* To search in a directory for all the config files: 
```
 robo directory $directory
 
 Example:
 robo directory conf.d
```
* To search for a location in a specific file you can use :
```
 robo search $file
 
 Example:
 robo search conf.d/test.conf
```
* To search for a serve_name in a specific file you can use :
```
 robo base_url $file
 
 Example:
 robo base_url conf.d/test.conf
```
* To generate a full url in a specific file you can use :
```
 robo full $file
 
 Example:
 robo full conf.d/test.conf
```



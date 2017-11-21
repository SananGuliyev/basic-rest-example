## Basic REST example with DDD

### Description
This example follow [DDD](https://en.wikipedia.org/wiki/Domain-driven_design) approach. It is maintainable and we can write our tests easily.

We use [Slim Framework](https://www.slimframework.com/) in this example.

##### Dependencies
* Slim Framework
* Doctrine ORM

### Installation
####Install composer
```
cd /path/to/project/folder
composer install
```

#### Import dump file to your MySQL
```
/path/to/project/folder/dump/basic-rest.sql
```

#### Add environment variable to your NGINX
```
location / {
...
   fastcgi_param   APPLICATION_ENV  development; #APPLICATION_ENV = development
...
}
```

#### Edit configuration file
```
nano /path/to/project/folder/src/Application/config/development.yaml
```

### Voucher Generator
```
curl 
```

### Voucher checker by email & code
```
curl 
```

### List of voucher codes by email
```
curl -X POST \
  http://your.host/getVouchers \
  -H 'content-type: application/json' \
  -d '{"email": "sanan@guliev.info"}'
```


### Next steps
* Extract response creating to own class
* Implement auth middleware
* Write unit tests
* Remove dump & implement [Phinx](https://phinx.org) for db migrations
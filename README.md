## Basic REST example with DDD

### Description
This example follow [DDD](https://en.wikipedia.org/wiki/Domain-driven_design) approach. It is maintainable and we can write our tests easily.

We use [Slim Framework](https://www.slimframework.com/) in this example.

##### Dependencies
* Slim Framework
* Doctrine ORM

### Installation
#### Install composer
```
cd /path/to/project/folder
composer install
```

#### Import dump file to your MySQL
```
mysql -u username -p dbname /path/to/project/folder/dump/basic-rest.sql
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

### Endpoints

#### Create offer
```
curl -X POST \
  http://your.host/offer \
  -H 'content-type: application/json' \
  -d '{"name": "Some amazing offer", "discount": 25}'
```

#### Create recipient
```
curl -X POST \
  http://your.host/recipient \
  -H 'content-type: application/json' \
  -d '{"name": "John Doe", "email": "john@doe.com"}'
```

#### Voucher Generator
```
curl -X POST \
  http://your.host/generateVouchers \
  -H 'content-type: application/json' \
  -d '{"offerId": 1, "expiration": "2017-12-31"}'
```

#### Voucher checker by email & code
```
curl -X POST \
  http://your.host/useVoucher \
  -H 'content-type: application/json' \
  -d '{"code": "someAmazingCode", "email": "john@doe.com"}'
```

#### List of voucher codes by email
```
curl -X POST \
  http://your.host/getVouchers \
  -H 'content-type: application/json' \
  -d '{"email": "john@doe.com"}'
```

### Extra

* You can find [Postman](https://www.getpostman.com/) collection in the dump folder :gift:


### Next steps
* Extract routes to own file
* Extract response creating to own class
* Implement auth middleware
* Implement validation for request (never believe to user)
* Write unit tests
* Remove dump & implement [Phinx](https://phinx.org) for db migrations
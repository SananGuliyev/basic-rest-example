## Basic REST example with DDD

### Description
This example follow [DDD](https://en.wikipedia.org/wiki/Domain-driven_design) approach. It is maintainable and we can write our tests easily.

We use [Slim Framework](https://www.slimframework.com/) in this example.

##### Dependencies
* Slim Framework
* Doctrine ORM

### Installation
```
cd /path/to/project/folder
composer install
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

* Implement [One-To-Many, Bidirectional](http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/association-mapping.html#one-to-many-bidirectional) & remove stupid extra queries :grin:
* Extract response creating to own class
* Implement auth middleware
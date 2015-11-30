# EasyConfig

EasyConfig is a small class meant for making config more easy. You can easily load in files, arrays and json.
This way you can easily retrieve your config throughout your whole application without any hassle

## Sample Usage

### Loading an array
```php
use EasyConfig\EasyConfig;

$array = [
	'db' => [
		'host' => '8.8.8.8'
	]
];

$config = new EasyConfig();
$config->load($array);
```

### Loading a file
The loaded file must return an array. See config.php for an example
```php
use EasyConfig\EasyConfig;
use EasyConfig\ConfigType;

$config = new EasyConfig();
$config->load('config.php', ConfigType::File);
```

### Loading a json string
```php
use EasyConfig\EasyConfig;
use EasyConfig\ConfigType;

$json = '{"db": { "host": "127.0.0.1" }}';

$config = new EasyConfig();
$config->load($json, ConfigType::Json);
```

### Retrieving values
The get function in EasyConfig allows for 2 parameters.
The first parameter represents the key to retrieve the value from. Multidimensional arrays can be accessed with the dot ('.') seperator.

The second parameter represents a default value in case the config key isn't found.
This parameter is optional and is null by default

```php
echo $config->get('db.host'); //Key exists
//Output: 8.8.8.8

echo $config->get('db.host', '127.0.0.1'); //Key exists, default value is given just in case
//Output: 8.8.8.8

echo $config->get('database.host', '127.0.0.1'); //Key doesn't exist, default value will be used
//Output: 127.0.0.1
```

### Check if key exists
```php
/*
array(
	'db' => array(
		'host' => '8.8.8.8'
	)
);
*/

$config->exists('db')
//Output: (boolean)True
$config->exists('db.host')
//Output: (boolean)True
$config->exists('database')
//Output: (boolean)False
```

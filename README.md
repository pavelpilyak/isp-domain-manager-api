# ISP API Domain Manager
This package can add/remove domains and add DNS records using the ISP API.

## Install
- Run `composer require pavelpilyak/isp-domain-manager-api`
- Import the package: `use pavelpilyak\ISPManagerAPI;`

## Usage
Firstly, you need to create the class instance with auth credentials:
```php
$ispDomain = 'https://isp.com:1500';
$login     = 'admin';
$password  = 'password';

$manager = new ISPManagerAPI($ispDomain, $login, $password);
```
### Add domain
```php
$domain   = 'site.com';
$login    = 'admin@site.com';
$serverIP = '192.100.0.1';

$response = $manager->addDomain($domain, $login, $serverIP); // success, error or unrecognized
```
### Delete domain
```php
$domain = 'site.com';

$response = $manager->deleteDomain($domain); // success, error or unrecognized
```
### Add DNS Record
```php
$domain = 'site.com';
$subdomain = '@';
$recordType = 'a';
$recordValue = '192.100.0.1';
$serverIp = '192.100.0.1';

$response = $manager->addRecord(
    $domain, 
    $subdomain, 
    $recordType, 
    $recordValue, 
    $serverIp
); // success, error or unrecognized
```

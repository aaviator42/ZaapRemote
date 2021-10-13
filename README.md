# ZaapRemote
Easily make API requests from PHP  
`v1.3`: `2021-10-12`

ZaapRemote contains a single `send` function that makes it super easy for you to send API requests. 

It was originally written to be used with APIs written with [Zaap](https://github.com/aaviator42/Zaap), but can be used with pretty much any API, although you _might_ have to make minor changes depending on how the API you're interacting with expects queries to be formatted.

You can configure a PEM file for cURL on line 15 if you'd like to make secure requests.

The `send` function will throw an exception if an error occurs while making the request.

By default `cURL` is configured to wait for 60 seconds for a response before it times out. You can change this if you want, modify `CURLOPT_TIMEOUT`.

### Syntax

```php
\Zaap\Remote\send(<method>, <URL>, <params>, <payload>);
```

### Usage

```php
<?php

require 'ZaapRemote.php';

$URL = "http://example.com/api.php/getUser/byID";
$params = array("userid" = "1234", "token" => "1337");
$payload = array("filename" => "1234.txt", "line" => "44");

echo \Zaap\Remote\send("GET", $URL, $params, $payload);
```

### Explanation

* `<method>`: Accepts a string. Use "GET", "PUT", "POST", "DELETE", whatever.
* `<URL>`: The URL of the API
* `<params>`: An array containing parameters that will be encoded into the query string. For example, `array("userid" = "1234")` becomes `<URL>/?userid=1234`.  
  Optional. Don't use if your URL already has queries attached to it, it'll break the URL, just pass `NULL`. 
* `<payload>`: Data (probably an array) to be JSON-encoded and transmitted in the request body. Optional. 

## Requirements
1. [Supported versions of PHP](https://www.php.net/supported-versions.php). At the time of writing, that's PHP `7.3+`. ZaapRemote will almost certainly work on older versions, but we don't test it on those, so be careful, do your own testing.
2. The PHP cURL extenision should be enabled.

----------
Documentation updated: `2020-10-10`.

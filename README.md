# ZaapRemote
Easily make API requests from PHP  
`v1.1`: `2021-09-13`

ZaapRemote contains a single `send` function that makes it super easy for you to send API requests. 

It was originally written to be used with APIs written with [Zaap](https://github.com/aaviator42/Zaap), but can be used with pretty much any API, although you _might_ have to make minor changes depending on how the API you're interacting with expects queries to be formatted.

### Syntax

```
\Zaap\Remote\send(<method>, <URI>, <params>, <payload>);
```

### Usage

```
<?php

require 'ZaapRemote.php';

$URI = "http://example.com/api.php/getUser/byID";
$params = array("userid" = "1234", "token" => "1337");
$payload = array("filename" => "1234.txt", "line" => "44");

echo \Zaap\Remote\send("GET", $URI, $params, $payload);
```

### Explanation

* `<method>`: Accepts a string. Use "GET", "PUT", "POST", "DELETE", whatever.
* `<URI>`: The URI of the API
* `<params>`: An array containing parameters that will be encoded into the query string. For example, `array("userid" = "1234")` becomes `<URI>/?userid=1234`.  
  Optional. Don't use if your URI already has queries attached to it, it'll break the URI, just pass `NULL`. 
* `<payload>`: Data (probably an array) to be JSON-encoded and transmitted in the request body. Optional. 

----------
Documentation updated: `2020-09-13`

<?php
$errno = 0;
$errstr = '';
$fp = stream_socket_client('tcp://127.0.0.1:8000', $errno, $errstr, 2);
var_dump($fp);
var_dump($errno);
var_dump($errstr);

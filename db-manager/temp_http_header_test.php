<?php
$errno = 0;
$errstr = '';
$fp = stream_socket_client('tcp://127.0.0.1:8001', $errno, $errstr, 5);
if (!$fp) { echo "CONNECT FAIL: $errno $errstr"; exit(1); }
fwrite($fp, "GET /businesses HTTP/1.0\r\nHost: 127.0.0.1\r\nConnection: close\r\n\r\n");
stream_set_timeout($fp, 3);
$line = fgets($fp);
var_dump($line);
$meta = stream_get_meta_data($fp);
var_dump($meta['timed_out']);

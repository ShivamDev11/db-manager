<?php
$fp = fsockopen('127.0.0.1', 8000, $errno, $errstr, 5);
if (!$fp) {
    echo "CONNECT FAIL: $errno $errstr";
    exit(1);
}
fwrite($fp, "GET /businesses HTTP/1.0\r\nHost: 127.0.0.1\r\nConnection: close\r\n\r\n");
stream_set_timeout($fp, 10);
$response = '';
while (!feof($fp)) {
    $response .= fgets($fp, 1024);
}
echo $response;

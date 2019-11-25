# gen-test

git clone 

1) php -S localhost:8080
2) curl 'localhost:8080?param1=value1&param2=value2'  -d '{"param3":"value3","param4":"value4"}'
3) echo '{"param3":"value3"}' |  php index.php --param1=value1 --param2=value2

4) Cache.php

$cache = new Cache('key1','value678',3600,true,true);  (Line 149)
can test Cache


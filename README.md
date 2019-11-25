# gen-test

1) git clone
2) php -S localhost:8080 

#1 Task
Cache.php 

# (Line 149) init script and change key, value
$cache = new Cache('key1','value678',3600,true,true); 
for test Cache

#2 Task 

- curl 'localhost:8080?param1=value1&param2=value2'  -d '{"param3":"value3","param4":"value4"}'
- echo '{"param3":"value3"}' |  php index.php --param1=value1 --param2=value2
- http://localhost:8080/?var=1&var2=2&value3=3

================================================



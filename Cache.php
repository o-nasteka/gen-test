<?php

/**
 * Interface CacheInterface
 */
interface CacheInterface {
    public function get($key);
    public function set($key, $value, $ttl);
}

/**
 * Class Decorator
 */
class Decorator implements CacheInterface
{
    public $key;
    public $value;
    public $ttl;


    public function get($key)
    {
        if($this->key == $key){
            return $this->value;
        }else{
            echo 'Static Key: not found! Find in File Storage.';
            $status = false;
            if($status == false){
                $fileCache = new FileCache();
                $status = $fileCache->get($key);
                if($status == false){
                    $status = 'Key not found if File Storage';
                }
            }
        }
        return $status;

    }

    public function set($key,$value,$ttl)
    {
        $this->key = $key;
        $this->value = $value;
        $this->ttl = $ttl;

    }

}

/**
 * Class Cache
 */
class Cache extends Decorator
{
    public function __construct($key,$value,$ttl,$fileCache = false,$staticCache = true)
    {
        $this->set($key,$value,$ttl);

        if($staticCache == true){
            $staticCache = new StaticCache();
            $staticCache->set($key,$value,$ttl);
        }

        if($fileCache == true){
            $fileCache = new FileCache();
            $fileCache->set($key,$value,$ttl);
        }

    }

}

/**
 * Class FileCache
 */
class FileCache extends Decorator
{

    /**
     * @param $key
     * @param $value
     * @param $ttl
     */
    public function set($key,$value,$ttl)
    {
        $checkCache = $this->get($key);

        if($checkCache == true){
            echo 'File Cache before write: key isset';
            return;
        }else{
            $file = 'cache/file_cache.tmp';
            if(!file_exists($file)){
                $handle = fopen($file, "w");   // write
                fwrite($handle, "$key:$value:$ttl" . "\r\n");
                fclose($handle);
            }else{
                $handle = fopen($file, "a"); // append
                fwrite($handle, "$key:$value:$ttl" . "\r\n");
                fclose($handle);
            }
        }


    }

    /**
     * @param $key
     * @return bool
     */
    public function get($key)
    {
        echo '<br>' . 'search '. $key . '<br>';

        $file = 'cache/file_cache.tmp';
        if(file_exists($file)){
            $fp = fopen($file, "r");

            while (!feof($fp)) {
                $buffer = fgets($fp, 4096);
                $cache[] = explode(':',$buffer);
            }
            foreach ($cache as $value){
               if($key == $value[0]){
                   return 'key isset:' . $value[0];
               } else{
//                    $status = 'key not found in FileCache';
                    $status = false;
               }
            }

            return $status;

        }else{
            fclose(fopen($file,'x'));
            echo 'Cache file not isset!';
        }
    }
}

/**
 * Class StaticCache
 */
class StaticCache extends Decorator
{

}

$cache = new Cache('key1','value678',3600,true,true);

echo '<pre>';
echo $cache->get('key6');
echo '</pre>';

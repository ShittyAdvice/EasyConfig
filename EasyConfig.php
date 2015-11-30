<?php namespace EasyConfig;

/**
 * Class ConfigType
 * Abstract class is used due to the absent of a proper Enum type reference in PHP
 * @package Helpers
 */
abstract class ConfigType
{
    const File = 'File'; // A file must contain a return which will return an array
    const Collection = 'Collection'; //Collection is an alternative for Array. Only PHP 7 > allows Array to be a variable name
    const Json = 'Json'; // Must be a valid json string without any extra's
}

class EasyConfig{
    protected $data;
    protected $default;
    public $separator = '.';

    /**
     * Get the value of a configuration setting
     * Multidimensional array can be accessed using the  dot ('.') character
     * Example: "database.hostname"
     *
     * @param string $key Reference to the index of the value within the config
     * @param string $default
     * @return string Value of the key or the default value if key doesn't exist
     */
    public function get($key, $default = null){
        $this->default = $default;
        $data = $this->data;
        $segments = explode($this->separator, $key);

        foreach($segments as $segment){
            if(isset($data[$segment])){
                $data = $data[$segment];
            }
            else{
                $data = $this->default;
                break;
            }
        }
        return $data;
    }

    /**
     * @param $input Value to be parsed and used as config.
     * @param string $configType A const from the ConfigType class to identify given value.
     * @throws Exception This is thrown when a file is parsed as argument, but doesn't exist.
     * @throws InvalidArgumentException Thrown when an invalid ConfigType is passed or when the given parameter could not be converted to an array properly
     */
    public function load($input, $configType = ConfigType::Collection){
        $data = null;
        switch($configType) {
            case ConfigType::File:
                if(file_exists($input)){
                    $data = (require $input);
                }
                else{
                    throw new Exception('File doesn\'t exist');
                }
                break;
            case ConfigType::Collection:
                $data = $input;
                break;
            case ConfigType::Json:
                $data = json_decode($input, true);
                break;
            default:
                throw new \InvalidArgumentException('The given ConfigType is not recognized');
                break;
        }
        if(!is_array($data)){
            throw new \InvalidArgumentException('The given parameter could not be converted to an array');
        }
        $this->data = $data;
    }

    /**
     * Check if a given key exists in the configuration
     *
     * @param string $key Reference to the index of the value within the config
     * @return bool Returns true or false whether the key exists or not
     */
    public function exists($key){
        return $this->get($key) !== $this->default;
    }
}
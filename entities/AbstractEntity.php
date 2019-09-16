<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 11:17
 */

abstract class AbstractEntity
{
    /**
     *	@param Array $params
     *	@return void
     */
    public function __construct(Array $params)
    {
        $this->hydrate($params);
    }

    /**
     *	@param Array $data
     *	@return void
     */
    public function hydrate(Array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    /**
     *	@param bool $assoc|false
     *	@return array $objArray
     */
    public function toArray(bool $assoc = false)
    {
        $objArray = array();
        if ($assoc)
        {
            foreach ($this as $attr => $value)
            {
                $objArray[$attr] = $value;
            }
        }
        else
        {
            foreach ($this as $attr => $value)
            {
                $objArray[] = $value;
            }
        }
        return $objArray;
    }

}

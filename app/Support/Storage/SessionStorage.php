<?php

namespace App\Support\Storage;

use App\Support\Storage\Contracts\StorageInterface;
use Countable;

class SessionStorage implements StorageInterface, Countable
{
    protected $bucket;

    public function __construct($bucket = 'default')
    {
        if (!isset($_SESSION[$bucket])) {
            $_SESSION[$bucket] = [];
        }

        $this->bucket = $bucket;
    }

    /**
     * [set description]
     * @param [type] $index [description]
     * @param [type] $value [description]
     */
    public function set($index, $value)
    {
        $_SESSION[$this->bucket][$index] = $value;
    }

    /**
     * [get description]
     * @param  [type] $index [description]
     * @return [type]        [description]
     */
    public function get($index)
    {
        if (!$this->exists($index)) {
            return null;
        }

        return $_SESSION[$this->bucket][$index];
    }

    /**
     * [all description]
     * @return [type] [description]
     */
    public function all()
    {
        return $_SESSION[$this->bucket];
    }

    /**
     * [exists description]
     * @param  [type] $index [description]
     * @return [type]        [description]
     */
    public function exists($index)
    {
        return isset($_SESSION[$this->bucket][$index]);
    }

    /**
     * [unset description]
     * @param  [type] $index [description]
     * @return [type]        [description]
     */
    public function unset($index)
    {
        if ($this->exists($index)) {
            unset($_SESSION[$this->bucket][$index]);
        }
    }

    /**
     * [clear description]
     * @return [type] [description]
     */
    public function clear()
    {
        unset($_SESSION[$this->bucket]);
    }

    /**
     * [itemCount description]
     * @return [type] [description]
     */
    public function count()
    {
        return count($this->all());
    }
}

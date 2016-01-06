<?php
namespace Vanqard\Frankenbuilder;

/**
 * Class definition for the Frankenbuilder skeleton class
 * 
 * @author Thunder Raven-Stoker
 *
 */
class Skeleton
{
    /**
     * Collected methods collection
     * 
     * @var array
     */
    private $methods = array();
    
    /**
     * Add a callable method to this skeleton
     * 
     * @param string $methodName
     * @param callable $func
     * @return fluent interface
     */
    public function addMethod($methodName, Callable $func) {
        $this->methods[$methodName] = $func;
        
        return $this;
    }
    
    /**
     * magic call method to invoke the collected closure method identified by name
     * 
     * @param string $methodName
     * @param mixed $args
     * @return mixed
     */
    public function __call($methodName, $args) {
        if (is_callable($this->methods[$methodName])) { 
            return call_user_func_array($this->methods[$methodName],$args);
        }
    }
}

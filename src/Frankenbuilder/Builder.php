<?php
namespace Vanqard\Frankenbuilder;

use Vanqard\Frankenbuilder\Skeleton;
use Vanqard\Frankenbuilder\InvalidObjectException;
use Vanqard\Frankenbuilder\InvalidMethodException;

/**
 * Class definition for the Builder class
 * 
 * This object will construct a hybrid monster using the Skeleton class
 * as its base and allows the developer to attach live, connected methods
 * from other objects to it. 
 * 
 * 
 * @author Thunder Raven-Stoker
 *
 */
class Builder
{
    /**
     * 
     * @var Skeleton
     */
    private $monster;
    
    /**
     * Constructor
     * 
     * @param Builder $monster
     */
    public function __construct(Builder $monster = null)
    {
        if (is_null ($monster)) {
            $this->monster = new Skeleton();
        }
    }
    
    /**
     * Returns the monster instance (skeleton plus any methods attached)
     * 
     * @return Skeleton $monster
     */
    public function getMonster()
    {
        return $this->monster;
    }
    
    /**
     * Extracts the named method from the supplied object and attaches
     * it to the skeleton instance
     * 
     * @param object $object
     * @param string $methodName
     * @param string $newMethodName - optional: attach the method under a new name
     * @throws InvalidObjectException When the $object param isn't actually an object
     * @throws InvalidMethodException When the named method is not callable
     * @return \Vanqard\Frankenbuilder\Builder fluent interface
     */
    public function addMethod( $object, $methodName, $newMethodName = null)
    {
        if (!is_object($object)) {
            throw new InvalidObjectException('First parameter must be an object instance');
        }
        
        if (!is_callable(array($object, $methodName))) {
            throw new InvalidMethodException('The named method must be callable on the supplied object');
        }
        
        $methodInstance = new \ReflectionMethod($object, $methodName);
        $limb = $methodInstance->getClosure($object);
        
        $limbName = ( !is_null ($newMethodName) ? $newMethodName : $methodName);
        $this->addToSkeleton($limbName, $limb);
        
        return $this;
    }
    
    /**
     * Attach the connected method to our monster's skeleton
     * 
     * This will allow the original method to be invoked on the monster
     * However, invoking the method will actually trigger on the original
     * donor object
     * 
     * @access public - You can add your own closures too if you wish
     * @param string $methodName
     * @param Callable $limb
     */
    public function addToSkeleton($limbName, Callable $limb)
    {
        $this->getMonster()->addMethod($limbName, $limb);
    }
}
<?php 
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

$builder = new \Vanqard\Frankenbuilder\Builder();

/**
 * A simple class to illustrate its usage
 * 
 * @author Thunder Raven-Stoker
 *
 */
class Character
{
    /**
     * @var string
     */
    private $name;
    
    /**
     * @var string
     */
    private $type;
    
    public function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
    }
    
    /**
     * Getter for the name property
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Getter for the type property
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}

// Set up our "donor" objects
$kyloRen = new Character("Kylo Ren", "baddie");
$bb8 = new Character("BB8", "funny looking droid");

// Take the 'getName' method from the $kyloRen instance
$builder->addMethod($kyloRen, "getName");

// But take the 'getType' method from the $bb8 instance
$builder->addMethod($bb8, 'getType');

// Collect the hybrid monster instance
$monster = $builder->getMonster();

// Break the principle of least astonishment here
echo "\n";
echo "Hello, my name is {$monster->getName()}";
echo " and I'm a {$monster->getType()}";
echo "\n";


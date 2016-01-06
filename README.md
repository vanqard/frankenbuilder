# Frankenbuilder

This is a very silly illustration of how we can construct a hybrid "monster" object by cherry-picking current, active methods from other object instances and attaching them to a skeleton.

This allows us to create an abomination made up of methods that are turned into closures, yet still have these closures attached to their donor object instances. 

# Example code


```
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

```

In this example, we create two new character instances and take the `getName()` method from one and the `getType()` method from the other in order to create the hybrid monster. 

### Suggested usage

I have no idea, except perhaps that you could create a single hybrid "read only" model for passing to a view by cherry picking getters from a variety of model instances. 


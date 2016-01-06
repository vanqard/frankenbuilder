# Frankenbuilder

This is a very silly illustration of how we can construct a hybrid "monster" object by cherry-picking current, active methods from other object instances and attaching them to a skeleton.

This allows us to create an abomination made up of methods that are turned into closures, yet still have these closures attached to their donor object instances. 


# Example code

Define a simple "donor" class with at least two methods so that we can cherry pick from example instances


    <?php 
    require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
    
    $builder = new \Vanqard\Frankenbuilder\Builder();
    
    class Character
    {
        private $name;
        private $type;
        
        public function __construct($name, $type)
        {
            $this->name = $name;
            $this->type = $type;
        }
    
        public function getName()
        {
            return $this->name;
        }
        
        public function getType()
        {
            return $this->type;
        }
    }



Create our two donor instances

    // Set up our "donor" objects
    $kyloRen = new Character("Kylo Ren", "baddie");
    $bb8 = new Character("BB8", "funny looking droid");


Cherry pick the `getName()` method from one donor 
    
    // Take the 'getName' method from the $kyloRen instance
    $builder->addMethod($kyloRen, "getName");


And cherry pick the `getType()` method from the other
    
    // But take the 'getType' method from the $bb8 instance
    $builder->addMethod($bb8, 'getType');
    

Test the monster by invoking the two extracted methods
    
    // Collect the hybrid monster instance
    
    $monster = $builder->getMonster();

    // Break the principle of least astonishment here
    echo "\n";
    echo "Hello, my name is {$monster->getName()}";
    echo " and I'm a {$monster->getType()}";
    echo "\n";

The output: 

    $ Hello, my name is Kylo Ren and I'm a funny looking droid
    

### Suggested usage

I have no idea, except perhaps that you could create a single hybrid "read only" model for passing to a view by cherry picking getters from a variety of model instances. 

The idea was originally examined in my book [PHP Brilliance](https://phpbrilliance.com) but I've extracted it here to play with it.
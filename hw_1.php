<?php

class Test
{
    public $name;
    //private $namePrivate;
    public $age;
    //private $price;

    // magic method "__construct"
    public function __construct($age, $name)
    {
        $this->age = $age;
        $this->name = $name;
    }

    // magic method "__destruct"
    public function __destruct()
    {
        echo "<br>" . 'Destroying: ' . $this->age . "</br>";
        echo 'Destroying: ' . $this->name . "</br>";
    }

    // magic method "__call"
    public function __call($name, $arguments)
    {
        echo "Вызов метода несуществующего '$name' " . implode(', ', $arguments) . "\n";
    }

    // magic method "__construct__callStatic"
    static public function __callStatic($name, $arguments)
    {
        echo "Вызов статического несуществующего метода '$name' " . implode(', ', $arguments) . "\n";
    }

    // magic method "__debugInfo"
    public function __debugInfo()
    {
        return [
            'ageTest' => $this->age * 2,
            'nameTest' => $this->name
        ];
    }

    // magic method "__unset"
    public function __unset($name)
    {
        echo "Уничтожение '$name'\n";
        unset($this->$name);
    }

    // magic method "__isset"
    public function __isset($name)
    {
        echo "Установлено ли '$name'?\n";
        return isset($this->$name);
    }

    // magic method "__get"
    public function __get($namePrivate)
    {
        echo "Get" . $this->namePrivate;
    }

    // magic method "__set"
    public function __set($name, $value)
    {
        $this->name = $value;
        echo "Set" . $value;
    }

    // magic method "__set_state"
    public static function __set_state($an_array)
    {
        $obj = new A;
        $obj->var1 = $an_array['var1'];
        $obj->var2 = $an_array['var2'];
        return $obj;
    }

    // magic method "__invoke"
    public function __invoke($obj)
    {
        var_dump('__invoke ' . $obj);
    }

    // magic method "__toString"
    public function __toString()
    {
        return '"__toString" ' . $this->foo;
    }

    // magic method "__sleep"
    public function __sleep()
    {
        return array("name");

    }
}

class MyCloneable
{
    public $object1;

    function __clone()
    {
        $this->object1 = clone $this->object1;
    }
}

$test = new Test(12, 'qwerty');
echo '<br>';
$test->qwerty();
echo '<br>';
var_dump($test);
echo '<br>';
Test::qwerty();
echo '<br>';
var_dump($test);
unset($test->age);
echo '<br>';
var_dump($test);
echo '<br>';
$test->name = 'ytrewq';
var_dump($test);
echo '<br>';
//isset($test->namePrivate);
echo '<br>';
unset($test->age);
echo '<br>';
var_dump($test);
echo '<br>';
//$test->name;
echo '<br>';

$test_2 = new Test(100, 'NAME');
$b = var_export($test_2, true);
var_dump($b);
echo '<br>';

$test_3 = new Test(11, 'meme');
$test_3(10);

echo $test;

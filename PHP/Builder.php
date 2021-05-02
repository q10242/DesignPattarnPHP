<?php

interface Builder
{
    public function producePartA():void;
    public function producePartB():void;
    public function producePartC():void;
}

class ConcreteBuilder1 implements Builder
{
    private $product;


    public function __construct()
    {
        $this->reset();

    }

    public function reset(): void
    {
        $this->product = new Product1();
    }

    public function producePartA():void
    {
        $this->product->parts[] = "PartA1";
    }
    public function producePartB():void
    {
        $this->product->parts[] = "PartB1";
    }
    public function producePartC():void
    {
        $this->product->parts[] = "PartC1";
    }
    /**
     * Concrete Builders are supposed to provide their own methods for
     * retrieving results. That's because various types of builders may create
     * entirely different products that don't follow the same interface.
     * Therefore, such methods cannot be declared in the base Builder interface
     * (at least in a statically typed programming language). Note that PHP is a
     * dynamically typed language and this method CAN be in the base interface.
     * However, we won't declare it there for the sake of clarity.
     *
     * Usually, after returning the end result to the client, a builder instance
     * is expected to be ready to start producing another product. That's why
     * it's a usual practice to call the reset method at the end of the
     * `getProduct` method body. However, this behavior is not mandatory, and
     * you can make your builders wait for an explicit reset call from the
     * client code before disposing of the previous result.
     */
    public function getProduct(): Product1
    {
        $result = $this->product;
        $this->reset();
        return $result;
    }

    
}


class Product1
{
    public $parts = [];
    public function listParts():void
    {
        echo "Product parts:" . implode (', ',$this->parts). "\n\n";
    }
}

class Director
{
    private $builder;

    public function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    public function buildMinimalViableProduct(): void
    {
        $this->builder->producePartA();
    }

    public function buildFullFeaturedProduct(): void
    {
        $this->builder->producePartA();
        $this->builder->producePartB();
        $this->builder->producePartC();
    }
}

function clientCode(Director $director) 
{
    $builder = new ConcreteBuilder1();
    $director->setBuilder($builder);

    
    echo "Standard basic product:\n";
    $director->buildMinimalViableProduct();
    $builder->getProduct()->listParts();

    echo "Standard full featured product:\n";
    $director->buildFullFeaturedProduct();
    $builder->getProduct()->listParts();

    // Remember, the Builder pattern can be used without a Director class.
    echo "Custom product:\n";
    $builder->producePartA();
    $builder->producePartC();
    $builder->getProduct()->listParts();
}

$director = new Director();
clientCode($director);
/**
 * 簡單來說 要建立Product1 就可以用Builder 來設定各種不同部分的Function 再使用Director 來簡化它 
 * 根據你的Builder不同 建立出來的物件也不一樣 所以才會需要一個interface 來規定基本的methods
 */
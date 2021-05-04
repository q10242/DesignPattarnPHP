<?php 
/**
 * 抽象工廠模式
 */

interface AbstractFactory
{
    public function createProductA(): AbstractProductA;
    public function createProductB(): AbstractProductB;

}
class ConcreateFactory1 implements AbstractFactory
{
    public function createProductA(): AbstractProductA
    {
        return new ConcreteProductA1();
    }
    public function createProductB() :AbstractProductB
    {
        return new ConcreteProductB1();
    }
}

class ConcreateFactory2 implements AbstractFactory
{
    public function createProductA(): AbstractProductA
    {
        return new ConcreteProductA2();
    }
    public function createProductB() :AbstractProductB
    {
        return new ConcreteProductB2();
    }

}


interface AbstractProductA {
    public function usefulFunctionA():string;
}

class ConcreteProductA1 implements AbstractProductA
{
    public function usefleFunctionA():string
    {
        return "the Result of the product A1.";
    }
}

class ConcreteProductA2 implements AbstractProductA
{
    public function usefleFunctionA():string
    {
        return "the Result of the product A2.";
    }
}

interface AbstractProductB {
    public function usefulFunctionB():string;
}

class ConcreteProductB1 implements AbstractProductB{
    public function usefulFunctionB():string
    {
        return "The result of the product B1";
    }
}

class ConcreteProductB2 implements AbstractProductB {
    public function usefulFunctionB():string {
        return "the result of the product B2";
    }
}

function clientCode(AbstractFactory $factory)
{
    $productA = $factory->createProductA();
    $productB = $factory->createProductB();

    echo $productB->usefulFunctionB();
}

clientCode(new ConcreateFactory1());
clientCode(new ConcreateFactory2());
## 使用interface 讓不同的Factory 實作 並且不同的產品也用不同的interface 所以根據傳入的工廠不同 建立的Istance 也不同
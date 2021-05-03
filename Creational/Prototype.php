<?php
class Prototype
{
    public $primitive;
    public $component;
    public $circularReference;


    public function __clone()
    {
        $this->component = clone $this->component;

        $this->circularReference = clone $this->circularReference;
        $this->circularReference->prototype = $this;
    }

}

class ComponentWithBackReference
{
    public $prototype;

    /**
     * Note that the constructor won't be executed during cloning. If you have
     * complex logic inside the constructor, you may need to execute it in the
     * `__clone` method as well.
     */
    public function __construct(Prototype $prototype)
    {
        $this->prototype = $prototype;
    }
}


/**
 * The client code.
 */
function clientCode()
{
    $p1 = new Prototype();
    $p1->primitive = 245;
    $p1->component = new \DateTime();
    $p1->circularReference = new ComponentWithBackReference($p1);

    $p2 = clone $p1;
    if ($p1->primitive === $p2->primitive) {
        echo "Primitive field values have been carried over to a clone. Yay!\n";
    } else {
        echo "Primitive field values have not been copied. Booo!\n";
    }
    if ($p1->component === $p2->component) {
        echo "Simple component has not been cloned. Booo!\n";
    } else {
        echo "Simple component has been cloned. Yay!\n";
    }

    if ($p1->circularReference === $p2->circularReference) {
        echo "Component with back reference has not been cloned. Booo!\n";
    } else {
        echo "Component with back reference has been cloned. Yay!\n";
    }

    if ($p1->circularReference->prototype === $p2->circularReference->prototype) {
        echo "Component with back reference is linked to original object. Booo!\n";
    } else {
        echo "Component with back reference is linked to the clone. Yay!\n";
    }
}

clientCode();


/**
 * 如果兩個class是同一個class 但是是不同的實體 那麼=== 會給予False 
 * 每一個Class 都需要配置一個clone 來配合 
 * 如果創建起來很複雜 或者執行的時間比較長 直接用clone的會比較快 就適合使用原型模式
 */
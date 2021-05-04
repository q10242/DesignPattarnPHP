<?
interface Component
{
    public function operation(): string;
}

class ConcreteComponent implements Component
{
    public function operation(): string
    {
        return "ConcreteComponent";
    }
}


class Decorator implements Component
{
    protected $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }
    public function operation():string
    {
        return $this->component->operation();
    }
}


class ConcreteDecoratorA extends Decorator
{
    public function operation():string
    {
        return "ConcreteDecoratorA(".parent::operation().")";
    }
}

class ConcreteDecoratorB extends Decorator
{
    public function operation():string
    {
        return "ConcreteDecoratorB(".parent::operation().")";
    }
}

function clientCode(Component $component)
{
    echo "RESULT: ".$component->operation();
}


// 用interface 實做原本的class 並且讓其他class繼承 方便在原來的function 前後加料
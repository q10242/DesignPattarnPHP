<?php
class Target
{
    public function request(): string
    {
        return "Target: the default target's behavior.";
    }
}

class Adaptee
{
    public function specificRequest():string
    {
        return ".eetpadA eht fo roivaheb laicepS";
    }
}

class Adapter extends Target
{
    private $adaptee;
    public function __construct(Adaptee $adaptee)
    {
        $this->adaptee = $adaptee;
    }
    public function request(): string
    {
        return "Adapter: (TRANSLATED) ". strrev($this->adaptee->specificRequest());
    }
}

function clientCode(Target $target)
{
    echo $target->request();
}


echo "Client: I can work just fine with the Target objects:\n";
$target = new Target();
clientCode($target);
echo "\n\n";

$adaptee = new Adaptee();
echo "Client: The Adaptee class has a weird interface. See, I don't understand it:\n";
echo "Adaptee: " . $adaptee->specificRequest();
echo "\n\n";

echo "Client: But I can work with it via the Adapter:\n";
$adapter = new Adapter($adaptee);
clientCode($adapter);

// 它使用了adapter 傳入需要被轉換的Class 然後重寫原本就存在的request 方法 讓客戶端也能使用 因為是extends 所以也可以丟進繼承Target的類型
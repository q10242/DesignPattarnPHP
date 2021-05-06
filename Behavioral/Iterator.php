<?
// 反覆器
class AlphabetcalOrderIterator implements Iterator
{
    private $collection;
    private $position = 0;

    private $reverse = false;
    public function __construct($collection ,$reverse = false)
    {
        $this->collection = $collection;
        $this->reverse = $reverse;
    }

    public function rewind()
    {
        $this->position = $this->reverse? count($this->collection->getItems()) - 1:0;
    }
    
    public function current()
    {
        return $this->collection->getItems()[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        $this->position = $this->position+($this->reverse?-1:1);
    }
    public function valid()
    {
        return isset($this->collection->getItems()[$this->position]);
    }
}

class WordsCollection implements IteratorAggregate
{
    private $items = [];
    public function getItems()
    {
        return $this->items;
    }
    public function addItem($item)
    {
        $this->items[]= $item;
    }
    public function getIterator() :Iterator
    {
        return new AlphabetcalOrderIterator($this);
    }

    public function getReverseIterator(): Iterator
    {
        return new AlphabetcalOrderIterator($this,true);
    }
}


$collection = new WordsCollection();
$collection->addItem("First");
$collection->addItem("Second");
$collection->addItem("Third");
echo "Straight traversal:\n";
foreach ($collection->getIterator() as $item) {
    echo $item . "\n";
}

echo "\n";
echo "Reverse traversal:\n";
foreach ($collection->getReverseIterator() as $item) {
    echo $item . "\n";
}


// 假設你在每一個迭代都有同樣的動作 那麼可以把這個method包進Iterator裡面 讓迭代時就可以自動做好這個動作
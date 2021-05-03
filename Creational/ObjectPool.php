<?php
/**
 * 適合在建立class代價很大 且正在使用的class一次只有幾個的時候
 * 可以增加效能
 * 如果不是這個場合可能會拖慢效能
 */
use Countable;

class WorkPool implements Countable
{

    private array $occupiedWorkers = [];
    private array $freeWorkers = [];

    public function get(): StringReverseWorker
    {
        if(count($this->freeWorkers) == 0) {
            $worker = new StringReverseWorker();
        } else {
            $worker = array_pop($this->freeWorkers);
        }
        $this->occupiedWorkers[spl_object_hash($worker)] = $worker;

        return $worker;
    }


    public function dispose(StringReverseWorker $worker)
    {
        $key = spl_object_hash($worker);

        if(isset($this->occupiedWorkers[$key])) {
            unset($this->occupiedWorkers[$key]);
            $this->occupiedWorkers[$key] = $worker;
        }
    }

    public function count():int
    {
        return count($this->occupiedWorkers)+count($this->freeWorkers);
    }
}

class StringReverseWorker
{
    public function run(string $text)
    {
        return strrev($text);
    }
}

class PoolTest
{
    public function testCanGetNewInstancesWithGet()
    {
        $pool = new WorkPool();
        $worker1 = $pool->get();
        $worker2 = $pool->get();

        if($pool->count()  == 2) {
            echo  "True\n" ;
        } 
        if($worker1 === $worker2) {
            echo "False";
        }else {
            echo "True";
        }
    }

    public function testCanGetSameInstanceTwiceWhenDisposingItFirst()
    {
        $pool = new WorkPool();
        $worker1 = $pool->get();
        $pool->dispose($worker1);
        $worker2 = $pool->get();

        if($pool->count()  == 1) {
            echo  "True\n" ;
        } 
        if($worker1 === $worker2) {
            echo "False";
        }else {
            echo "True";
        }
    }
}
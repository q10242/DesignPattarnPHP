<?php
/**
 * 工廠模式
 */


class SamsBook extends AbstractPHPBook
{
    private $author;
    private $title;
    function __construct() {
        //alternate randomly between 2 books
        mt_srand((double)microtime()*10000000);
        $rand_num = mt_rand(0,1);      
 
        if (1 > $rand_num) {
            $this->author = 'George Schlossnagle';
            $this->title  = 'Advanced PHP Programming';
        } else {
            $this->author = 'Christian Wenz';
            $this->title  = 'PHP Phrasebook'; 
        }  
    }
    function getAuthor() {return $this->author;}
    function getTitle() {return $this->title;}
}

class OreillyBook extends AbstractPHPBook
{   

    private $author;
    private $title;


    private static $oddOrEven = 'Odd'
    function __construct()
    {
        if ('odd' == self::$oddOrEven) {
            $this->author = 'Rasmus Lerdorf and Kevin Tatroe';
            $this->title  = 'Programming PHP';
            self::$oddOrEven = 'even';
        } else {
            $this->author = 'David Sklar and Adam Trachtenberg';
            $this->title  = 'PHP Cookbook'; 
            self::$oddOrEven = 'odd';
        }
    }

    function getAuthor() {return $this->author;}
    function getTitle() {return $this->title;}
}

class VisualQuickstartPHPBook
{
    private $author;
    private $title;
    function __construct() {
      $this->author = 'Larry Ullman';
      $this->title  = 'PHP for the World Wide Web';
    }
    function getAuthor() {return $this->author;}
    function getTitle() {return $this->title;}
}

abstract class  AbstractFactoryMethod
{
    abstract function makePHPBook($param);

}


class OReillyFactoryMethod extends AbstractFactoryMethod 
{
    private $contex = 'OReilly';

    function makePHPBook($param)
    {
        $book = null;
        switch($param) {
        case 'us':
            $book = new OreillyBook;
            break;
        case 'other':
            $book = new SamsBook;
            break;
        default:
            $book= new OreillyBook;
            break;

        }
        return $book;
    }
}


class SamsFactoryMethod extends AbstractFactoryMethod
{
    private $contex = 'Sams';
    function makePHPBook($param)
    {
        $book = null;
        switch($param) {
        case 'us':
            $book = new SamsBook;
            break;
        case 'other':
            $book = new OreillyBook;
            break;
        case "otherother":
            $book = new VisualQuickstartPHPBook;
        break;
        default:
            $book= new SamsBook;
            break;

        }
        return $book;
    }
}


abstract class AbstractBook {
    abstract function getAuthor();
    abstract function getTitle();

}

abstract class AbstractPHPBook extends AbstractBook {
    private $subject = 'PHP';
}
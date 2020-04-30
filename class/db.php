<?php

class Db
{
    
    public static function getConnection()
    {
      if(!file_exists('base.xml')) {
        Db::createBase(); 
        $xml = new XMLReader();
        $xml->open('base.xml');
        return $xml;
      }
      else {
        $xml = new XMLReader();
        $xml->open('base.xml');
        return $xml;
      }
    }
    
    private static function createBase() {
        $xml = new XMLWriter(); //создаем новый экземпляр класса XMLWriter
        $xml->openMemory(); //использование памяти для вывода строки
        $xml->startDocument('1.0', 'utf-8'); //установка версии XML в первом теге документа
        $xml->startElement("users");
        $xml->endElement(); //закрытие корневого элемента
        $xml->endDocument(); //закрытие дкумента
        file_put_contents('base.xml', $xml->outputMemory()); //завершение записи в XML
    }

}
<?php

class Device { 
    private $name;
    private $code;
    private $type;
    private $row;
    private $column;

    function __construct($name, $code, $type, $row, $column) {
        $this->name = $name;
        $this->code = $code;
        $this->type = $type;
        $this->row = $row;
        $this->column = $column;
        
    }

    function getName() { 
        return $this->name;
    }
    function getCode() { 
        return $this->code;
    } 
    function getType() { 
        return $this->type;
    } 
    function getRow() { 
        return $this->row;
    } 
    function getColumn() { 
        return $this->column;
    }  
    function getHTML(){
        $html = '<div id="'.$this->code.'"';
        $html .= ' class="device '.$this->type.'"';
        $html .= 'row="'.$this->row.'"';
        $html .= 'column="'.$this->column.'"></div>';
        return $html;
    }
} 

?>
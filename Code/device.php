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

        if($this->type == "microphone"){        //Mics dont show on the map 
            return "";                          
        }
        $html = '';
        $html .= '<a href="stream.php?code='.$this->code.'" code="'.$this->code.'">';
        $html .= '<div id="'.$this->code.'"';
        $html .= ' class="device '.$this->type.'"';
        $html .= 'row="'.$this->row.'"';
        $html .= 'column="'.$this->column.'"><span class="device-icon">';
        $html .= ($this->type == 'normal' ? '<i id="icon-camera" class="material-icons md-18">camera_alt</i>' :'<i id="icon-vr" class="material-icons md-18">360</i>');
        $html .= '</span></div>';
        $html .= '</a>';
        return $html;
    }
} 

?>
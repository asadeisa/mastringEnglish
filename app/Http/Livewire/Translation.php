<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \Statickidz\GoogleTranslate;

class Translation extends Component
{
   
    public $textvalue;
    public $theArabicRez =null  ;
    public function render()
    {
      
        return view('livewire.translation');
    }
    public function viewTranslate()
    {
        dd("tttt");
        $this->theArabicRez  = $this->getTranslation($this->textvalue);
    }

    public function getTranslation($text,$source='en',$target ='ar')
    {
        // defult trans from en => ar ; 
        $trans = new GoogleTranslate();
        return   $trans->translate($source, $target, $text);

    }

}

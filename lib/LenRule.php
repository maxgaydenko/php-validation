<?php
namespace MaxGaydenko\Validation;

class LenRule extends Rule
{
 public $min = null;
 public $max = null;
 public $tooShort = "Value is too short (min {{min}} characters)";
 public $tooLong = "Value is too long (max {{max}} characters)";

 public function validate($value)
 {
  if($this->isEmpty($value))
   return $this->ok();

  $len = strlen($value."");
  if($this->min !== null && ($this->min > $len))
   return $this->err(str_replace('{{min}}', $this->min, $this->tooShort));
  if($this->max !== null && ($this->max < $len))
   return $this->err(str_replace('{{max}}', $this->max, $this->tooLong));

  return $this->ok();
 }

}
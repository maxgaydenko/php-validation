<?php
namespace MaxGaydenko\Validation;

class IntRule extends Rule
{
 public $min = null;
 public $max = null;
 public $msg = "Value must be an integer";
 public $tooSmall = "Value is too small (min: {{min}})";
 public $tooBig = "Value is too big (max: {{max}})";

 public function validate($value)
 {
  if($this->isEmpty($value))
   return $this->ok();

  if(!self::check($value))
   return $this->err($this->msg);
  if($this->min !== null && ($this->min > $value))
   return $this->err(str_replace('{{min}}', $this->min, $this->tooSmall));
  if($this->max !== null && ($this->max < $value))
   return $this->err(str_replace('{{max}}', $this->max, $this->tooBig));

  return $this->ok();
 }

 public static function check($value)
 {
  return (filter_var($value, FILTER_VALIDATE_INT) !== false);
 }
}
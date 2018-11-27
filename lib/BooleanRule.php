<?php
namespace MaxGaydenko\Validation;

class BooleanRule extends Rule
{
 public $msg = "Value must be a boolean";

 public function validate($value)
 {
  if($this->isEmpty($value))
   return $this->ok();

  return self::check($value)? $this->ok(): $this->err($this->msg);
 }

 public static function check($value)
 {
  return (filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null);
 }


}
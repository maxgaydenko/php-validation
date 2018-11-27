<?php
namespace MaxGaydenko\Validation;

class OneOfRule extends Rule
{
 public $stack = [];
 public $msg = "Invalid value";

 public function validate($value)
 {
  if($this->isEmpty($value))
   return $this->ok();

  return in_array($value, $this->stack)? $this->ok(): $this->err($this->msg);
 }

}
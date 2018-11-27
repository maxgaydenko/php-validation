<?php
namespace MaxGaydenko\Validation;

class RequiredRule extends Rule
{
 public $msg = "Value is required";

 public function validate($value)
 {
  return !$this->isEmpty($value)? $this->ok(): $this->err($this->msg);
 }

}
<?php
namespace MaxGaydenko\Validation;

class RegexpRule extends Rule
{
 public $template = "";
 public $msg = "Invalid value";

 public function validate($value)
 {
  if($this->isEmpty($value))
   return $this->ok();

  return self::check($value, $this->template)? $this->ok(): $this->err($this->msg);
 }

 public static function check($value, $regexp)
 {
  return (filter_var($value, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $regexp]]) !== false);
 }


}
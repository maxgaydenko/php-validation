<?php
namespace MaxGaydenko\Validation;

class EmailRule extends Rule
{
 public $msg = "Invalid e-mail address";

 public function validate($value)
 {
  if($this->isEmpty($value))
   return $this->ok();

  return self::check($value)? $this->ok(): $this->err($this->msg);
 }

 public static function check($email)
 {
  return (filter_var($email, FILTER_VALIDATE_EMAIL) !== false);
 }

}
<?php
namespace MaxGaydenko\Validation;

abstract class Rule
{
 protected $error = null;

 public function __construct(array $params = [])
 {
  $obj_keys = get_object_vars($this);
  foreach ($params as $k => $v) {
   if (array_key_exists($k, $obj_keys))
    $this->{$k} = $v;
  }
 }

 abstract public function validate($value);

 protected function err($error)
 {
  $this->error = $error;
  return false;
 }

 protected function ok()
 {
  $this->error = null;
  return true;
 }

 public function getError()
 {
  return $this->error;
 }

 protected function isEmpty($value, $trim = false)
 {
  return $value === null || $value === array() || $value === '' || $trim && is_scalar($value) && trim($value) === '';
 }
}

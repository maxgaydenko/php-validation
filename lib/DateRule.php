<?php
namespace MaxGaydenko\Validation;

class DateRule extends Rule
{
 public $timezone = null;
 public $format = "Y-m-d";
 public $min = null;
 public $max = null;
 public $msg = "Invalid date";
 public $tooSmall = "Date must be after {{min}}";
 public $tooBig = "Date must be before {{max}}";

 public function validate($value)
 {
  if($this->isEmpty($value))
   return $this->ok();

  $tz = ($this->timezone && $this->timezone instanceof \DateTimeZone)? $this->timezone: null;
  $d = \DateTime::createFromFormat($this->format, $value, $tz);
  if($d === false)
   return $this->err($this->msg);

  if($this->min !== null) {
   $min = ($this->min instanceof \DateTime)? $this->min: \DateTime::createFromFormat($this->format, $this->min, $tz);
   if($min && $min > $d)
    return $this->err(str_replace('{{min}}', $min->format($this->format), $this->tooSmall));
  }
  if($this->max !== null) {
   $max = ($this->max instanceof \DateTime)? $this->max: \DateTime::createFromFormat($this->format, $this->max, $tz);
   if($max && $max < $d)
    return $this->err(str_replace('{{max}}', $max->format($this->format), $this->tooBig));
  }

  return $this->ok();
 }

 public static function check($value, $format, \DateTimeZone $timezone = null)
 {
  return (\DateTime::createFromFormat($format, $value, $timezone) !== false);
 }
}
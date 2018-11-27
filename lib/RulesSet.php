<?php
namespace MaxGaydenko\Validation;

class RulesSet extends Rule
{
 protected static $shorts = [
  'bool' => BooleanRule::class,
  'date' => DateRule::class,
  'email' => EmailRule::class,
  'int' => IntRule::class,
  'len' => LenRule::class,
  'number' => NumberRule::class,
  'oneOf' => OneOfRule::class,
  'regexp' => RegexpRule::class,
  'required' => RequiredRule::class,
 ];
 protected $error = [];
 protected $rules = [];

 protected function addKeyRule($key, Rule $rule)
 {
  if (!isset($this->rules[$key]))
   $this->rules[$key] = [];
  $this->rules[$key][] = $rule;
 }

 public function __construct(array $data = [])
 {
  parent::__construct();
  if($data && count($data) > 0) {
   foreach ($data as $rule) {
    if(is_array($rule) && count($rule) > 1) {
     $key = array_shift($rule);
     $this->add($key, (count($rule)===1 && isset($rule[0]))? $rule[0]: $rule);
//     $this->add($key, $rule);
    }
   }
  }
 }

 public function r() {
  return $this->rules;
 }

 /**
  * @param $key
  * @param $rule
  * @return RulesSet
  */
 public function add($key, $rule)
 {
  if ($rule instanceof Rule) {
   $this->addKeyRule($key, $rule);
  } elseif (is_array($rule)) {
   if (count($rule) > 0 && isset($rule[0]) && isset(self::$shorts[$rule[0]])) {
    $ruleClass = self::$shorts[$rule[0]];
    $this->addKeyRule($key, new $ruleClass($rule));
   }
  } elseif (is_string($rule) && isset(self::$shorts[$rule])) {
   $this->addKeyRule($key, new self::$shorts[$rule]());
  }
  return $this;
 }

 /**
  * @param $value
  * @return bool
  */
 public function validate($value)
 {
  $errors = [];
  foreach ($this->rules as $key => $rules) {
   foreach ($rules as $rule) {
    if (!$rule->validate($this->getValue($value, $key))) {
     $errors[$key] = $rule->getError();
     break;
    }
   }
  }
  $this->error = $errors;
  return !(count($this->error) > 0);
 }

 protected function getValue($data, $key)
 {
  if (is_array($data))
   return isset($data[$key]) ? $data[$key] : null;
  if (is_object($data))
   return isset($data->$key) ? $data->$key : null;
  return null;
 }

 /**
  * @return array
  */
 public function getErrors()
 {
  return $this->error;
 }

}
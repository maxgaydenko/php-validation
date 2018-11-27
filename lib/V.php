<?php
namespace MaxGaydenko\Validation;

class V
{
 public static function bool(array $params = [])
 {
  return new BooleanRule($params);
 }

 public static function date(array $params = [])
 {
  return new DateRule($params);
 }

 public static function email(array $params = [])
 {
  return new EmailRule($params);
 }

 public static function int(array $params = [])
 {
  return new IntRule($params);
 }

 public static function len(array $params = [])
 {
  return new LenRule($params);
 }

 public static function number(array $params = [])
 {
  return new NumberRule($params);
 }

 public static function oneOf(array $params = [])
 {
  return new OneOfRule($params);
 }

 public static function regexp(array $params = [])
 {
  return new RegexpRule($params);
 }

 public static function required(array $params = [])
 {
  return new RequiredRule($params);
 }

 public static function rules(array $data = []) {
  return new RulesSet($data);
 }
}
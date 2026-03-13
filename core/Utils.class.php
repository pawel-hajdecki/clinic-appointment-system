<?php

namespace core;
use DateTime;
/**
 * Wrapper class for basic utility functions
 *
 * @author Przemysław Kudłacik
 */
class Utils {

    public static function addRoute($action, $controller, $roles = null) {
        App::getRouter()->addRoute($action, $controller, $roles);
    }

    public static function addRouteEx($action, $path, $controller, $method, $roles = null) {
        App::getRouter()->addRouteEx($action, $path, $controller, $method, $roles);
    }

    public static function addErrorMessage($text, $index = null) {
        App::getMessages()->addMessage(new Message($text, Message::ERROR), $index);
    }

    public static function addInfoMessage($text, $index = null) {
        App::getMessages()->addMessage(new Message($text, Message::INFO), $index);
    }

    public static function addWarningMessage($text, $index = null) {
        App::getMessages()->addMessage(new Message($text, Message::WARNING), $index);
    }

    private static function _url_maker($action, $params = null) {
        $url = $action;
        if ($params != null && is_array($params)) {
            foreach ($params as $key => $value) {
                if (App::getConf()->clean_urls) {
                    $url .= '/';
                } else {
                    $url .= '&' . $key . '=';
                }
                $url .= $value;
            }
        }
        return $url;
    }

    private static function _url_maker_noclean($action, $params = null) {
        $url = $action;
        if (App::getConf()->clean_urls) {
            $url .= '?';
        }
        if ($params != null && is_array($params)) {
            $first = true;
            foreach ($params as $key => $value) {
                if ($first && App::getConf()->clean_urls){
                    $url .= $key . '=' . $value;
                    $first = false;
                } else {
                    $url .= '&' . $key . '=' . $value;
                }
            }
        }
        return $url;
    }
    public static function URL($action, $params = null) {       
        return App::getConf()->action_url . self::_url_maker($action, $params);
    }

    public static function relURL($action, $params = null) {       
        return App::getConf()->action_root . self::_url_maker($action, $params);
    }

    public static function URL_noclean($action, $params = null) {       
        return App::getConf()->action_url . self::_url_maker_noclean($action, $params);
    }

    public static function relURL_noclean($action, $params = null) {       
        return App::getConf()->action_root . self::_url_maker_noclean($action, $params);
    }

    public static function isEmptyString($str) {
        return (!isset($str) || trim($str) === '');
    }

    public static function intValidateFromRequest(&$validator, $param, $req_message, $invalid_message=null, $min = null, $max = null) {
        $rules = [
            'int' => true,
            'required_message' => $req_message,
            'validator_message' => $invalid_message,
            'numeric' => true,
            'required' => true,
            'default' => null
        ];

        self::setIfNotNull($rules, 'min', $min);
        self::setIfNotNull($rules, 'max', $max);
        return $validator->validateFromRequest($param, $rules);
    }

    public static function stringValidateFromRequest(&$validator, $param, $required = false, $req_message = null, $invalid_message = null, $regexp = null, $min_length = null, $max_length = null) {
        $rules = [
            'trim' => true,
            'default' => null
        ];

        if ($required) {
            $rules['required'] = true;
            self::setIfNotNull($rules, 'required_message', $req_message);
        }
        self::setIfNotNull($rules, 'regexp', $regexp);
        self::setIfNotNull($rules, 'min_length', $min_length);
        self::setIfNotNull($rules, 'max_length', $max_length);
        self::setIfNotNull($rules, 'validator_message', $invalid_message);
        return $validator->validateFromRequest($param, $rules);
    }


    public static function setIfNotNull(&$arr, $index, $value) {
        if ($value !== null) {
            $arr[$index] = $value;
        }
    }

    public static function idValidateFromCleanURL(&$validator, $paramNumber, $required = false, $req_message = null ){
        $rules =[
            'int'=>true,
			'is_numeric' => true,
			'default' => null
        ];

        if($required){
            $rules['required'] = true;
           self::setIfNotNull($rules, 'required_message', $req_message);
        }

        return $validator->validateFromCleanURL($paramNumber, $rules);
    }

    public static function capitalize($str) : string{
        return ucfirst(strtolower($str));
    }

    public static function nameValidateFromRequest(&$validator, $param, $required = false) {
        return self::stringValidateFromRequest($validator, $param, $required, 'Imię wymagane.', 'Imię może zawierać tylko litery (3-50 znaków), pierwsza litera musi być wielka.','/^[\p{L}][\p{L}\-]{2,49}$/u'); // wszystkie litery w standardzie unicode
    }
    public static function surnameValidateFromRequest(&$validator, $param, $required = false) {
        return self::stringValidateFromRequest($validator, $param, $required, 'Nazwisko wymagane.', 'Nazwisko może zawierać tylko litery (3-50 znaków), pierwsza litera musi być wielka.','/^[\p{L}][\p{L}\-]{2,49}$/u'); // wszystkie litery w standardzie unicode
    }

    public static function passwordValidateFromRequest(&$validator, $param, $required = false) {
        // Min 8 znaków, co najmniej 1 wielka litera i 1 cyfra
        return self::stringValidateFromRequest(
            $validator,
            $param,
            $required,
            'Hasło wymagane.',
            'Hasło musi mieć min. 8 znaków oraz zawierać co najmniej jedną wielką literę i jedną cyfrę.',
            '/^(?=.*[A-Z])(?=.*\d).{8,}$/'
        );
    }
}
<?php
namespace app\services;

class Lng {
    public static function getStatusName($status): string{
        switch($status){
            case 'active':
                return 'Aktywny';
            case 'unverified':
                return 'Niezweryfikowany - deklaracja oczekuje na potwierdzenie';
            default:
                return 'Nieznany';
        }
    }
}
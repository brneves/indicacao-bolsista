<?php

namespace Evento\vendor;

class Helper {
    
    /** Dados de entrada para validação */
    private static $Data;
    
    /** Formato para ser validado */
    private static $Format;
    
    /** <b>Slug: </b> Método de criação de slugs para URL amigável */
    public static function Slug($Slug) {
        self::$Format = array();
        self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        self::$Data = strtr(utf8_decode($Slug), utf8_decode(self::$Format['a']), self::$Format['b']);
        self::$Data = strip_tags(trim(self::$Data));
        self::$Data = str_replace(' ', '-', self::$Data);
        self::$Data = str_replace(array('-----', '----', '---', '--'), '-', self::$Data);

        return strtolower(utf8_encode(self::$Data));
    }
    
    public static function mesExtenso($mes) {
        if($mes == 1)
            return 'janeiro';
        if($mes == 2)
            return 'fevereiro';
        if($mes == 3)
            return 'março';
        if($mes == 4)
            return 'abril';
        if($mes == 5)
            return 'maio';
        if($mes == 6)
            return 'junho';
        if($mes == 7)
            return 'julho';
        if($mes == 8)
            return 'agosto';
        if($mes == 9)
            return 'setembro';
        if($mes == 10)
            return 'outubro';
        if($mes == 11)
            return 'novembro';
        if($mes == 12)
            return 'dezembro';
    }
    
}

<?php

namespace JansenFelipe\Utils;

class Utils {

    /**
     * Adiciona máscara em um texto
     *
     * @param  string $texto
     * @return string (Texto com mascara)
     */
    public static function mask($txt, $mascara) {
        if ($mascara == Mask::TELEFONE)
            $mascara = strlen($txt) == 10 ? '(##)####-####' : '(##)#####-####';

        if ($mascara == Mask::DOCUMENTO)
            $mascara = strlen($txt) == 11 ? Mask::CPF : (strlen($txt) == 14 ? Mask::CNPJ : $txt);

        if (empty($txt))
            return '';
        $txt = $this->unmask($txt);
        $qtd = 0;
        for ($x = 0; $x < strlen($mascara); $x++) {
            if ($mascara[$x] == "#")
                $qtd++;
        }

        if ($qtd > strlen($txt)) {
            $txt = str_pad($txt, $qtd, "0", STR_PAD_LEFT);
        }

        if ($txt <> '') {
            $string = str_replace(" ", "", $txt);
            for ($i = 0; $i < strlen($string); $i++) {
                $pos = strpos($mascara, "#");
                $mascara[$pos] = $string[$i];
            }
            return $mascara;
        }
        return $txt;
    }

    /**
     * Remove máscara de um texto
     *
     * @param  string $texto
     * @return string (Texto sem a mascara)
     */
    public static function unmask($texto) {
        return preg_replace('/[\-\|\(\)\/\. ]/', '', $texto);
    }

    /**
     * Metodo para remover acentos de um texto
     * 
     * @param  string $str
     * @return string (Texto sem acentos)
     */
    public static function unaccents($str) {
        $search = explode(",", "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,ø,Ø,Å,Á,À,Â,Ä,È,É,Ê,Ë,Í,Î,Ï,Ì,Ò,Ó,Ô,Ö,Ú,Ù,Û,Ü,Ÿ,Ç,Æ,Œ");
        $replace = explode(",", "c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,o,O,A,A,A,A,A,E,E,E,E,I,I,I,I,O,O,O,O,U,U,U,U,Y,C,AE,OE");
        return str_replace($search, $replace, $str);
    }

    /**
     * Metodo para verificar se um CNPJ é válido
     * 
     * @param  string $cnpj
     * @return boolean
     */
    public static function isCnpj($cnpj) {
        $cnpj = self::unmask($cnpj);
        
        if (empty($cnpj) || $cnpj == '00000000000000')
            return false;

        $dig_1 = 0;
        $dig_2 = 0;
        $controle_1 = 5;
        $controle_2 = 6;
        $resto = 0;

        for ($i = 0; $i < 12; $i++) {
            $dig_1 = $dig_1 + (double) (substr($cnpj, $i, 1) * $controle_1);
            $controle_1 = $controle_1 - 1;
            if ($i == 3)
                $controle_1 = 9;
        }

        $resto = $dig_1 % 11;
        $dig_1 = 11 - $resto;
        if (($resto == 0) || ($resto == 1))
            $dig_1 = 0;

        for ($i = 0; $i < 12; $i++) {
            $dig_2 = $dig_2 + (int) (substr($cnpj, $i, 1) * $controle_2);
            $controle_2 = $controle_2 - 1;
            if ($i == 4)
                $controle_2 = 9;
        }

        $dig_2 = $dig_2 + (2 * $dig_1);
        $resto = $dig_2 % 11;
        $dig_2 = 11 - $resto;

        if (($resto == 0) || ($resto == 1))
            $dig_2 = 0;

        $dig_ver = ($dig_1 * 10) + $dig_2;
        return $dig_ver == (double) (substr($cnpj, strlen($cnpj) - 2, 2));
    }

}

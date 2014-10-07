<?php

namespace JansenFelipe\Utils;

class Utils {

    /**
     * Adiciona máscara em um texto
     *
     * @param  string $texto
     * @return string (Texto com mascara)
     */
    public function mask($txt, $mascara) {
        if ($mascara == Mask::TELEFONE)
            $mascara = strlen($txt) == '10' ? '(##)####-####' : '(##)#####-####';

        if ($mascara == Mask::DOCUMENTO)
            $mascara = strlen($doc) == 11 ? Mask::CPF : (strlen($doc) == 14 ? Mask::CNPJ : $doc);

        if (empty($txt))
            return '';
        $txt = format_unmask($txt);
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
    public function unmask($texto) {
        return preg_replace('/[\-\|\(\)\/\. ]/', '', $texto);
    }

    /**
     * Metodo para remover acentos de um texto
     * 
     * @param  string $str
     * @return string (Texto sem acentos)
     */
    public function unaccents($str) {
        $search = explode(",", "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,ø,Ø,Å,Á,À,Â,Ä,È,É,Ê,Ë,Í,Î,Ï,Ì,Ò,Ó,Ô,Ö,Ú,Ù,Û,Ü,Ÿ,Ç,Æ,Œ");
        $replace = explode(",", "c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,o,O,A,A,A,A,A,E,E,E,E,I,I,I,I,O,O,O,O,U,U,U,U,Y,C,AE,OE");
        return str_replace($search, $replace, $str);
    }

}

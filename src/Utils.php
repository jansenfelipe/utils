<?php

namespace JansenFelipe\Utils;

use Exception;

class Utils {

	/**
	 * Destaca uma palavra em um texto
	 *
	 * @param  string $text (Texto)
	 * @param  string $stringHighlight (Palafra que deseja destacar)
	 * @return string (Texto com palavra destacada em HTML)
	 */
	public static function highlighting($text, $stringHighlight) {
		$value = (string) '<span style="background-color:yellow; color:#000;">' . $stringHighlight . '</span>';
		$str = str_ireplace($stringHighlight, $value, $text);
		echo $str;
	}

	/**
	 * Adiciona máscara em um texto
	 *
	 * @param  string   $txt Texto
	 * @param  Mask     $mascara
	 * @return string (Texto com mascara)
	 */
	public static function mask($txt, $mascara) {
		if ($mascara == Mask::TELEFONE)
			$mascara = strlen($txt) == 10 ? '(##)####-####' : '(##)#####-####';

		if ($mascara == Mask::DOCUMENTO) {
			if (strlen($txt) == 11)
				$mascara = Mask::CPF;
			elseif (strlen($txt) == 14)
				$mascara = Mask::CNPJ;
			else
				return $txt;
		}

		if (empty($txt))
			return '';

		$txt = self::unmask($txt);
		$qtd = 0;
		for ($x = 0; $x < strlen($mascara); $x++) {
			if ($mascara[$x] == "#")
				$qtd++;
		}

		if ($qtd > strlen($txt)) {
			$txt = str_pad($txt, $qtd, "0", STR_PAD_LEFT);
		}
		elseif ($qtd < strlen($txt)) 
		{
			return $txt;
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
		return preg_replace('/[\-\|\(\)\/\.\: ]/', '', $texto);
	}

	/**
	 * Metodo para remover acentos de um texto
	 *
	 * @param  string $str
	 * @return string (Texto sem acentos)
	 */
	public static function unaccents($str) {
		$search = explode(",", "ç,æ,œ,á,é,í,ó,ú,à,ã,è,ì,ò,ù,ä,ë,ï,ö,õ,ü,ÿ,â,ê,î,ô,û,å,ø,Ø,Å,Á,À,Â,Ä,È,É,Ê,Ë,Í,Î,Ï,Ì,Ò,Ó,Ô,Ö,Ú,Ù,Û,Ü,Ÿ,Ç,Æ,Œ");
		$replace = explode(",", "c,ae,oe,a,e,i,o,u,a,a,e,i,o,u,a,e,i,o,o,u,y,a,e,i,o,u,a,o,O,A,A,A,A,A,E,E,E,E,I,I,I,I,O,O,O,O,U,U,U,U,Y,C,AE,OE");
		return str_replace($search, $replace, $str);
	}

	/**
	 * Metodo para verificar se um CNPJ é válido
	 *
	 * @param  string $cnpj
	 * @return boolean
	 */
	public static function isCnpj($cnpj) {
		$valid = true;
		$cnpj = str_pad(self::unmask($cnpj), 14, '0', STR_PAD_LEFT);

	if(!ctype_digit($cnpj))
			return false;

		for ($x = 0; $x < 10; $x++) {
			if ($cnpj == str_repeat($x, 14)) {
				$valid = false;
			}
		}

		if ($valid) {
			if (strlen($cnpj) != 14) {
				$valid = false;
			} else {
				for ($t = 12; $t < 14; $t ++) {
					$d = 0;
					$c = 0;
					for ($m = $t - 7; $m >= 2; $m --, $c ++) {
						$d += $cnpj {$c} * $m;
					}
					for ($m = 9; $m >= 2; $m --, $c ++) {
						$d += $cnpj {$c} * $m;
					}
					$d = ((10 * $d) % 11) % 10;
					if ($cnpj {$c} != $d) {
						$valid = false;
						break;
					}
				}
			}
		}

		return $valid;
	}

	/**
	 * Metodo para verificar se um CPF é válido
	 *
	 * @param  string $cpf
	 * @return boolean
	 */
	public static function isCpf($cpf) {
		$valid = true;
		$cpf = str_pad(self::unmask($cpf), 11, '0', STR_PAD_LEFT);

	if(!ctype_digit($cpf))
			return false;

		for ($x = 0; $x < 10; $x ++) {
			if ($cpf == str_repeat($x, 11)) {
				$valid = false;
			}
		}

		if ($valid) {
			if (strlen($cpf) != 11) {
				$valid = false;
			} else {
				for ($t = 9; $t < 11; $t ++) {
					$d = 0;
					for ($c = 0; $c < $t; $c ++) {
						$d += $cpf {$c} * (($t + 1) - $c);
					}
					$d = ((10 * $d) % 11) % 10;
					if ($cpf{$c} != $d) {
						$valid = false;
						break;
					}
				}
			}
		}

		return $valid;
	}

	/**
	 * Metodo para verificar se um Email é válido
	 *
	 * @param  string $email
	 * @return boolean
	 */
	public static function isEmail($email) {
		return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	/**
	 * Formata valor monetário
	 *
	 * @param  string $email
	 * @return boolean
	 */
	public static function moeda($valor = 0, $simbolo = 'R$', $decimal = 2) {

		if (!is_numeric($valor))
			throw new Exception('$valor nao é um numero válido');

		if (!is_int($decimal))
			throw new Exception('$decimal nao é um numero inteiro');

		return $simbolo . ' ' . number_format($valor, $decimal, ',', '.');
	}

	/**
	 * Retira formatação de valor monetário
	 *
	 * @param  string $email
	 * @return boolean
	 */
	public static function unmoeda($string = "", $simbolo = 'R$') {
		$string = str_replace('.', '', str_replace($simbolo, '', $string));
		return floatval(str_replace(',', '.', $string));
	}

	/**
	 * Metodo para verificar se um Endereço Mac é válido
	 *
	 * @param  string $mac
	 * @return boolean
	 */
	public static function isMac($mac) {
		$mac = self::mask(self::unmask($mac), Mask::MAC);
		return (bool) filter_var($mac, FILTER_VALIDATE_MAC);
	}

	/**
	 * Metodo para verificar se um Endereço Ip é válido
	 *
	 * @param  string $ip
	 * @return boolean
	 */
	public static function isIp($ip) {
		return (bool) filter_var($ip, FILTER_VALIDATE_IP);
	}

	/**
	 * [mostrarData Método que recebe uma data em um formato qualquer e mostra no formato desejado]
	 * @param  [string] $data               [description]
	 * @param  string $formatoData        [Formato de saída desejado para a data - br ou en]
	 * @param  string $caractereSeparacao [Caractere de separação desejado para a data]
	 * @return [string]                     [description]
	 */
	public static function mostrarData($data, $formatoData = "br", $caractereSeparacao = "/") {
		$dataSaida = '';
		$data_explode = (strpos($data, "/") !== false) ? explode('/', $data) : explode('-', $data); 
		
		if ($formatoData == "br") {

			if (strlen($data_explode[0]) == 2 )
				$dataSaida = $data_explode[0] . $caractereSeparacao . $data_explode[1]. $caractereSeparacao . $data_explode[2];
			else
				$dataSaida = $data_explode[2] . $caractereSeparacao . $data_explode[1] . $caractereSeparacao . $data_explode[0];

		} else {
			if (strlen($data_explode[0]) == 4 )
				$dataSaida = $data_explode[0] . $caractereSeparacao . $data_explode[1]. $caractereSeparacao . $data_explode[2];
			else
				$dataSaida = $data_explode[2] . $caractereSeparacao . $data_explode[1] . $caractereSeparacao . $data_explode[0];
			
		}
		return $dataSaida;
}

}

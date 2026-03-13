<?php
/**
 * BRCode Pix Generator (v4 - Bank-Safe Version)
 */
class PixPayload {
    private $pixKey;
    private $amount;
    private $merchantName;
    private $merchantCity;

    public function __construct($pixKey, $amount = '', $merchantName = 'TRANS PROCRED', $merchantCity = 'SAO PAULO') {
        $this->pixKey = preg_replace('/\s+/', '', trim($pixKey));
        $this->amount = $amount ? number_format((float)$amount, 2, '.', '') : '';
        $this->merchantName = $this->cleanString($merchantName, false);
        $this->merchantCity = $this->cleanString($merchantCity, false);
    }

    private function cleanString($string, $removeSpaces = false) {
        $string = preg_replace(
            ['/[áàãâä]/u','/[éèêë]/u','/[íìîï]/u','/[óòõôö]/u','/[úùûü]/u','/[ç]/u','/[ÁÀÃÂÄ]/u','/[ÉÈÊË]/u','/[ÍÌÎÏ]/u','/[ÓÒÕÔÖ]/u','/[ÚÙÛÜ]/u','/[Ç]/u'],
            ['a','e','i','o','u','c','A','E','I','O','U','C'],
            $string
        );
        $string = preg_replace('/[^A-Za-z0-9 ]/', '', $string);
        if ($removeSpaces) $string = str_replace(' ', '', $string);
        return strtoupper(trim($string));
    }

    private function montaCampo($id, $valor) {
        $tamanho = str_pad(strlen($valor), 2, '0', STR_PAD_LEFT);
        return $id . $tamanho . $valor;
    }

    public function getPayload() {
        $payload = '000201';
        $merchantAccount = $this->montaCampo('00', 'BR.GOV.BCB.PIX')
                         . $this->montaCampo('01', $this->pixKey);
        $payload .= $this->montaCampo('26', $merchantAccount);
        $payload .= '52040000';
        $payload .= '5303986';
        if (!empty($this->amount)) $payload .= $this->montaCampo('54', $this->amount);
        $payload .= '5802BR';
        $payload .= $this->montaCampo('59', substr($this->merchantName, 0, 20));
        $payload .= $this->montaCampo('60', substr($this->merchantCity, 0, 15));
        $payload .= $this->montaCampo('62', $this->montaCampo('05', '***'));
        $payload .= '6304';
        $payload .= $this->crc16($payload);
        return $payload;
    }

    private function crc16($payload) {
        $polynomial = 0x1021;
        $result = 0xFFFF;
        for ($i = 0; $i < strlen($payload); $i++) {
            $result ^= ord($payload[$i]) << 8;
            for ($bitwise = 0; $bitwise < 8; $bitwise++) {
                if (($result <<= 1) & 0x10000) $result ^= $polynomial;
                $result &= 0xFFFF;
            }
        }
        return strtoupper(str_pad(dechex($result), 4, '0', STR_PAD_LEFT));
    }
}

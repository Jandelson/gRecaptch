<?php
/**
 * Validação gRecaptch.
 *
 * @package     gRecaptch
 * @name        gRecaptch google
 * @version     1.0.0
 * @copyright   2017 &copy; Jandelson Oliveira
 * @link        http://www.jandelson.tk/
 * @author      Jandelson Oliveira
 *
 */
class gRecaptch {
    const  google_url = "https://www.google.com/recaptcha/api/siteverify";
    public $secret;
    public $recaptcha;
    public $ip;

    public function __construct($secret)
    {
        $this->secret = $secret;
    }

    private function getCurlData($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        $curlData = curl_exec($curl);
        curl_close($curl);
        return $curlData;
    }

    public function ValidaRecaptcha($recaptcha,$ip)
    {
        $this->recaptcha = $recaptcha;
        $this->ip = $ip;

        if (!empty($this->recaptcha)) {
            $url=self::google_url."?secret=".$this->secret."&response=".$this->recaptcha."&remoteip=".$this->ip;
            $res=$this->getCurlData($url);
            $res = json_decode($res, true);
            //reCaptcha success check
            if ($res['success']) {
                return $res['success'];
            } else {
                return "informar ReCAPTCHA.";
            }

        } else {
            return $msg="Erro ao informar ReCAPTCHA Vazio.";
        }
    }
}
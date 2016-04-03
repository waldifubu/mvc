<?php
namespace Util;

use Core\Session;

class Auth
{
    public static function handleLogin()
    {
        if (!isset($_SESSION)) {
            Session::init();
        }

        if (isset($_SESSION['timeout'])) {
            $logged = $_SESSION['loggedIn'];

            if (time() > $_SESSION['timeout']) {
                $logged = false;
            } else {
                $_SESSION['timeout'] = time() + 15 * 60;
                $logged = true;
            }
        }


        if ($logged == false) {
            session_destroy();
            header('Location: ' . URL . 'login');
        }
    }

    /**
     * simple method to encrypt or decrypt a plain text string
     * initialization vector(IV) has to be the same when encrypting and decrypting
     * PHP 5.4.9
     *
     * this is a beginners template for simple encryption decryption
     * before using this in production environments, please read about encryption
     *
     * @param string $action : can be 'encrypt' or 'decrypt'
     * @param string $string : string to encrypt or decrypt
     *
     * @return string
     */
    public function encryptDecrypt($action, $string)
    {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';

        // hash
        $key = hash('sha512', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha512', $secret_iv), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

    public function encrypt(string $string)
    {
        return $this->encryptDecrypt('encrypt', $string);
    }

    public function decrypt(string $string)
    {
        return $this->encryptDecrypt('decrypt', $string);
    }

}

/*
$a = new Auth();
echo $a->encrypt('Gregor oist cool');
echo "\n";
echo $a->decrypt('dkhrQmRYbkJWZ2ZGMmZRc1Z6TnljUT09');
*/
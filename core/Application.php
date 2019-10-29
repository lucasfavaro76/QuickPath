<?php

namespace core;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Application
{

    static $APP_NAME = 'Quick Path';
    static $HOST = 'localhost/QuickPath/';
    static $HOME = 'app\view\Home'; //..home page

    //------- icons -------------
    static $ICON_SUCCESS = 'core/icon/checked.png';
    static $ICON_ERROR = 'core/icon/.....';
    static $ICON_NOT_FOUND = 'core/icon/....';

    //------- messages ----------
    static $MSG_TITLE = 'Mensagem do Sistema';
    static $MSG_SUCCESS = 'Operação realizada com sucesso!';
    static $MSG_ERROR = 'Erro durante a operação';
    static $MSG_NOT_FOUND = 'Objeto não encontrado';
    static $MSG_ACTIVATE = 'Cadastro ativado com sucesso! Faça o login!';
    static $MSG_INCORRECT_LOGIN = 'Dados incorretos!';
    static $MSG_VAZIO = 'Nenhum registro encontrado!!!';

    //-------- email -------------
    static $EMAIL = 'lukasfavaro555@gmail.com';
    static $EMAIL_PASSWD = 'Aerochord#2018';

    public static function start()
    {
        (new self::$HOME())->show();
    }

    //..send mail
    public static function sendEmail($dest, $subject, $msg)
    {
        //..load the classes of PHPMailer
        //require_once 'core/vendor/phpmailer-5.2/PHPMailerAutoload.php';       

        require 'core/vendor/PHPMailer/src/Exception.php';
        require 'core/vendor/PHPMailer/src/PHPMailer.php';
        require 'core/vendor/PHPMailer/src/SMTP.php';
        //require 'autoload.php';
        
        //..instantiate a new PHPMailer class - the true parameter supports exception treatment.
        $mail = new PHPMailer(true);
        try {
            //..Prepare for hotmail.com - to use other mail servers, verify the configurations.
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; 
            $mail->isSMTP();  
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username = self::$EMAIL;
            $mail->Password = self::$EMAIL_PASSWD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port = 587;

            $mail->CharSet = 'utf-8';
                                              
            //..from email
            $mail->setFrom('lukasfavaro555@gmail.com', self::$APP_NAME);
           
            //..set the destiny, the subject and the message
            $mail->addAddress($dest);
            $mail->Subject = $subject;
            $mail->msgHTML($msg);
            //..send the mail
            $mail->send();

        } catch (Exception $ex) {
            throw new Exception("[Erro do PHPMailer] {$ex->getMessage()}", 0, $ex);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}

<?php
namespace Concrete\Package\LoginNotification;

use Concrete\Core\Logging\Logger;
use Detection\MobileDetect;
use Request;

class Controller extends \Package
{

    protected $pkgHandle = 'login_notification';
    protected $appVersionRequired = '5.7.4';
    protected $pkgVersion = '0.9.1';

    public function getPackageDescription()
    {
        return t("Get notifications when users login.");
    }

    public function getPackageName()
    {
        return t("Login Notification");
    }

    public function install()
    {
        parent::install();

        // Make sure we load everything.
        $this->on_start();
    }

    public function on_start()
    {
        \Events::addListener('on_user_login', function ($event) {
            /* @type \Concrete\Core\User\Event\User $event */
            //\Log::addInfo(print_r($ue, true));
            /* @type \User $ue */
            $ue = $event->getUserObject();
            $ui = \UserInfo::getByID($ue->getUserID());

            $ip_s = \Core::make('ip');
            $ip_addr = $ip_s->getRequestIP();
            $ip_formatted = $ip_addr->getIp($ip_addr::FORMAT_IP_STRING);
            $req = Request::getInstance();
            $user_agent = $req->headers->get('User-Agent');

            $mail = \Core::make('mail');

            if (\Config::get('concrete.user.registration.email_registration')) {
                $mail->addParameter('uName', $ui->getUserEmail());
            } else {
                $mail->addParameter('uName', $ui->getUserName());
            }
            $mail->addParameter('ip_address', $ip_formatted);
            $mail->addParameter('user_agent', $user_agent);
            $mail->addParameter('date_time', date('F j, Y, g:i A T'));
            $mail->addParameter('sitename', \Config::get('concrete.site'));

            $mail->to($ui->getUserEmail());
            $mail->load('login_notification', 'login_notification');
            @$mail->sendMail();
        });

    }

}

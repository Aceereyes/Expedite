<?php
namespace App\Mailer;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer extends PHPMailer {
    public function __construct() {
        $this->IsSMTP();
        $this->CharSet = "utf-8";
        $this->SMTPAuth = config('app.email.smtp_auth');
        $this->Username = config('app.email.username');
        $this->Password = config('app.email.password');
        $this->SMTPSecure= config('app.email.smtp_secure');
        $this->Host = config('app.email.host');
        $this->Port = config('app.email.port');
        $this->From = config('app.email.from');
        $this->FromName = config('app.email.fromName');
    }
    public function AddAddresses(array $addresses) {
        foreach($addresses as $email)
        {
            $this->addAddress($email);
        }
    }
}
?>
<?php



class Employee extends Db_object 
{

    public function __construct()
    {
        parent::__construct("employees");
    }

    protected static $db_table_fields = array('email', 'param_link');
    public $id;
    public $email;
    public $param_link;

    public function send_email_employee($email,$link)
    {
        $mail_c = new Mail();

        $subject = "Hello ";
        $body = "hello ". $email . "<br>" . $link;
        $confirm_email = $email;

        $mail_c->config_mail($email, $subject, $body);
       
    }
}


<?php



class Customer extends Db_object 
{
    
    protected static $db_table_fields = array('fname', 'lname', 'email', 'phone', 'param_link');
    public $id;
    public $fname;
    public $lname;
    public $email;
    public $phone;
    public $param_link;

    public function __construct()
    {
        parent::__construct("customers");
    }

    public function send_email_employee($email,$link)
    {
        $mail_c = new Mail();

        $subject = "Hello ";
        $body = "hello ". $email . "<br>" . $link;
        $confirm_email = $email;

        $mail_c->config_mail($email, $subject, $body);
       
    }

    public function limition_customers($param_link)
    {
        $the_result_array = parent::find_by_query("SELECT param_link , COUNT(param_link) AS param_link FROM customers WHERE param_link = '$param_link' ");

        // if

        return !empty($the_result_array) ? array_shift($the_result_array) : false;
        // return parent::find_by_query("SELECT COUNT(param_link) FROM customers WHERE param_link = '$param_link' ");
    }
}


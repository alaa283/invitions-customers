<!DOCTYPE html>
<html lang="en">
    <!-- Start head -->
    <?php
            
        require_once "./head.php";

        $email = $param_link = "";
        $email_err = $done = "";

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            // Validate email
                if(empty(trim($_POST["email"])))
                {
                    $email_err = "Please enter a email.";
                }
                elseif(!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/', trim($_POST["email"])))
                {
                    $email_err = "Username can only contain letters, numbers, and underscores.";
                }

                else
                {
                    $confirm_email = new Employee();
                    // $confirm_email->find_by_id(1);
                    // echo $confirm_email->email;

                    $email_con = $_POST["email"];

                    if($confirm_email->find_by_id("$email_con") == true)
                    {
                        $email_err = "This username is already taken.";
                    }
                    else 
                    {
                        // $_POST["email"];
                        $employee = new Employee();
                        $email = $employee->email = $_POST['email'];
                        $param_link = $employee->param_link= password_hash($email, PASSWORD_DEFAULT); // Creates a password hash

                        if($confirm_email->find_by_id2("$param_link") == true)
                        {
                            $email_err = "try again";
                        }

                        else
                        {
                            $employee-> send_email_employee("$email","http://localhost/loreal/register.php?register=$param_link");
                            $employee-> create("$email", "$param_link");
                            $done = "Thank You! please check your email. ";
                        }
                    }
                }
        }

    ?>
<!-- end head -->
<body>
        <!-- Registration Start -->
            <div class="container py-5">
                <form method="POST">
                    <div class="form-group">
                        
                        <?php
                            if(empty($done))
                            {
                        ?>
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; echo (!empty($done)) ? 'd-none' : ''; ?> " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $email; ?>">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        <div class="mt-3">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                        <?php
                            }
                            else
                            {
                        ?>
                        <div class="alert alert-success <?php echo (!empty($done)) ? '' : 'd-none'; ?>" role="alert">
                            <?php echo $done; ?>
                        </div>
                        <?php } ?>
                    </div>
                    
                </form>
            </div>
        <!-- Registration End -->

        <?php

        // $database = new Database();
        // $database->open_db_connection();

        // $employee = new Employee();



        //     $email = $employee->email = "Example_username";
        //     $param_link = $employee->param_link = "Example_password";

        //     $employee->create($email, $param_link);

        require_once "./footer.php";

        ?>
</body>
</html>
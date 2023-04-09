<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php

    require_once "./head.php";

    $fname = $lname = $email = $param_link = "";
    $email_err = $done = $expire = "";

    if(isset($_GET['register']))
    {
        $param_link = $_GET['register'];
        $link_register = new Employee();
        
        if($link_register->find_by_id2("$param_link") == true)
        {
            $link_customer = new Customer();
            $check = $link_customer->limition_customers("$param_link");
            if($link_customer->limition_customers("$param_link") == true)
            {
                if($check->param_link == 3)
                {
                    $expire = "Sorry! This Link is expired";
                }
                else
                {
                    $expire = "";
                }

            }
            $employee_link = $link_register->find_by_id2("$param_link");
            // print_r($employee_link);
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                if(($_POST["email"]))
                {
                    $confirm_email = new Customer();
                    $email = $_POST["email"];

                    if($confirm_email->find_by_id("$email") == true)
                    {
                        $email_err = "This username is already taken.";
                    }
                    else
                    {
                        $fname = $confirm_email->fname =  $_POST["fname"];
                        $lname = $confirm_email->lname = $_POST["lname"];
                        $email = $confirm_email->email = $_POST["email"];
                        $phone = $confirm_email->phone = $_POST["phone"];
                        $param_link = $confirm_email->param_link =  $_GET["register"];

                        // echo $employee_link->email;
                        $confirm_email-> send_email_employee("$email","Thank you for registeration");
                        // $confirm_email-> send_email_employee("$employee_link->email","Add User used my link $email");
                        $confirm_email->create("$fname", "$lname", "$email", $phone, "$param_link");
                        $done = "Thank You! please check your email. ";
                    }
                }
            }
            ?>
                <div class="container py-5"> 
            <?php

                if(empty($done) && empty($expire))
            {
            ?>
            <form method="POST">
                    <div class="form-group">
                        <label for="exampleInputFname">First Name</label>
                        <input type="text" class="form-control" id="exampleInputFname" name="fname" aria-describedby="emailHelp" placeholder="Enter First Name" value="<?php echo $fname; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputLname">Last Name</label>
                        <input type="text" class="form-control" id="exampleInputLname" name="lname" aria-describedby="emailHelp" placeholder="Enter Last Name" value="<?php echo $lname; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $email; ?>" required>
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPhone">Phone</label>
                        <input type="number" class="form-control" id="exampleInputPhone"  name="phone" aria-describedby="emailHelp" placeholder="Enter Phone" value="<?php echo $phone; ?>" required>
                    </div>


                    <!-- <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php
            }
            else if(!empty($done) && empty($expire))
            {
                ?>

                <div class="alert alert-success <?php echo (!empty($done)) ? '' : 'd-none'; ?>" role="alert">
                    <?php echo $done; ?>
                </div>

                <?php
            }
            else
            {
                ?>
                  <div class="alert alert-danger <?php echo (!empty($expire)) ? '' : 'd-none'; ?>" role="alert">
                        <?php echo $expire; ?>
                    </div>
                <?php
            }
        // }
            ?>
                     
                


            </div>
            <?php
        }
        else
        {
        ?>
        <div class="container py-5">  
            <div class="alert alert-danger" role="alert">
                Link wrong! Please try again
            </div>
        </div>
        <?php
        }
    }
    else
    {
        ?>
        <div class="container py-5">  
            <div class="alert alert-danger" role="alert">
                Please try again
            </div>
        </div>
        <?php
    }



    ?>
</body>
</html>
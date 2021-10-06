<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = check_input($_POST['name']);
    $email = check_input($_POST['email']);
    $password = md5(check_input($_POST['password']));
    $address = check_input($_POST['address']);
    $linkedinurl = check_input($_POST['linkedinurl']);

    $error_msg = [];

//validation
    if (empty($name)) {
        $error_msg = "Name field is required";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $error_msg['name'] = "Name must be string chars,-,'";
    }
    if (empty($email)) {
        $error_msg['Email'] = "Email field is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg['Email'] = "This Email is Invalid Email";
    }
    if (empty($password)) {
        $error_msg['password'] = "You Must Enter password";
    } elseif (strlen($password) < 6) {
        $error_msg['password'] = "You Password Must be more than 6 characters";
    }
    if (empty($address)) {
        $error_msg['address'] = "Address field is required";
    } elseif (strlen($address) < 10 or strlen($address) > 10) {
        $error_msg['address'] = "Address field lenght must be 10 characters";
    }
    if (empty($_POST['gender'])) {
        $error_msg['gender'] = "you must Select your gender";
    } else {
        $gender = check_input($_POST['gender']);
    }
    if (empty($linkedinurl)) {
        $error_msg['linkedinurl'] = "you must Enter your Linkedin url";
    } elseif (!filter_var($linkedinurl, FILTER_VALIDATE_URL)) {
        $error_msg['linkedinurl'] = "Invalid Linkedin url";
    }

    if (count($error_msg) > 0) {
        foreach ($error_msg as $key => $value) {
            echo '* ' . $key . ' :  ' . $value . '<br>';
        }
    } else {
        echo "valid Data";
    }

}
function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form|Page</title>
    <style>
        * {
            box-sizing: border-box;
        }

        input[type=text], radiobutton, .pass , .email{
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .col-25 {
            float: left;
            width: 15%;
            margin-top: 6px;
        }

        .col-75 {
            float: left;
            width: 65%;
            margin-top: 6px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        .submit{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .col-25, .col-75, input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-25">
                <label for="name"><b>Name : </b></label>
            </div>
            <div class="col-75">
                <input type="text" id="name" name="name" placeholder="Your name..">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="email"><b>Email : </b></label>
            </div>
            <div class="col-75">
                <input type="email" id="email" name="email" class="email" placeholder="Your Email..">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="country"><b>Password : </b></label>
            </div>
            <div class="col-75">
                <input type="password" id="password" name="password" class="pass" placeholder="Your Password..">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="subject"><b>Address : </b></label>
            </div>
            <div class="col-75">
                <input type="text" id="address" name="address" placeholder="Your Address..">
            </div>
        </div>
        <br><div class="row">
            <div class="col-25">
                <label for="subject"><b>Gender : </b></label>
            </div>
            <div class="col-75">
                <input type="radio" name="gender" value="Male"><b>Male</b>
                <input type="radio" name="gender" value="female"><b>Female</b>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-25">
                <label for="subject"><b>Linkedin Url : </b></label>
            </div>
            <div class="col-75">
                <input type="text" id="linkedinurl" name="linkedinurl" placeholder="Your Linkedin Url..">
            </div>
        </div>
        <br>

        <div class="submit">
            <input type="submit" value="Submit">
        </div>
    </form>
</div>

</body>
</html>

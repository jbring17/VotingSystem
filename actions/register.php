<?php
    include('connect.php');

    $username=$_POST['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $image=$_FILES['photo']['name'];
    $tmp_name=$_FILES['photo']['tmp_name'];
    $std=$_POST['std'];

    if ($password != $cpassword) {
        echo '<script>
        alert("Passwords do not match");
        window.location="../partials/registration.html";
        </script>';
    } 
    else {
        if ($std == 'voter') {
            $user_check_query = "SELECT * FROM `voters` WHERE username='$username' LIMIT 1";
            $result = mysqli_query($conn, $user_check_query);
            $user = mysqli_fetch_assoc($result);

            if ($user) { // if user exists
                echo '<script>
                alert("Username already taken.");
                window.location="../partials/registration.html";
                </script>';
            } 
            else {
                move_uploaded_file($tmp_name,"../uploads/$image");
                $password = md5($password);
                $sql="INSERT INTO `voters` (username, password, photo, status) 
                VALUES ('$username', '$password', '$image', 0)";
            
                $result = mysqli_query($conn, $sql);
            
                if ($result) {
                    echo '<script>
                    alert("Registration Successful");
                    window.location="../";
                    </script>';
                }
            }
        }
        else {
            $group_check_query = "SELECT * FROM `groups` WHERE username='$username' LIMIT 1";
            $result = mysqli_query($conn, $group_check_query);
            $group = mysqli_fetch_assoc($result);

            if ($group) { // if group exists
                echo '<script>
                alert("Username already taken.");
                window.location="../partials/registration.html";
                </script>';
            } 
            else {
                move_uploaded_file($tmp_name,"../uploads/$image");
                $password = md5($password);
                $sql="INSERT INTO `groups` (username, password, photo, votes) 
                VALUES ('$username', '$password', '$image', 0)";
            
                $result = mysqli_query($conn, $sql);
            
                if ($result) {
                    echo '<script>
                    alert("Registration Successful");
                    window.location="../";
                    </script>';
                }
            }
        }
    }
?>
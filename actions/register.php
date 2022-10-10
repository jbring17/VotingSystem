<?php
    include('connect.php');

    $username=$_POST['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $image=$_FILES['photo']['name'];
    $tmp_name=$_FILES['photo']['tmp_name'];
    $std=$_POST['std'];

    if ($username == '') {
        echo json_encode(['error' => 'Attempting to directly access the page.']);
    }
    else if ($password != $cpassword) {
        echo json_encode(['error' => 'Passwords do not match.']);
    } 
    else {
        if ($std == 'voter') {
            $user_check_query = "SELECT * FROM `voters` WHERE username='$username' LIMIT 1";
            $result = mysqli_query($conn, $user_check_query);
            $user = mysqli_fetch_assoc($result);

            if ($user) { // if user exists
                echo json_encode(['error' => 'Username taken.']);
            } 
            else {
                move_uploaded_file($tmp_name,"../uploads/$image");
                $password = md5($password);
                $sql="INSERT INTO `voters` (username, password, photo, status) 
                VALUES ('$username', '$password', '$image', 0)";
            
                $result = mysqli_query($conn, $sql);
            
                if ($result) {
                    echo json_encode(['login' => '../']);
                }
            }
        }
        else {
            $group_check_query = "SELECT * FROM `groups` WHERE username='$username' LIMIT 1";
            $result = mysqli_query($conn, $group_check_query);
            $group = mysqli_fetch_assoc($result);

            if ($group) { // if group exists
                echo json_encode(['error' => 'Username taken.']);
            } 
            else {
                move_uploaded_file($tmp_name,"../uploads/$image");
                $password = md5($password);
                $sql="INSERT INTO `groups` (username, password, photo, votes) 
                VALUES ('$username', '$password', '$image', 0)";
            
                $result = mysqli_query($conn, $sql);
            
                if ($result) {
                    echo json_encode(['login' => '../']);
                }
            }
        }
    }
?>
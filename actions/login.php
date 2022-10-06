<?php
    session_start();
    include('connect.php');

    $username=$_POST['username'];
    $password=$_POST['password'];
    $std=$_POST['std'];

    $password = md5($password);

    if ($std == 'voter') {
        $check_credentials = "SELECT * FROM `voters` WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $check_credentials);

        if (mysqli_num_rows($result) == 1) { // if user exists
        
            $sql = "SELECT id, username, photo, votes FROM `groups`";
            $result_group = mysqli_query($conn, $sql);
    
            if (mysqli_num_rows($result_group) > 0) {
                $groups = mysqli_fetch_all($result_group, MYSQLI_ASSOC);
                $_SESSION['groups'] = $groups;
            }
    
            $data = mysqli_fetch_array($result);
    
            $_SESSION['id'] = $data['id'];
            $_SESSION['status'] = $data['status'];
            $_SESSION['std'] = 'voter';
            $_SESSION['data'] = $data;
            
            echo '<script>
            window.location="../partials/user-dashboard.php";
            </script>';
        }
        else {
            echo '<script>
            alert("Invalid Credentials");
            window.location="../";
            </script>'; 
        }
    }
    else {
        $check_credentials = "SELECT * FROM `groups` WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $check_credentials);

        if (mysqli_num_rows($result) == 1) { // if group exists
            $data = mysqli_fetch_assoc($result);
            
            $_SESSION['id'] = $data['id'];
            $_SESSION['std'] = 'group';
            $_SESSION['data'] = $data;

            echo '<script>
            window.location="../partials/group-dashboard.php";
            </script>';
        }
        else {
            echo '<script>
            alert("Invalid Credentials");
            window.location="../";
            </script>'; 
        }
    }
?>
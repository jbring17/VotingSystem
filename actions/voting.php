<?php
    session_start();
    include('connect.php');

    $votes=$_POST['group-votes'];
    $totalvotes=$votes + 1;
    
    $groupid=$_POST['group-id'];
    $uid=$_SESSION['id'];

    $updatevotes=mysqli_query($conn, "UPDATE `groups` SET votes='$totalvotes' WHERE id='$groupid'");

    $updateuserstatus=mysqli_query($conn, "UPDATE `voters` SET status=1 WHERE id='$uid'");

    if ($updatevotes && $updateuserstatus) {
        $getgroups=mysqli_query($conn, "SELECT id, username, photo, votes FROM `groups`");
        $groups=mysqli_fetch_all($getgroups, MYSQLI_ASSOC);
        $_SESSION['groups'] = $groups;
        $_SESSION['status'] = 1;

        echo '<script>
        alert("Voting Succesful");
        window.location="../partials/user-dashboard.php";
        </script>';
    }
    else {
        echo '<script>
        alert("Tecchnical Error While Voting");
        window.location="../partials/user-dashboard.php";
        </script>';
    }
?>
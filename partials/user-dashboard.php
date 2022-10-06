<?php
    session_start();
    if (!isset($_SESSION['id']) || $_SESSION['std'] != 'voter') {
        header('location:../');
    }
    $data = $_SESSION['data'];

    if ($_SESSION['status'] == 1) {
        $status = '<b>Voted</b>';
    }
    else {
        $status = '<b>Not Voted</b>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

    <!--BootStrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!--CSS link -->
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-secondary text-light">
    <div class="container my-5">
        <h1 class="my-3">User Dashboard</h1>
        <div class="row my-5">
            <!--Group-->
            <div class="col-md-7">
                <?php
                if (isset($_SESSION['groups'])) {
                    $groups = $_SESSION['groups'];

                    for ($i = 0; $i < count($groups); $i++) {
                        ?>
                        <div class="row">
                            <div class="col-md-4">
                            <img src="../uploads/<?php echo $groups[$i]['photo'] ?>" alt="Group Image">
                            </div>
                            <div class="col-md-8">
                                <strong class="text-dark h5">Group Name:</strong>
                                <?php echo $groups[$i]['username']; ?>
                                <br><br>
                                <strong class="text-dark h5">Votes:</strong>
                                <?php echo $groups[$i]['votes']; ?>
                            </div>
                        </div>
                        <form action="../actions/voting.php" method="POST">
                            <input type="hidden" name="group-votes" value="<?php echo $groups[$i]['votes']; ?>">
                            <input type="hidden" name="group-id" value="<?php echo $groups[$i]['id']; ?>">

                            <?php
                                if($_SESSION['status'] == 1) {
                                    ?>
                                    <button class="btn btn-dark my-3 text-white px-3" disabled>Voted</button>
                                    <?php
                                }
                                else {
                                    ?>
                                    <button class="btn btn-dark my-3 text-white px-3" type="submit">Vote</button>
                                    <?php
                                }
                            ?>
                        </form>
                        <hr>
                        <?php
                    }
                }
                else {
                    ?>
                    <div class="container">
                        <p>No Groups to Display</p>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!--User-->
            <div class="col-md-5">
                <img src="../uploads/<?php echo $data['photo'] ?>" alt="User Image">
                <br>
                <strong class="text-dark h5">Name:</strong>
                <?php echo $data['username']; ?>
                <br><br>
                <strong class="text-dark h5">Status:</strong>
                <?php echo $status; ?>
                <br><br>
            </div>
        </div>
    </div>
    <div class="container text-center">
        <a href="../"><button class="btn btn-dark text-light px-3">Back</button></a>
        <a href="logout.php"><button class="btn btn-dark text-light px-3">Logout</button></a>
    </div>
</body>
</html>
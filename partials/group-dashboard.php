<?php
    session_start();
    if (!isset($_SESSION['id']) || $_SESSION['std'] != 'group') {
        header('location:../');
    }
    $data = $_SESSION['data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Dashboard</title>

    <!--BootStrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!--CSS link -->
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-secondary text-light">
    <div class="container my-5 text-center">
        <h1 class="my-3"><?php echo $data['username']; ?> Dashboard</h1>
        <div class="row my-5">
            <div>
                <img src="../uploads/<?php echo $data['photo'] ?>" alt="Group Image">
                <br><br>
                <strong class="text-dark h5">Name:</strong>
                <?php echo $data['username']; ?>
                <br><br>
                <strong class="text-dark h5">Votes:</strong>
                <?php echo $data['votes']; ?>
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
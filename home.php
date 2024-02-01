<?php
    session_start();

    include("php/config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p>Logo</p>
        </div>

        <div class="right-links">

            <?php

            $id = $_SESSION['id'];
            $query = mysqli_query($con,"SELECT * FROM users WHERE Id=$id");

            while($user = mysqli_fetch_assoc($query)){
                $user_Uname = $user['Username'];
                $user_Email = $user['Email'];
                $user_Age = $user['Age'];
                $user_Id = $user['Id'];
            }

            echo "<a href='edit.php'?Id=$user_Id'>Modifica Profilo</a>";

            ?>

            <a href="php/logout.php"> <button class="btn">Esci</button> </a>
        </div>
    </div>
    <main>

        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Buongiorno <b><?php echo $user_Uname ?></b>, benvenuto</p>
                </div>
                <div class="box">
                    <p>La tua email è <b><?php echo $user_Email ?></b>.</p>
                </div>
            </div>
            <div class="bottom">
                <div class="box">
                    <p>E hai <b><?php echo $user_Age ?> anni</b>.</p>
                </div>
            </div>
        </div>

    </main>
</body>
</html>
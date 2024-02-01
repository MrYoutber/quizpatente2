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
    <title>Modifica Profilo</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>

        <div class="right-links">
            <a href="#">Modifica Profilo</a>
            <a href="php/logout.php"> <button class="btn">Esci</button> </a>
        </div>
    </div>

    <div class="container">
        <div class="box form-box">
            <?php
                if(isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $age = $_POST['age'];

                    $id = $_SESSION['id'];

                    $edit_query = mysqli_query($con, "UPDATE users SET Username='$username', Email='$email', Age='$age' WHERE Id=$id") or die("Errore con il database!");
                    
                    if($edit_query){
                        echo "<div class='success'>
                                <p>Profilo modificato!</p>
                              </div> <br>";
                        echo "<a href='home.php'><button class='btn'>Torna indietro</button>";
                    }
                }else{
                    $id = $_SESSION['id'];
                    $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

                    while($user = mysqli_fetch_assoc($query)){
                        $user_Uname = $user['Username'];
                        $user_Email = $user['Email'];
                        $user_Age = $user['Age'];
                    }
            ?>
            <header>Modifica Profilo</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $user_Uname; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $user_Email; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Età</label>
                    <input type="number" name="age" id="age" value="<?php echo $user_Age; ?>" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" name="submit" class="btn" value="Modifica" required>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>
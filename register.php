<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="container">
        <div class="box form-box">

        <?php

            include("php/config.php");
            
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $password = $_POST['password'];
            
                // Verifico che la mail non sia già registrata
                $verify_email_query = mysqli_query($con,"SELECT Email FROM users WHERE Email='$email'");
                // Verifico che lo username non sia in uso
                $verify_username_query = mysqli_query($con,"SELECT Username FROM users WHERE Username='$username'");
            
                if(mysqli_num_rows($verify_email_query) != 0){
                    echo "<div class='message'>
                                <p>Questo indirizzo mail è già in uso!</p>
                          </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Torna indietro</button>";
                } elseif(mysqli_num_rows($verify_username_query) != 0){
                    echo "<div class='message'>
                                <p>Questo username è già in uso!</p>
                          </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Torna indietro</button>";
                }else {
                    // Hash della password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                    // Inserimento nel database con la password hashata
                    mysqli_query($con, "INSERT INTO users(Username, Email, Age, Password) VALUES('$username', '$email', '$age', '$hashed_password')") or die("Errore con il Database!");
                
                    echo "<div class='success'>
                                <p>Ti sei registrato correttamente!</p>
                          </div> <br>";
                    echo "<a href='index.php'><button class='btn'>Accedi</button>";
                }
            } else {
        ?>


            <header>Registrati</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Età</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" name="submit" class="btn" value="Registrati" required>
                </div>

                <div class="links">
                    Hai già un account? <a href="index.php">Accedi</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>
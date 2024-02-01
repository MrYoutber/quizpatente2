<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Accedi</title>
    <link rel="stylesheet" href="style/style.css" />
  </head>
  <body>
    <div class="container">
      <div class="box form-box">
        <?php

          include("php/config.php");
          if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
        
            // Recupero l'utente dal database tramite l'email
            $query = mysqli_query($con,"SELECT * FROM users WHERE Email='$email'");
            $user = mysqli_fetch_assoc($query);
        
            if($user) {
                // Verifica della password hashata
                if(password_verify($password, $user['Password'])) {
                    // Password corretta, eseguire l'accesso
                    $_SESSION['valid'] = $user['Email'];
                    $_SESSION['username'] = $user['Username'];
                    $_SESSION['age'] = $user['Age'];
                    $_SESSION['id'] = $user['Id'];
                } else {
                    // Password non corretta
                    echo "<div class='message'>
                                <p>La password inserita non è corretta.</p>
                          </div> <br>";
                    echo "<a href='index.php'><button class='btn'>Torna indietro</button></a>";
                }
            } else {
                // Utente non trovato
                echo "<div class='message'>
                            <p>Utente non trovato.</p>
                      </div> <br>";
                echo "<a href='index.php'><button class='btn'>Torna indietro</button></a>";
            }
            if(isset($_SESSION['valid'])){
              header('Location: home.php');
            }
          }
          else{

        ?>
        <header>Accedi</header>
        <form action="" method="post">
          <div class="field input">
            <label for="email">Email</label>
            <input
              type="text"
              name="email"
              id="email"
              autocomplete="off"
              required
            />
          </div>

          <div class="field input">
            <label for="password">Password</label>
            <input
              type="password"
              name="password"
              id="password"
              autocomplete="off"
              required
            />
          </div>

          <div class="field">
            <input
              type="submit"
              name="submit"
              class="btn"
              value="Accedi"
              required
            />
          </div>

          <div class="links">
            Non hai un account? <a href="register.php">Registrati</a>
          </div>
        </form>
      </div>
      <?php } ?>
    </div>
  </body>
</html>

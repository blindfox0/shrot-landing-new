<?php

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $_SESSION['message'] = 'Jesteś już zalogowany';
    $_SESSION['messageType'] = 'success';
    header('Location: addNewGigForm.php');
    exit();
}

$password = 'TwojaStaraZapierdala';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password']) && $_POST['password'] === $password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['message'] = 'Jesteś zalogowany';
        $_SESSION['messageType'] = 'success';
        header('Location: addNewGigForm.php');
        exit();
    } else {
        $_SESSION['message'] = 'Hasło nieprawidłowe';
        $_SESSION['messageType'] = 'error';
    }
}

?>

<!-- Poniższy PHP pobiera do globalnej zmiennej JS wartości message przekazane przez php w zmiennych SESSION -->
<?php if (isset($_SESSION['message'])) : ?>
<script>
window.flashMessage = {
  text: <?php echo json_encode($_SESSION['message']); ?>,
  type: <?php echo json_encode($_SESSION['messageType']); ?>
};
</script>
<?php endif; ?>

<?php

unset($_SESSION['message']);
unset($_SESSION['messageType']);

?>

<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
            punk: ['Octynaz', 'sans-serif'],
            punkLight: ['Oswald', 'sans-serif'],
          },
          colors: {
            punkRed: '#dc2626',      /* Główna czerwień */
            punkRedHover: '#b91c1c', /* Ciemniejsza czerwień */
            darkBg: '#0a0a0a',       /* Głęboka czerń */
            cardBg: '#141414',       /* Jaśniejsza czerń dla kart */
          },
          boxShadow: {
            brutal: '6px 6px 0px 0px #dc2626',
            brutalSm: '4px 4px 0px 0px #dc2626',
            brutalWhite: '5px 5px 0px 0px #ffffff',
          }
        }
      }
    }
</script>
</head>

<body class="p-5">
    <div class="message">
      <div class="message-content"></div>
    </div>
  <div class="header-container text-4xl mb-4">
    <h1>Logowanie</h1>
  </div>
  <div class="login-form">
    <form action="login.php" method="post">
      <label>Hasło:<br><input class="border rounded shadow" type="password" name="password"></label><br><br>
      <input class="px-4 py-2 bg-punkRed hover:bg-punkRedHover text-white" type="submit" value="Zaloguj">
    </form>
  </div>

    <script src="messages.js"></script>
</body>

</html>

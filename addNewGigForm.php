<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $_SESSION['message'] = 'Najpierw się zaloguj';
    $_SESSION['messageType'] = 'error';
    header('Location: login.php');
    exit();
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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link href="styles.css" rel="stylesheet">
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

<body class="font-sans p-5">
    <div class="message">
      <div class="message-content"></div>
    </div>
  <section>
    <div class="header-container text-4xl">
      <h1>Formularz do wstawiania nowego koncertu</h1>
    </div>
      <div class="logout-button mb-5">
        <form action="logout.php">
          <button class="bg-punkRed hover:bg-punkRedHover text-white px-4 py-2" type="submit">Wyloguj</button>
        </form>
      </div>
    <div class="form max-w-lg">
      <form action="addNewGig.php" method="get">
        <label class="block mb-1">Data wydarzenia:</label><input type="text" name="date" class="w-full mb-2 shadow border rounded"><br>
        <label class="block mb-1">Tytuł wydarzenia:</label><input type="text" name="title" class="w-full mb-2 shadow border rounded"><br>
        <label class="block mb-1">Miejsce wydarzenia:</label><input type="text" name="place" class="w-full mb-2 shadow border rounded"><br>
        <label class="block mb-1">Miasto:</label><input type="text" name="location" class="w-full mb-2 shadow border rounded"><br>
        <label class="block mb-1">Opis wydarzenia:</label><textarea rows="5" name="description" class="w-full mb-2 shadow border rounded"></textarea><br>
        <label class="block mb-1">Cena biletów lub "wstęp wolny":</label><input type="text" name="tickets" class="w-full mb-2 shadow border rounded"><br>
        <label class="block mb-1">Link do wydarzenia:</label><input type="text" name="link" class="w-full mb-2 shadow border rounded"><br><br>
        <input type="submit" class="bg-punkRed hover:bg-punkRedHover text-white px-4 py-2">
      </form>
    </div>
  </section>

    <section class="current-gigs mt-10">
      <div class="current-gigs-header text-3xl mb-4"><h2>Obecnie dodane wydarzenia:</h2></div>
      <div class="current-gigs-inner grid grid-cols-1 md:grid-cols-2 lg:grid-cols3 gap-8">
      <!-- dynamic gigs  -->
      </div>
    </section>

    <script src="gigsAdmin.js"></script>
    <script src="messages.js"></script>

</body>

</html>

<?php require_once APPROOT . '/views/includes/header.php'; ?>
<?php

session_start();

// hardcoded credentials
const USERNAME = 'admin';
const PASSWORD = 'wachtwoord';

// als al ingelogd: doorsturen

if (!empty($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    if ($user === USERNAME && $pass === PASSWORD) {
        // succesvolle login
        $_SESSION['user'] = USERNAME;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Ongeldige gebruikersnaam of wachtwoord.';
    }   
}
?>


  <div class="login-wrapper">
    <form class="login-box" method="post" action="">
      <h2>Inloggen</h2>

      <div class="login-group">
        <label for="username" class="login-label">Gebruikersnaam</label>
        <input type="text" id="username" name="username" class="login-input" placeholder="Voer gebruikersnaam in" required>
      </div>

      <div class="login-group">
        <label for="password" class="login-label">Wachtwoord</label>
        <input type="password" id="password" name="password" class="login-input" placeholder="Voer wachtwoord in" required>
      </div>

      <button type="submit" class="login-button">Login</button>

      
     
        <?php if ($error): ?>
            <div class="error"><?=htmlspecialchars($error, ENT_QUOTES, 'UTF-8')?></div>
        <?php endif; ?>
      
    </form>
  </div>


<?php require_once APPROOT . '/views/includes/footer.php'; ?>

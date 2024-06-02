<?php
// Avvia la sessione
session_start();

// Inizializza la variabile $feedback
$feedback = "";

// Inizializza il punteggio se non esiste già
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

// Percorso al file JSON
$json_file_path = 'data.json';

// Controlla se il file JSON esiste e può essere letto
if (file_exists($json_file_path) && is_readable($json_file_path)) {
    // Leggi il contenuto del file JSON
    $notizie_json = file_get_contents($json_file_path);

    // Decodifica il JSON in un array associativo
    $notizie = json_decode($notizie_json, true);

    // Seleziona una notizia casuale solo se non è già stata selezionata
    if (!isset($_SESSION['notizia_casuale'])) {
        // Seleziona una notizia casuale
        $_SESSION['notizia_casuale'] = $notizie[array_rand($notizie)];
        unset($_POST['user_answer']);
    }

    $notizia_casuale = $_SESSION['notizia_casuale'];

    // Verifica la risposta dell'utente se è stata inviata
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_answer = isset($_POST['user_answer']) ? $_POST['user_answer'] : null;
        if ($user_answer !== null) {
            $is_real = $notizia_casuale['real'] ? 'true' : 'false';
            if ($user_answer === $is_real) {
                // Incrementa il punteggio se la risposta è corretta
                $_SESSION['score']++;
                $feedback = "Corretto! La notizia è " . ($notizia_casuale['real'] ? "vera. " . "<a href='" . $notizia_casuale['link'] . "'>Se non ci credi controlla...</a>" : "falsa.");
            } else {
                // Se la risposta è sbagliata, reindirizza alla pagina del punteggio
                header("Location: punteggio.php");
                exit();
            }

            // Resetta la notizia selezionata per il prossimo round
            unset($_SESSION['notizia_casuale']);
        }
    }
} else {
    // Gestisci l'errore di lettura del file JSON
    $notizia_casuale = null;
    $feedback = "Errore: il file delle notizie non è disponibile.";
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notizia Vera o Fake News?</title>
    <style>
        #sfondo {
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url('src/indexWP.jpg');
            backdrop-filter: blur(5vh);
            height: 100vh;
            width: 100vw;
            position: absolute;
            top: 0;
            z-index: -5000;
        }

        #blur {
            height: 100vh;
            width: 100vw;
            position: absolute;
            top: 0;
            z-index: -4000;
            backdrop-filter: blur(1vh);
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            overflow-x: hidden;
        }

        #contain {
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: 100vh;
            width: 100vw;
            overflow-y: scroll;
        }
        #logo {
            margin-top: -15vh;
            margin-bottom: -30vh;
            height: 70vh;
            width: 70vw;
            filter: invert(100%)hue-rotate(180deg);
            z-index: 99;
        }
        #logoLink{
            z-index: 99;
        }
        p{
            margin-top: 10vh;
            background-color: white ;
            font-size: 4vh;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }
        form {
            z-index: 1000;
        }
        button{
            border: 0.2 solid black;
            margin: 1vh;
            background-color: white;
            width: 30vw;
            height: 15vh;
            font-size: 6vh;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            z-index: 1000;
        }   

    </style>
</head>

<body>
    <div id="sfondo"></div>
    <div id="blur"></div>
    <div id="contain">
        <a href="index.php" id="logoLink"><img id="logo" src="src/logo.svg" alt=""></a>
        <?php if ($notizia_casuale) : ?>
            <p><?php echo htmlspecialchars($notizia_casuale['titolo']); ?></p>

            <form method="POST">
                <button type="submit" name="user_answer" value="true">Vera</button>
                <button type="submit" name="user_answer" value="false">Falsa</button>
            </form>
            <!-- Mostra il feedback solo se è stato impostato -->
            <?php if ($feedback) : ?>
                <p><?php echo $feedback; ?></p>
            <?php endif; ?>
        <?php else : ?>
            <p><?php echo $feedback; ?></p>
        <?php endif; ?>

        <p style="color:rgb(248, 98, 98);">Punteggio: <?php echo $_SESSION['score']; ?></p>

        <?php if ($feedback && $notizia_casuale) : ?>
            <form method="POST" action="gioco.php">
                <button type="submit" name="next_question">Prossima Domanda</button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>
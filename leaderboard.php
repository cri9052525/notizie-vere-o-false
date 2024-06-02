<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classifica</title>
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
            z-index: -2;
        }

        #blur {
            height: 100vh;
            width: 100vw;
            position: absolute;
            top: 0;
            z-index: -1;
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

        #contain{
            position: absolute;
            top:0;
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
        }

        h1 {
            margin-top: 8vh;
            color: white;
            font-size: 7vw;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }
        table{
            margin-top:-3vh;
            width: 80vw;
            background-color: white;
        }
        th{
            color: rgb(248, 98, 98);
            font-size: 6vh;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            border: .5vh solid black;
            background-color: black;
            margin:0;
            padding: 0;
        }
        td{
            font-size: 4vh;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            margin:0;
            text-align: center;
            padding: 0;
        }
    </style>
</head>

<body>
    <div id="sfondo"></div>
    <div id="blur"></div>
    <div id="contain">
        <a href="index.php"><img id="logo" src="src/logo.svg" alt=""></a>
        <h1>Classifica</h1>
        <table>
            <tr>
                <th>Posizione</th>
                <th>Nickname</th>
                <th>Punteggio</th>
            </tr>
            <?php
            session_start();


            $_SESSION['score'] = 0;
            ?>
            <?php

            $leaderboard_data = file('leaderboard.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


            rsort($leaderboard_data);


            $position = 1;


            foreach ($leaderboard_data as $line) {

                list($nickname, $score) = explode('|', $line);


                echo "<tr>";
                echo "<td>$position</td>";
                echo "<td>$nickname</td>";
                echo "<td>$score</td>";
                echo "</tr>";


                $position++;
            }
            ?>
        </table>
    </div>
</body>

</html>
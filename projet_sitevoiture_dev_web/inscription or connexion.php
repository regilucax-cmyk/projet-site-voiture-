<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription ou connexion</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            color: #222;
        }
        .page {
            max-width: 360px;
            margin: 80px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ccc;
        }
        h3 {
            margin-top: 0;
            font-size: 22px;
        }
        .actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }
        input[type="button"] {
            padding: 10px;
            border: none;
            background: #333;
            color: #fff;
            cursor: pointer;
        }
        input[type="button"]:hover {
            background: #555;
        }
    </style>
</head>
<body>
<div class="page">
    <h3>Inscription ou connexion</h3>
    <div class="actions">
        <input type="button" value="S'inscrire" onclick="window.location.href='inscription.php'">
        <input type="button" value="Se connecter" onclick="window.location.href='connexion.php'">
    </div>
</div>
</body>
</html>

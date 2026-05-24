<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée - 404</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fcfcfc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            text-align: center;
        }

        .container {
            max-width: 600px;
            padding: 20px;
        }

        .error-code {
            font-family: 'Cormorant Garamond', serif;
            font-size: 150px;
            font-weight: 700;
            line-height: 1;
            color: #1a1a1a;
        }

        .error-message {
            font-family: 'Cormorant Garamond', serif;
            font-size: 32px;
            font-style: italic;
            margin-bottom: 20px;
            color: #555;
        }

        .description {
            font-size: 16px;
            line-height: 1.6;
            color: #888;
            margin-bottom: 40px;
        }

        .btn-home {
            display: inline-block;
            padding: 15px 35px;
            background-color: #1a1a1a;
            color: #fff;
            text-decoration: none;
            border-radius: 2px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-home:hover {
            background-color: #444;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="error-code">404</h1>
        <h2 class="error-message">Page Introuvable</h2>
        <p class="description">
            La page que vous recherchez n'existe pas ou a été déplacée. 
            Vérifiez l'URL ou revenez à la page d'accueil pour continuer votre navigation.
        </p>
        <a href="/" class="btn-home">Retour à l'accueil</a>
    </div>

</body>
</html>
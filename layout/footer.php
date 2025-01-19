<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        footer {
            background: linear-gradient(135deg, #2196f3, #4caf50);
            color: white;
            padding: 20px 0;
        }

        footer a {
            color: #ffeb3b;
            text-decoration: none;
            font-weight: bold;
        }

        footer a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .footer-bottom {
            background: #1e1e1e;
            color: #bdbdbd;
            padding: 10px 0;
        }
    </style>
</head>
<body>
<footer style="position: fixed; bottom: 0; width: 100%; background-color:rgb(71, 75, 78); padding: 0px 0; border-top: 0px solid #ddd;">
    <div class="footer-bottom text-center">
        &copy; <?= date('Y'); ?> Copyright: <a href="#" style="text-decoration: none; color: #007bff;">@envy</a>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

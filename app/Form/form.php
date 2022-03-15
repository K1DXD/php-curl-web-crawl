<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form</title>
    </head>
    <body>
        <form action="<?php echo '../../index.php'; ?>" method="post">
            url: <input type="text" name="url"><br>
            SQl username: <input type="text" name="username"><br>
            SQL password: <input type="text" name="password"><br>
            <button type="submit">Submit</button>
        </form>
    </body>
    </html>
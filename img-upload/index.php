<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
    <title>img-upload</title>
</head>
<body>
    <form method="post" 
          action="upload.php"
          enctype="multipart/form-data">

          <input type="file"
                 name="my_image">
          <input type="submit" 
                 name="submit"
                 value="Upload">

    </form>
</body>
</html>
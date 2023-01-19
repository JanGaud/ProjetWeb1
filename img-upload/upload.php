<?php


    if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
        // include "";
        echo "<pre>";
            print_r($_FILES['my_image']);
        echo "</pre>";

        $img_name = $_FILES['my_image']['name'];
        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];

        if ($error === 0) {
            if ($img_size > 200000) {
                $em = "Désolé, le fichier est trop volumineux!";
                header("Location: index.php?error=$em");
            }else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                echo($img_ex);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'uploads/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    // Insérer dans la base de donnée
                    $sql = "INSERT INTO images(imageUrl) 
                            VALUES('$new_img_name')";

                }else {
                    $em = "Vous ne pouvez pas télécharger des fichiers de ce type.";
                    header("Location: index.php?error=$em");
                }
            }
        }else {
            $em = "unknown error occured!";
            header("Location: index.php?error=$em");
        }
    }
    else {
        header("Location: index.php");
    }

?>
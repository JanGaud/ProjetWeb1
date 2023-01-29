<?php

namespace App\Services;
use Exception;

    class Upload{


        public static function imgUpload($imgPath){
            
                $img_name = $imgPath['name'];
                $img_size = $imgPath['size'];
                $tmp_name = $imgPath['tmp_name'];
                $error = $imgPath['error'];
        
                if ($error === 0) {
                    if ($img_size > 200000) {
                        throw new Exception("Désolé, le fichier est trop volumineux!");
                    }else {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_lc = strtolower($img_ex);
        
                        $allowed_exs = array("jpg", "jpeg", "png");
        
                        if (in_array($img_ex_lc, $allowed_exs)) {
                            $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                            $img_upload_path = '../public/img-upload/'.$new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
                            return $new_img_name;
                        }else {
                            throw new Exception("Vous ne pouvez pas télécharger des fichiers de ce type.");                   
                        }
                    }
                }else {
                    throw new Exception("unknown error occured!");
                }
        }
    
    }
    
?>
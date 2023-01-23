<?php

namespace App\Models;

enum Privilege:int{
    case Membre = 1;
    case Vendeur = 2;
    case Moderateur = 3;
    case Master = 4;
}

?>
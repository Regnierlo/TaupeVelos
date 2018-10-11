<?php
    //Permer de tester la date pour qu'elle soit inférieur à celle actuelle
    function dateIsCorrect($dateArray)
    {
        if(count($dateArray) == 3)
        {
            //Si la date existe (pas de 30/02 par exemple)
            if (checkdate($dateArray[1], $dateArray[0], $dateArray[2]))
            {
                $currentDay = date("d"); //Jour courant
                $currentMonth = date("m"); //Mois courant
                $currentYear = date("Y"); //Année courante
                $dateIsCorrect = true; //On part du principe que la date est vraie

                //Si la date courante est inférieur à la date rentrée
                if (intval($currentYear) < intval($dateArray[2])) {
                    $dateIsCorrect = false; //Alors c'est faux
                }
                //Sinon si c'est égale
                else if (intval($currentYear) == intval($dateArray[2])) {
                    //Si le mois courant est inférieur à celui rentré
                    if (intval($currentMonth) < intval($dateArray[1])) {
                        $dateIsCorrect = false; //Alors c'est faux
                    }
                    //Sinon si le mois courant est égale à celui rentré
                    else if (intval($currentMonth) == intval($dateArray[1])) {
                        //Si le jour courant est inférieur ou égale au jour rentré
                        if (intval($currentDay) <= intval($dateArray[0])) {
                            $dateIsCorrect = false;//Alors c'est faux 
                        }
                    }
                }
            }
            else
            {
                $dateIsCorrect = false;
            }
        }
        else
        {
            $dateIsCorrect = false;
        }

        return $dateIsCorrect;
    }
 ?>

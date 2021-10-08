<?php

namespace App\Controller;


class Image extends AbstractController
{

    protected $media = "C:\MAMP\htdocs\MVC\Public\media";

    /**
     * Undocumented function
     *
     * @param integer $id Id you want to record the image as $id.jpg.
     * @param string $folder Folder you want to record the image in.
     * @return void
     */
    public function create(int $id, string $folder)
    {

        if (isset($_FILES['image']) and !empty($_FILES['image']['name'])) { // On vérifie qu'il y a bien un fichier
            $filename = $_FILES['image']['tmp_name']; // On récupère le nom du fichier
            list($originalWidth, $originalHeight, $originalType) = getimagesize($filename); // On récupère la taille de notre fichier (l'image)
            echo "<pre>";
            var_dump($_FILES['image']);echo "</pre>"; //die;
            if ($originalWidth >= 100 && $originalHeight >= 100 && $originalWidth <= 140000 && $originalHeight <= 140000) { // On vérifie que la taille de l'image est correcte

                $ListeExtension = array('jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');
                $ListeExtensionIE = array('jpg' => 'image/pjpg', 'jpeg' => 'image/pjpeg');
                $tailleMax = 12582912; // Taille maximum 5 Mo

                // 2mo  = 2097152 3mo  = 3145728 4mo  = 4194304 5mo  = 5242880 7mo  = 7340032 10mo = 10485760 12mo = 12582912

                $acceptedExtensions = array('jpg', 'jpeg'); // Format accepté

                if ($_FILES['image']['size'] <= $tailleMax) { // Si le fichier et bien de taille inférieur ou égal à 5 Mo

                    $extensionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1)); // Prend l'extension après le point, soit "jpg, jpeg ou png"

                    if (in_array($extensionUpload, $acceptedExtensions)) { // Vérifie que l'extension est correct
                        // 
                        $dossier = "C:\laragon\www\pope_candy_tickets_plateforme\public\assets\images\\$folder";
                        $recordedFile = "\\$id.jpg";

                        if (!is_dir($dossier)) { // Si le nom de dossier n'existe pas alors on le crée
                            mkdir($dossier);
                        } else {

                            if (file_exists("$recordedFile")) {
                                unlink("$recordedFile");
                            }
                        }

                        $result = move_uploaded_file($_FILES['image']['tmp_name'], "$dossier\\$id.jpg"); // On fini par mettre la photo dans le dossier
                        return $result;
                    } else {
                        $this->setFlash(
                            false,
                            'Votre photo doit être au format jpg.'
                        );
                        return false;
                    }
                } else {
                    $this->setFlash(
                        false,
                        'Votre photo de profil ne doit pas dépasser 5 Mo !'
                    );
                    return false;
                }
            } else {
                $this->setFlash(
                    false,
                    "Dimension de l'image minimum 400 x 400 et maximum 6000 x 6000 !"
                );
                return false;
            }
        }
    }

    public function delete(int $id, string $folder)
    {
        unlink("$this->media\\$folder\\$id.jpg");
    }
}

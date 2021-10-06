<?php

namespace App\Model;

use App\Model\Connection;

/**
 * Abstract class handling default manager.
 */
abstract class AbstractModel
{
    /**
     * @var \PDO
     */
    protected $pdo; //connection variable

    /**
     * @var string
     */
    protected $table;
    /**
     * @var string
     */
    protected $className;


    /**
     * Initializes Manager Abstract class.
     * @param string $table
     */
    public function __construct(string $table)
    {
        $this->table = $table;
        $this->className = __NAMESPACE__ . '\\' . ucfirst($table);
        $this->pdo = (new Connection())->getInstance();
    }

    /**
     * Affiche toutes les valeurs d'une table.
     *
     * @return array
     */
    public function selectAll(): array
    {
        return $this
            ->pdo
            ->query(
                "SELECT * 
                FROM $this->table")
            ->fetchAll();
    }

    /**
     * Affiche toutes les valeurs d'une table, classé selon un parametre, et son sens.
     *
     * @param string $param Critère de classement
     * @param boolean $way true="DESC" false=""
     * @return array
     */
    public function allOrderedBy(string $param, bool $way): array
    {
        $direction = $way ? "DESC" : "";

        return $this
            ->pdo
            ->query(
                "SELECT * 
                FROM $this->table
                ORDER BY $param $direction")
            ->fetchAll();
    }

    /**
     * Get one row from database by ID.
     *
     * @param  int $id
     *
     * @return array
     */
    public function selectOneById(int $id)
    {
        // prepared request
        $statement = $this
            ->pdo
            ->prepare(
                "SELECT * 
                FROM $this->table 
                WHERE id = ?");
        $statement->execute([$id]);

        return $statement->fetch();
    }

    /**
     * Create element in database
     * @param array $item
     * @return int
     */
    public function insert(array $array): int
    {
        // on génère des tableaux vides pour chacunes des valeurs que l'on remplira ensuite
        $fields = [];
        $interrogationsDots = [];
        $values = [];

        // Pour chaques elements du tableau que la fonction reçoit, on sépare 
        //les Cléfs (key) de leurs Valeurs (value), et on ajoute un point d'intérogation
        foreach ($array as $field => $value) {
            if (null !== $value && '' != $value && 'db' != $field && 'table' != $field) {
                $fields[] = $field;
                $interrogationsDots[] = "?";
                $values[] = $value;
            }
        }

        // on transforme les tableaux des champs et points d'intérogations en
        // deux strings pour les inserer dans la requette SQL
        $fieldsList = implode(', ', $fields);
        $interrogationsDotsList = implode(', ', $interrogationsDots);

        $statement = $this
            ->pdo
            ->prepare(
                "INSERT INTO $this->table ($fieldsList) 
                VALUES ($interrogationsDotsList)"
            );

        // Ceci est un outil de test pour véfifier les valeurs que l'on entre dans la base de donnée 
        //var_dump($statement);
        //echo "<br/>-<br/>";
        //var_dump($values);
        //die;

        // Si la requète s'est bien passé, on retourne l'id du dernier élément créé, donc celui ci.
        if ($statement->execute($values)) {
            return (int)$this->pdo->lastInsertId();
        }
    }


    /**
     * Update element on the database
     * @param array $item
     * @return bool
     */
    public function update(array $item): bool
    {
        // On créer deux tableaux vides pour contenir toutes les informations
        $fields = [];
        $values = [];

        // Pour chaque element du tableau que la fonction reçoit, on sépare les Cléfs (key) de leurs Valeurs (value)
        foreach ($item as $key => $value) {

            // Si la Valeur n'est pas null, ou ne vaut ni DB, ni Table
            if ($value !== null && $key !== 'db' && $key !== 'table') {
                if ($key == 'id') {
                    $id = $value;
                } else {
                    $fields[] = "$key = ?";
                    $values[] = $value;
                }
            }
        }
        // on transforme le tableau des champs en une string pour l'inserer dans la requette SQL
        $field_list = implode(', ', $fields);

        $statement = $this
            ->pdo
            ->prepare(
                "UPDATE $this->table
                SET $field_list 
                WHERE id= $id"
            );

        return $statement->execute($values);
    }

    /**
     * Delete element in database
     * @param int $id
     */
    public function delete(int $id): bool
    {
        // prepared request
        $statement = $this
            ->pdo
            ->prepare(
                "DELETE FROM $this->table 
                WHERE id= ?"
            );
        return $statement->execute([$id]);
    }
}

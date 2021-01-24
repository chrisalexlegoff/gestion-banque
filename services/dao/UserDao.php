<?php

require_once "ConstantesDao.php";
require_once "../services/dto/User.php";
define('FILE_SAVE_USER', $_SERVER['DOCUMENT_ROOT'] . "/GestionBanque/donnees/save_users.csv");
define('FILE_CPT_USER', $_SERVER['DOCUMENT_ROOT'] . "/GestionBanque/donnees/compteurs/cpt_users.txt");

class UserDao
{    
    private const CHAMP_ID = "id";
    private const CHAMP_NUMERO_USER = "numeroUSER";
    private const CHAMP_NOM = "nom";
    private const CHAMP_PRENOM = "prenom";
    private const CHAMP_DATE_NAISSANCE = "dateNaissance";
    private const CHAMP_TELEPHONE = "telephone";
    private const CHAMP_EMAIL = "email";
    private const CHAMP_ADRESSE = "adresse";
    private const CHAMP_TYPE = "type";
    private const ENTETES_USER = [UserDao::CHAMP_NUMERO_USER,UserDao::CHAMP_NOM,UserDao::CHAMP_PRENOM,UserDao::CHAMP_DATE_NAISSANCE,UserDao::CHAMP_TELEPHONE,UserDao::CHAMP_EMAIL ,UserDao::CHAMP_ADRESSE,UserDao::CHAMP_TYPE];

   
    public function saveAll(array $users)
    {
        $handle = fopen(FILE_SAVE_USER, ConstantesDao::FILE_OPTION_W_PLUS);
        if (!empty(UserDao::ENTETES_USER)) {
            fputcsv($handle, UserDao::ENTETES_USER, ConstantesDao::DELIM);
        }
        foreach ($users as $user) {
            fputcsv($handle, $user->toArray(), ConstantesDao::DELIM);
        }
        fclose($handle);
    }

    public function getById($motif): User
    {
        return $this->getOneByAttribute(UserDao::CHAMP_ID, $motif);
    }


    public function getAll(): array
    {
        $handle = fopen(FILE_SAVE_USER, ConstantesDao::FILE_OPTION_R);
        $entities = [];

        $entetes = fgetcsv($handle, 0, ConstantesDao::DELIM);

        while (($entity = fgetcsv($handle, 0, ConstantesDao::DELIM)) != false) {
            $entities[] = User::USERFromArray(array_combine($entetes, $entity));
        }

        fclose($handle);
        return $entities;
    }

    public function getByNom(string $motif): ?array
    {
        return $this->getAllByAttribute(UserDao::CHAMP_NOM, $motif);
    }

    public function deleteById(int $idEntity): void
    {
        $allEntities = $this->getAll();
        for ($i = 0; $i < count($allEntities); $i++) {
            if ($allEntities[$i]->getId() === $idEntity) {
                array_splice($allEntities, $i, 1);
            }
        }
        $this->saveAll($allEntities);
    }
    public function modify(UserDao $newEntity): void
    {
        $allEntities = $this->getAll();
        foreach ($allEntities as $currentEntity) {
           
            if ($currentEntity->getId() === $newEntity[UserDao::CHAMP_ID]) {
                $currentEntity = $newEntity;
            }
        }
        $this->saveAll($allEntities);
    }


    public function save(UserDao $newUser)
    {
        $handle = fopen(FILE_SAVE_USER, ConstantesDao::FILE_OPTION_A_PLUS);
        $newUser = User::setId($this->getNextId());
        $newUser = User::setNumeroUser("SM".str_pad($newUser->User::getId(), 6, "0", STR_PAD_LEFT));
        fputcsv($handle, $newUser->User::toArray(), ConstantesDao::DELIM);
        fclose($handle);
        return $newUser;
    }



    public function getNextId(): int
    {
        $handle = fopen(FILE_CPT_USER, ConstantesDao::FILE_OPTION_A_PLUS);
        $currentId = intval(fgets($handle));
        $currentId++;
        fclose($handle);
        $handle = fopen(FILE_CPT_USER, ConstantesDao::FILE_OPTION_W_PLUS);
        fputs($handle, $currentId);
        fclose($handle);
        return $currentId;
    }

    public function getOneByAttribute(string $attribute, string $motif): ?User
    {
        $allEntities = $this->getAll();
        foreach ($allEntities as $entity) {
            $getter = "get".ucfirst($attribute);
            if (strtolower($entity->$getter()) === strtolower($motif)) {
                return $entity;
            }
        }
        return null;
    }
    public function getAllByAttribute(string $attribute, string $motif): array
    {
        $allEntities = $this->getAll();
        $entitiesCherchees = [];
        foreach ($allEntities as $entity) {
            $getter = "get".ucfirst($attribute);
            if (strtolower($entity->$getter()) === strtolower($motif)) {
                $entitiesCherchees[] = User::USERFromArray($entity);
            }
        }
        return $entitiesCherchees;
    }
}

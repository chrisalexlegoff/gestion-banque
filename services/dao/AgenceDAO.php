<?php

require_once "ConstantesDao.php";
define('FILE_SAVE_AGENCE', $_SERVER['DOCUMENT_ROOT'] . "/GestionBanque/donnees/save_agences.csv");
define('FILE_CPT_AGENCE', $_SERVER['DOCUMENT_ROOT'] . "/GestionBanque/donnees/compteurs/cpt_agences.txt");

class AgenceDao
{
    private const CHAMP_NOM_AGENCE = "nom";
    private const CHAMP_ADRESSE_AGENCE = "adresse";
    private const CHAMP_ID = "id";
    private const ENTETES_AGENCES = [AgenceDao::CHAMP_ID, AgenceDao::CHAMP_NOM_AGENCE, AgenceDao::CHAMP_ADRESSE_AGENCE];

    public function saveAll(array $agences): void
    {
        $handle = fopen(FILE_SAVE_AGENCE, ConstantesDao::FILE_OPTION_W_PLUS);
        if (!empty(AgenceDao::ENTETES_AGENCES)) {
            fputcsv($handle, AgenceDao::ENTETES_AGENCES, ConstantesDao::DELIM);
        }
        foreach ($agences as $agence) {
            fputcsv($handle, $agence->toArray(), ConstantesDao::DELIM);
        }
        fclose($handle);
    }

    public function getById($motif): Agence
    {
        return $this->getOneByAttribute(AgenceDao::CHAMP_ID, $motif);
    }


    public function getAll(): array
    {
        $handle = fopen(FILE_SAVE_AGENCE, ConstantesDao::FILE_OPTION_R);
        $entities = [];

        $entetes = fgetcsv($handle, 0, ConstantesDao::DELIM);

        while (($entity = fgetcsv($handle, 0, ConstantesDao::DELIM)) != false) {
            $entities[] = Agence::AgenceFromArray(array_combine($entetes, $entity));
        }

        fclose($handle);
        return $entities;
    }

    public function getByNom(string $motif): ?array
    {
        return $this->getAllByAttribute(AgenceDao::CHAMP_NOM_AGENCE, $motif);
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
    public function modify(Agence $newEntity): void
    {
        $allEntities = $this->getAll();
        foreach ($allEntities as $currentEntity) {
    
            if ($currentEntity->getId() === $newEntity[AgenceDao::CHAMP_ID]) {
                $currentEntity = $newEntity;
            }
        }
        $this->saveAll($allEntities);
    }


    public function save(Agence $newAgence): Agence
    {
        $handle = fopen(FILE_SAVE_AGENCE, ConstantesDao::FILE_OPTION_A_PLUS);
        $newAgence->setId(str_pad($this->getNextId(), 3, "0", STR_PAD_LEFT));
        fputcsv($handle, $newAgence->toArray(), ConstantesDao::DELIM);
        fclose($handle);
        return $newAgence;
    }



    public function getNextId(): int
    {
        $handle = fopen(FILE_CPT_AGENCE, ConstantesDao::FILE_OPTION_A_PLUS);
        $currentId = intval(fgets($handle));
        fclose($handle);
        $handle = fopen(FILE_CPT_AGENCE, ConstantesDao::FILE_OPTION_W_PLUS);
        fputs($handle, $currentId+1);
        fclose($handle);
        return $currentId;
    }

    public function getOneByAttribute(string $attribute, string $motif): ?Agence
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
                $entitiesCherchees[] = Agence::AgenceFromArray($entity);
            }
        }
        return $entitiesCherchees;
    }
}

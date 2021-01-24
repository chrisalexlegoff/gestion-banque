<?php

require_once "ConstantesDao.php";
define('FILE_SAVE_COMPTE', $_SERVER['DOCUMENT_ROOT'] . "/GestionBanque/donnees/save_comptes.csv");
define('FILE_CPT_COMPTE', $_SERVER['DOCUMENT_ROOT'] . "/GestionBanque/donnees/compteurs/cpt_comptes.txt");

class CompteDao
{
    private const CHAMP_ID = "id";
    private const CHAMP_TYPE = "type";
    private const CHAMP_SOLDE = "solde";
    private const CHAMP_EST_AUTORISE = "estAutorise";
    private const CHAMP_CLIENT = "id_client";
    private const CHAMP_AGENCE = "id_agence";

    private AgenceDao $agenceDao;
    private UserDao $userDao;

    public function __construct()
    {
        $this->agenceDao = new AgenceDao();
        $this->userDao = new UserDao();
    }


    private const ENTETES_COMPTES = [
        CompteDao::CHAMP_ID,
        CompteDao::CHAMP_TYPE,
        CompteDao::CHAMP_SOLDE,
        CompteDao::CHAMP_EST_AUTORISE,
        CompteDao::CHAMP_CLIENT,
        CompteDao::CHAMP_AGENCE
    ];
    public function saveAll(array $comptes): void
    {
        $handle = fopen(FILE_SAVE_COMPTE, ConstantesDao::FILE_OPTION_W_PLUS);
        if (!empty(CompteDao::ENTETES_COMPTES)) {
            fputcsv($handle, CompteDao::ENTETES_COMPTES, ConstantesDao::DELIM);
        }
        foreach ($comptes as $compte) {
            fputcsv($handle, $compte->toArray(), ConstantesDao::DELIM);
        }
        fclose($handle);
    }

    public function getByNumeroCompte($motif): Compte
    {
        return $this->getOneByAttribute(CompteDao::CHAMP_ID, $motif);
    }
    public function getByIdClient($motif): array
    {
        $allEntities = $this->getAll();
        $entitiesCherchees = [];
        foreach ($allEntities as $entity) {

            if ($entity->getClient() != null && strtolower($entity->getClient()->getId()) === strtolower($motif)) {
                $entitiesCherchees[] = $entity;
            }
        }
        return $entitiesCherchees;
    }
    public function possedUnCompteDeType(int $idClient, string $typeCompte)
    {
        $comptes = $this->getByIdClient($idClient);
        foreach ($comptes as $compte) {
            if ($compte->getType() === $typeCompte)
                return true;
        }
        return false;
    }

    public function getByIdAgence($motif): array
    {
        $allEntities = $this->getAll();
        $entitiesCherchees = [];
        foreach ($allEntities as $entity) {

            if ($entity->agence != null && strtolower($entity->agence->getId()) === strtolower($motif)) {
                $compte = Compte::CompteFromArray($entity);

                $entitiesCherchees[] = $compte;
            }
        }
        return $entitiesCherchees;
    }

    public function getAll(): array
    {
        $handle = fopen(FILE_SAVE_COMPTE, ConstantesDao::FILE_OPTION_R);
        $entities = [];

        $entetes = fgetcsv($handle, 0, ConstantesDao::DELIM);

        while (($entity = fgetcsv($handle, 0, ConstantesDao::DELIM)) != false) {
            if (count($entity) === 6) {
                $compte =  Compte::CompteFromArray(array_combine($entetes, $entity));
                $id = $compte->getAgence()->getId();
                $agence = $this->agenceDao->getById($id);
                $compte->setAgence($agence);
                $client = $this->clientDao->getById($compte->getClient()->getId());
                $compte->setClient($client);
                $entities[] = $compte;
            }
        }

        fclose($handle);
        return $entities;
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
    public function modify(Compte $newEntity): void
    {
        $allEntities = $this->getAll();
        foreach ($allEntities as $currentEntity) {
            if ($currentEntity->getId() === $newEntity[CompteDao::CHAMP_ID]) {
                $currentEntity = $newEntity;
            }
        }
        $this->saveAll($allEntities);
    }


    public function save(Compte $newCompte): Compte
    {
        $handle = fopen(FILE_SAVE_COMPTE, ConstantesDao::FILE_OPTION_A_PLUS);
        $newCompte->setId(str_pad($this->getNextId(), 11, "0", STR_PAD_LEFT));
        fputcsv($handle, $newCompte->toArray(), ConstantesDao::DELIM);
        fclose($handle);
        return $newCompte;
    }



    public function getNextId(): int
    {
        $handle = fopen(FILE_CPT_COMPTE, ConstantesDao::FILE_OPTION_A_PLUS);
        $currentId = intval(fgets($handle));
        $currentId++;
        fclose($handle);
        $handle = fopen(FILE_CPT_COMPTE, ConstantesDao::FILE_OPTION_W_PLUS);
        fputs($handle, $currentId);
        fclose($handle);
        return $currentId;
    }

    public function getOneByAttribute(string $attribute, string $motif): ?Compte
    {
        $allEntities = $this->getAll();
        foreach ($allEntities as $entity) {
            $getter = "get" . ucfirst($attribute);
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
            $getter = "get" . ucfirst($attribute);
            if (strtolower($entity->$getter()) === strtolower($motif)) {
                $entitiesCherchees[] = Compte::CompteFromArray($entity);
            }
        }
        return $entitiesCherchees;
    }
}

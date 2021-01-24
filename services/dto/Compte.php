<?php

class Compte
{
    private ?int $id;
    private ?string $type;
    private ?string $solde;
    private ?bool $estAutorise;
    private ?Client $client;
    private ?Agence $agence;

    

    public function __construct(
        ?string $type = null,
        ?string $solde = null,
        ?bool $estAutorise = null,
        ?Client $client = null,
        ?Agence $agence = null
    ) {
        $this->id = null;
        $this->type = $type;
        $this->solde = $solde;
        $this->estAutorise = $estAutorise;
        $this->client = $client;
        $this->agence = $agence;
    }




    /**
     * Get the value of id
     *
     * @return  mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param   mixed  $id  
     *
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }



    /**
     * Get the value of type
     *
     * @return  mixed
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param   mixed  $type  
     *
     * @return  self
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * Get the value of solde
     *
     * @return  mixed
     */
    public function getSolde(): float
    {
        return $this->solde;
    }

    /**
     * Set the value of solde
     *
     * @param   mixed  $solde  
     *
     * @return  self
     */
    public function setSolde(float $solde)
    {
        $this->solde = $solde;
    }

    /**
     * Get the value of estAutorise
     *
     * @return  mixed
     */
    public function getEstAutorise(): bool
    {
        return $this->estAutorise;
    }

    /**
     * Set the value of estAutorise
     *
     * @param   mixed  $estAutorise  
     *
     * @return  self
     */
    public function setEstAutorise(bool $estAutorise)
    {
        $this->estAutorise = $estAutorise;
    }

    /**
     * Get the value of client
     *
     * @return  mixed
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Set the value of client
     *
     * @param   mixed  $client  
     *
     * @return  self
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get the value of agence
     *
     * @return  mixed
     */
    public function getAgence(): Agence
    {
        return $this->agence;
    }

    /**
     * Set the value of agence
     *
     * @param   mixed  $agence  
     *
     * @return  self
     */
    public function setAgence(Agence $agence)
    {
        $this->agence = $agence;
    }




    public function toArray(): array
    {
        $tmp = [];
        $tmp[] = $this->id;
        $tmp[] = $this->type;
        $tmp[] = $this->solde;
        $tmp[] = $this->estAutorise;
        $tmp[] = $this->client->getId();
        $tmp[] = $this->agence->getId();
        return $tmp;
    }

    public static function CompteFromArray(array $tab): ?Compte
    {
        $compte = new static();
        $compte->id = $tab["id"];
        $compte->type = $tab["type"];
        $compte->solde = $tab["solde"];
        $compte->estAutorise = boolval($tab["estAutorise"]);
        $client = new Client();
        $client->setId($tab["client"]);
        $compte->client = $client;
        $agence = new Agence();
        $agence->setId($tab["agence"]);
        $compte->agence = $agence;

        return $compte;
    }


    public static function  CompteEnterKeybord(): Compte
    {
        echo "Nouveau Compte : \n";
        echo "Veuillez choisir le type : \n";
        echo "    1- Compte courant. \n ";
        echo "    2- Livret A. \n ";
        echo "    Autre texte : Plan epargne\n ";


        $type = readline("            choix: ");
        if ($type === "1") {
            $type = "CC";
        } elseif ($type === "2") {
            $type = "LA";
        } else {
            $type = "PE";
        }
        $solde = floatval(readline("Solde ? "));
        $estAutorise = strtolower(readline("EstAutorise o(ui)/n(on) ? "));
        if ($estAutorise === "o" || "oui") {
            $estAutorise = true;
        } else {
            $estAutorise = false;
        }
        $idClient = readline("id Client ? ");
        $client = new Client();
        $client->setId($idClient);

        $idAgence = readline("id Agence ? ");
        $agence = new Agence();
        $agence->setId($idAgence);

        $compte = new static();
        $compte->type = $type;
        $compte->solde = $solde;
        $compte->estAutorise = $estAutorise;
        $compte->client = $client;
        $compte->agence = $agence;
        return $compte;
    }
}

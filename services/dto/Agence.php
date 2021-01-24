<?php

class Agence
{
    private ?int $id = null;
    private ?string $nom;
    private ?string $adresse;


    public function __construct( ?string $nom = null, ?string $adresse = null)
    {
        
        $this->nom = $nom;
        $this->adresse = $adresse;
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
     * Get the value of nom
     *
     * @return  mixed
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param   mixed  $nom  
     *
     * @return  self
     */
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    /**
     * Get the value of adresse
     *
     * @return  mixed
     */
    public function getAdresse(): string
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @param   mixed  $adresse  
     *
     * @return  self
     */
    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;
    }


    public function toArray(): array
    {
        /*$tmp = [];
        $tmp[] = $this->id;
        $tmp[] = $this->nom;
        $tmp[] = $this->adresse;
        return $tmp;*/
        return get_object_vars($this);
    }

    public static function AgenceFromArray(array $tab): ?Agence
    {
        $agence = new static();
        foreach ($tab as $key => $value) {
            $agence->$key = $value;
        }
        return $agence;
    }


    public static function  AgenceEnterKeybord(): Agence
    {
        echo "Nouvelle Agence : \n";
        $nom = readline("Nom agence ? ");
        $adresse = readline("adresse agance ? ");

        return new static($nom,$adresse);
    }
}

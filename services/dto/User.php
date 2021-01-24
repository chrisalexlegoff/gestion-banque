<?php
require_once "../helpers/DateHelper.php";
class User
{

    private ?int $id;
    private ?string $numeroUser;
    private ?string $nom;
    private ?string $prenom;
    private ?DateTime $dateNaissance;
    private ?string $telephone;
    private ?string $email;
    private ?string $adresse;
    private ?string $type;

    public function __construct(
        ?string $numeroUser = null,
        ?string $nom = null,
        ?string $prenom = null,
        ?DateTime $dateNaissance = null,
        ?string $telephone = null,
        ?string $email = null,
        ?string $adresse = null,
        ?string $type = null
    ) {

        $this->numeroUser = $numeroUser;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->adresse = $adresse;
        $this->type = $type;
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
    public static function setId(int $id)
    {
        return $id;
    }

    /**
     * Get the value of numeroUser
     *
     * @return  mixed
     */
    public function getNumeroUser(): string
    {
        return $this->numeroUser;
    }

    /**
     * Set the value of numeroUser
     *
     * @param   mixed  $numeroUser  
     *
     * @return  self
     */
    public static function setNumeroUser(string $numeroUser)
    {
        return $numeroUser;
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
     * Get the value of prenom
     *
     * @return  mixed
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @param   mixed  $prenom  
     *
     * @return  self
     */
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * Get the value of dateNaissance
     *
     * @return  mixed
     */
    public function getDateNaissance(): ?DateTime
    {
        return $this->dateNaissance;
    }

    /**
     * Set the value of dateNaissance
     *
     * @param   mixed  $dateNaissance  
     *
     * @return  self
     */
    public function setDateNaissance(?DateTime $dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * Get the value of telephone
     *
     * @return  mixed
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @param   mixed  $telephone  
     *
     * @return  self
     */
    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * Get the value of email
     *
     * @return  mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param   mixed  $email  
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
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
   
    /**
     * getType
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function toArray(): array
    {
        $tab=[];
        $tab[]=$this->id;
        $tab[]=$this->numeroUser;
        $tab[]=$this->nom;
        $tab[]=$this->prenom;
        $tab[]=$this->dateNaissance->format("Y-m-d");
        $tab[]=$this->telephone ;
        $tab[]=$this->email;
        $tab[]=$this->adresse; 
        $tab[]=$this->type; 
        return $tab;
    }

    public static function UserFromArray(array $tab): ?user
    {
        $User = new static();
        foreach ($tab as $key => $value) {
            if ($key !== "dateNaissance") {
                $User->$key = $value;
            } else {
                $User->setDateNaissance( DateHelper::toDateTime($value));
            }
        }
        return $User;
    }


    public static function  UserEnterKeybord(): user
    {
        echo "Nouvel utilisateur : \n";
        $user = new static();
        $user->nom = readline("Nom ? ");
        $user->prenom = readline("prenom ? ");
        $dateNaissanceString = readline("Date de naissance (format: AAAA-MM-JJ) ? ");
        $user->dateNaissance  = DateHelper::toDateTime($dateNaissanceString);
        $user->telephone = readline("Telephone ? ");
        $user->email = readline("Email ? ");
        $user->adresse = readline("Adresse ? ");
        $user->type = readline("type ? ");
        return $user;
    }
   
}

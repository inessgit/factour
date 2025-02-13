<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vente
 *
 * @ORM\Table(name="vente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VenteRepository")
 */
class Vente
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="remise", type="float")
     */
    private $remise;

    /**
     * @var float
     *
     * @ORM\Column(name="montantRemise", type="float")
     */
    private $montantRemise;

    /**
     * @var float
     *
     * @ORM\Column(name="tva", type="float")
     */
    private $tva;

    /**
     * @var float
     *
     * @ORM\Column(name="montantTva", type="float")
     */
    private $montantTva;

    /**
     * @var float
     *
     * @ORM\Column(name="netCom", type="float")
     */
    private $netCom;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;

    /**
     * @var string
     *
     * @ORM\Column(name="nomClient", type="string", length=255)
     */
    private $nomClient;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseClient", type="string", length=255)
     */
    private $adresseClient;

    /**
     * @var string
     *
     * @ORM\Column(name="telClient", type="string", length=255)
     */
    private $telClient;

    /**
     * @ORM\OneToMany(targetEntity="LigneVente", mappedBy="vente")
     */
    private $ligneVentes;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="avec_pu", type="boolean", nullable=true)
     */
    private $avecPu;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ligneVentes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Vente
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set remise
     *
     * @param float $remise
     *
     * @return Vente
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;

        return $this;
    }

    /**
     * Get remise
     *
     * @return float
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Set montantRemise
     *
     * @param float $montantRemise
     *
     * @return Vente
     */
    public function setMontantRemise($montantRemise)
    {
        $this->montantRemise = $montantRemise;

        return $this;
    }

    /**
     * Get montantRemise
     *
     * @return float
     */
    public function getMontantRemise()
    {
        return $this->montantRemise;
    }

    /**
     * Set tva
     *
     * @param float $tva
     *
     * @return Vente
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return float
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set montantTva
     *
     * @param float $montantTva
     *
     * @return Vente
     */
    public function setMontantTva($montantTva)
    {
        $this->montantTva = $montantTva;

        return $this;
    }

    /**
     * Get montantTva
     *
     * @return float
     */
    public function getMontantTva()
    {
        return $this->montantTva;
    }

    /**
     * Set netCom
     *
     * @param float $netCom
     *
     * @return Vente
     */
    public function setNetCom($netCom)
    {
        $this->netCom = $netCom;

        return $this;
    }

    /**
     * Get netCom
     *
     * @return float
     */
    public function getNetCom()
    {
        return $this->netCom;
    }

    /**
     * Set total
     *
     * @param float $total
     *
     * @return Vente
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set nomClient
     *
     * @param string $nomClient
     *
     * @return Vente
     */
    public function setNomClient($nomClient)
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    /**
     * Get nomClient
     *
     * @return string
     */
    public function getNomClient()
    {
        return $this->nomClient;
    }

    /**
     * Set adresseClient
     *
     * @param string $adresseClient
     *
     * @return Vente
     */
    public function setAdresseClient($adresseClient)
    {
        $this->adresseClient = $adresseClient;

        return $this;
    }

    /**
     * Get adresseClient
     *
     * @return string
     */
    public function getAdresseClient()
    {
        return $this->adresseClient;
    }

    /**
     * Set telClient
     *
     * @param string $telClient
     *
     * @return Vente
     */
    public function setTelClient($telClient)
    {
        $this->telClient = $telClient;

        return $this;
    }

    /**
     * Get telClient
     *
     * @return string
     */
    public function getTelClient()
    {
        return $this->telClient;
    }

    /**
     * Add ligneVente
     *
     * @param \AppBundle\Entity\LigneVente $ligneVente
     *
     * @return Vente
     */
    public function addLigneVente(\AppBundle\Entity\LigneVente $ligneVente)
    {
        $this->ligneVentes[] = $ligneVente;

        return $this;
    }

    /**
     * Remove ligneVente
     *
     * @param \AppBundle\Entity\LigneVente $ligneVente
     */
    public function removeLigneVente(\AppBundle\Entity\LigneVente $ligneVente)
    {
        $this->ligneVentes->removeElement($ligneVente);
    }

    /**
     * Get ligneVentes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLigneVentes()
    {
        return $this->ligneVentes;
    }

    /**
     * Set avecPu
     *
     * @param boolean $avecPu
     *
     * @return Vente
     */
    public function setAvecPu($avecPu)
    {
        $this->avecPu = $avecPu;

        return $this;
    }

    /**
     * Get avecPu
     *
     * @return boolean
     */
    public function getAvecPu()
    {
        return $this->avecPu;
    }
}

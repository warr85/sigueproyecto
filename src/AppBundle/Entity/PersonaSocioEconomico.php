<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 29/06/16
 * Time: 08:38 AM
 */


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PersonaSocioEconomico
 *
 * @ORM\Table(name="persona_socioeconomico", indexes={@ORM\Index(name="fki_socioeconomico_persona", columns={"id_persona"})})
 * @ORM\Entity
 */
class PersonaSocioEconomico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "identificador de registro rol institucion"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="rol_institucion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Persona", inversedBy="socioEconomico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPersona;

    /**
     * @var bool
     *  @ORM\Column(name="trabaja", type="boolean", nullable=true, options={"comment" = "indica si la persona trabaja actualmente", "default" = false}) 
     *  
     */
    private $trabaja;


    /**
     * @var decimal
     *  @ORM\Column(name="aporte", type="decimal", nullable=true, options={"comment" = "indica si la persona aporta ecnomicamente a su hogar"}) 
     *  
     */
    private $aporte;

    /**
     * @var decimal
     *  @ORM\Column(name="ingreso_familiar", type="decimal", nullable=true, options={"comment" = "indica el ingreso total familiar"}) 
     *  
     */
    private $ingresoFamiliar;

    


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
     * Set idPersona
     *
     * @param \AppBundle\Entity\Persona $idPersona
     * @return PersonaInstitucion
     */
    public function setIdPersona(\AppBundle\Entity\Persona $idPersona = null)
    {
        $this->idPersona = $idPersona;

        return $this;
    }

    /**
     * Get idPersona
     *
     * @return \AppBundle\Entity\Persona
     */
    public function getIdPersona()
    {
        return $this->idPersona;
    }

    /**
     * Set idInstitucion
     *
     * @param \AppBundle\Entity\Institucion $idInstitucion
     * @return RolInstitucion
     */
    public function setIdInstitucion(\AppBundle\Entity\Institucion $idInstitucion = null)
    {
        $this->idInstitucion = $idInstitucion;

        return $this;
    }

    /**
     * Get idInstitucion
     *
     * @return \AppBundle\Entity\Institucion
     */
    public function getIdInstitucion()
    {
        return $this->idInstitucion;
    }

    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return RolInstitucion
     */
    public function setIdEstatus(\AppBundle\Entity\Estatus $idEstatus = null)
    {
        $this->idEstatus = $idEstatus;

        return $this;
    }

    /**
     * Get idEstatus
     *
     * @return \AppBundle\Entity\Estatus
     */
    public function getIdEstatus()
    {
        return $this->idEstatus;
    }


    /**
     * Get __toString
     * @return string
     *
     */
    public function __toString()
    {
        return $this->getIdPersona()->getPrimerNombre() .  ", " . $this->getIdPersona()->getPrimerApellido();
    }


    /**
     * Set trabaja
     *
     * @param boolean $trabaja
     * @return PersonaSocioEconomico
     */
    public function setTrabaja($trabaja)
    {
        $this->trabaja = $trabaja;

        return $this;
    }

    /**
     * Get trabaja
     *
     * @return boolean 
     */
    public function getTrabaja()
    {
        return $this->trabaja;
    }

    /**
     * Set aporte
     *
     * @param string $aporte
     * @return PersonaSocioEconomico
     */
    public function setAporte($aporte)
    {
        $this->aporte = $aporte;

        return $this;
    }

    /**
     * Get aporte
     *
     * @return string 
     */
    public function getAporte()
    {
        return $this->aporte;
    }

    /**
     * Set ingresoFamiliar
     *
     * @param string $ingresoFamiliar
     * @return PersonaSocioEconomico
     */
    public function setIngresoFamiliar($ingresoFamiliar)
    {
        $this->ingresoFamiliar = $ingresoFamiliar;

        return $this;
    }

    /**
     * Get ingresoFamiliar
     *
     * @return string 
     */
    public function getIngresoFamiliar()
    {
        return $this->ingresoFamiliar;
    }
}

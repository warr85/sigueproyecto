<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonaFamiliar
 *
 * @ORM\Table(name="persona_familiar", indexes={@ORM\Index(name="IDX_PARENTESCO", columns={"id_parentesco"})})
 * @ORM\Entity
 */
class PersonaFamiliar
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="jefe_familiar", type="boolean", nullable=false, options={"comment" = "Indica si la persona es Jefe de Familia"})
     */
    private $jefeFamiliar;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del registro"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="familiar_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona", inversedBy="familiares")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPersona;

    /**
     * @var \AppBundle\Entity\Parentesco
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Parentesco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parentesco", referencedColumnName="id", nullable=false)
     * })
     */
    private $idParentesco;


    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, options={"comment" = "Nombre del genero"})
     */
    private $nombre;



 /**
     * @var \AppBundle\Entity\NivelInstruccion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\NivelInstruccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_nivel_instruccion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idNivelInstruccion;



    /**
     * Set jefeFamiliar
     *
     * @param boolean $jefeFamiliar
     * @return PersonaFamiliar
     */
    public function setJefeFamiliar($jefeFamiliar)
    {
        $this->jefeFamiliar = $jefeFamiliar;

        return $this;
    }

    /**
     * Get jefeFamiliar
     *
     * @return boolean 
     */
    public function getJefeFamiliar()
    {
        return $this->jefeFamiliar;
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
     * Set idPersona
     *
     * @param \AppBundle\Entity\Persona $idPersona
     * @return PersonaFamiliar
     */
    public function setIdPersona(\AppBundle\Entity\Persona $idPersona)
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
     * Set idParentesco
     *
     * @param \AppBundle\Entity\Parentesco $idParentesco
     * @return PersonaFamiliar
     */
    public function setIdParentesco(\AppBundle\Entity\Parentesco $idParentesco)
    {
        $this->idParentesco = $idParentesco;

        return $this;
    }

    /**
     * Get idParentesco
     *
     * @return \AppBundle\Entity\Parentesco 
     */
    public function getIdParentesco()
    {
        return $this->idParentesco;
    }

    /**
     * Set idNivelInstruccion
     *
     * @param \AppBundle\Entity\NivelInstruccion $idNivelInstruccion
     * @return PersonaFamiliar
     */
    public function setIdNivelInstruccion(\AppBundle\Entity\NivelInstruccion $idNivelInstruccion)
    {
        $this->idNivelInstruccion = $idNivelInstruccion;

        return $this;
    }

    /**
     * Get idNivelInstruccion
     *
     * @return \AppBundle\Entity\NivelInstruccion 
     */
    public function getIdNivelInstruccion()
    {
        return $this->idNivelInstruccion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return PersonaFamiliar
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}

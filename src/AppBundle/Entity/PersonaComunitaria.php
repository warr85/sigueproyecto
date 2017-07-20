<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonaComunitaria
 *
 * @ORM\Table(name="persona_comunitaria", indexes={@ORM\Index(name="IDX_EF7520FEC15ED91C", columns={"id_mision"}), @ORM\Index(name="IDX_EF7520FE8F781FEB", columns={"id_persona"})})
 * @ORM\Entity
 */
class PersonaComunitaria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="mision_persona_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona", inversedBy="misiones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPersona;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=200, nullable=false, options={"comment" = "Nombre de la organización comunitaria"})
     */
    private $nombre;


    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion", type="text", length=200, nullable=false, options={"comment" = "Ubicacion de la organización comunitaria"})
     */
    private $ubicacion;


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
     * @return PersonaComunitaria
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
     * Set nombre
     *
     * @param string $nombre
     * @return PersonaComunitaria
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

    /**
     * Set ubicacion
     *
     * @param string $ubicacion
     * @return PersonaComunitaria
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return string 
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getNombre() . " -> " . $this->$this->getUbicacion();
    }

}

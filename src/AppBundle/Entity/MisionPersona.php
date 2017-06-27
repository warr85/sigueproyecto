<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MisionPersona
 *
 * @ORM\Table(name="mision_persona", indexes={@ORM\Index(name="IDX_EF7520FEC15ED91C", columns={"id_mision"}), @ORM\Index(name="IDX_EF7520FE8F781FEB", columns={"id_persona"})})
 * @ORM\Entity
 */
class MisionPersona
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPersona;

    /**
     * @var \AppBundle\Entity\Mision
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Mision")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_mision", referencedColumnName="id", nullable=false)
     * })
     */
    private $idMision;





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
     * @return MisionPersona
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
     * Set idMision
     *
     * @param \AppBundle\Entity\Mision $idMision
     * @return MisionPersona
     */
    public function setIdMision(\AppBundle\Entity\Mision $idMision)
    {
        $this->idMision = $idMision;

        return $this;
    }

    /**
     * Get idMision
     *
     * @return \AppBundle\Entity\Mision 
     */
    public function getIdMision()
    {
        return $this->idMision;
    }
}

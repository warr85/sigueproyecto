<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonaDiscapacidad
 *
 * @ORM\Table(name="persona_discapacidad", uniqueConstraints={@ORM\UniqueConstraint(name="i_persona_discapacidad", columns={"id_persona", "id_discapacidad"})}, indexes={@ORM\Index(name="fki_discapacidad_persona_discapacidad", columns={"id_discapacidad"}), @ORM\Index(name="IDX_E3CA7FB18F781FEB", columns={"id_persona"})})
 * @ORM\Entity
 */
class PersonaDiscapacidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "identificador del registro"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="persona_discapacidad_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPersona;

    /**
     * @var \AppBundle\Entity\Discapacidad
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Discapacidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_discapacidad", referencedColumnName="id", nullable=false)
     * })
     */
    private $idDiscapacidad;





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
     * @return PersonaDiscapacidad
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
     * Set idDiscapacidad
     *
     * @param \AppBundle\Entity\Discapacidad $idDiscapacidad
     * @return PersonaDiscapacidad
     */
    public function setIdDiscapacidad(\AppBundle\Entity\Discapacidad $idDiscapacidad)
    {
        $this->idDiscapacidad = $idDiscapacidad;

        return $this;
    }

    /**
     * Get idDiscapacidad
     *
     * @return \AppBundle\Entity\Discapacidad 
     */
    public function getIdDiscapacidad()
    {
        return $this->idDiscapacidad;
    }
}

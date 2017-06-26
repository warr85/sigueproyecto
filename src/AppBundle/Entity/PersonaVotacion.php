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
use AppBundle\Entity\Estatus;

/**
 * PersonaVotacion
 *
 * @ORM\Table(name="persona_votacion", uniqueConstraints={@ORM\UniqueConstraint(name="i_persona_centro_votacion", columns={"id_centro_votacion", "id_persona"})}, indexes={ @ORM\Index(name="fki_persona_centro_votacion", columns={"id_persona"}), @ORM\Index(name="IDX_centro_votacion", columns={"id_centro_votacion"})})
 * @ORM\Entity
 */
class PersonaVotacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "identificador de la tabla"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="rol_institucion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Persona", inversedBy="centroVotacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPersona;

    /**
     * @var \AppBundle\Entity\CentroVotacion
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\CentroVotacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro_votacion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCentroVotacion;





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
     * @return PersonaVotacion
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
     * Set idCentroVotacion
     *
     * @param \AppBundle\Entity\CentroVotacion $idCentroVotacion
     * @return PersonaVotacion
     */
    public function setIdCentroVotacion(\AppBundle\Entity\CentroVotacion $idCentroVotacion)
    {
        $this->idCentroVotacion = $idCentroVotacion;

        return $this;
    }

    /**
     * Get idCentroVotacion
     *
     * @return \AppBundle\Entity\CentroVotacion 
     */
    public function getIdCentroVotacion()
    {
        return $this->idCentroVotacion;
    }
}

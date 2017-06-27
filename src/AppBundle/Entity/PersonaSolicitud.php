<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonaSolicitud
 *
 * @ORM\Table(name="persona_solicitud", uniqueConstraints={@ORM\UniqueConstraint(name="i_solicitud", columns={"id_persona_institucion", "id_tipo_solicitud", "id_estatus_proceso", "id_periodo"})}, indexes={@ORM\Index(name="fki_periodo_solicitud", columns={"id_periodo"}), @ORM\Index(name="fki_tipo_solicitud_solicitud", columns={"id_tipo_solicitud"}), @ORM\Index(name="fki_estatus_proceso_solicitud", columns={"id_estatus_proceso"}), @ORM\Index(name="IDX_96D27CC0C6E707A", columns={"id_persona_institucion"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonaSolicitud
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=false, options={"comment" = "fecha enla quese genero la solicitud"})
     */
    private $fechaSolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "identificador de la solicitud"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="solicitud_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\TipoSolicitud
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TipoSolicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_solicitud", referencedColumnName="id", nullable=false)
     * })
     */
    private $idTipoSolicitud;

    /**
     * @var \AppBundle\Entity\PersonaInstitucion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PersonaInstitucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona_institucion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPersonaInstitucion;

    /**
     * @var \AppBundle\Entity\Periodo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Periodo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_periodo", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPeriodo;

    /**
     * @var \AppBundle\Entity\EstatusProceso
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EstatusProceso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estatus_proceso", referencedColumnName="id", nullable=false)
     * })
     */
    private $idEstatusProceso;


    /**
     * Set fechaSolicitud
     *
     * @param \DateTime $fechaSolicitud
     * @return PersonaSolicitud
     */
    public function setFechaSolicitud($fechaSolicitud)
    {
        $this->fechaSolicitud = $fechaSolicitud;

        return $this;
    }

    /**
     * Get fechaSolicitud
     *
     * @return \DateTime 
     */
    public function getFechaSolicitud()
    {
        return $this->fechaSolicitud;
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
     * Set idTipoSolicitud
     *
     * @param \AppBundle\Entity\TipoSolicitud $idTipoSolicitud
     * @return PersonaSolicitud
     */
    public function setIdTipoSolicitud(\AppBundle\Entity\TipoSolicitud $idTipoSolicitud)
    {
        $this->idTipoSolicitud = $idTipoSolicitud;

        return $this;
    }

    /**
     * Get idTipoSolicitud
     *
     * @return \AppBundle\Entity\TipoSolicitud 
     */
    public function getIdTipoSolicitud()
    {
        return $this->idTipoSolicitud;
    }

    /**
     * Set idPersonaInstitucion
     *
     * @param \AppBundle\Entity\PersonaInstitucion $idPersonaInstitucion
     * @return PersonaSolicitud
     */
    public function setIdPersonaInstitucion(\AppBundle\Entity\PersonaInstitucion $idPersonaInstitucion)
    {
        $this->idPersonaInstitucion = $idPersonaInstitucion;

        return $this;
    }

    /**
     * Get idPersonaInstitucion
     *
     * @return \AppBundle\Entity\PersonaInstitucion 
     */
    public function getIdPersonaInstitucion()
    {
        return $this->idPersonaInstitucion;
    }

    /**
     * Set idPeriodo
     *
     * @param \AppBundle\Entity\Periodo $idPeriodo
     * @return PersonaSolicitud
     */
    public function setIdPeriodo(\AppBundle\Entity\Periodo $idPeriodo)
    {
        $this->idPeriodo = $idPeriodo;

        return $this;
    }

    /**
     * Get idPeriodo
     *
     * @return \AppBundle\Entity\Periodo 
     */
    public function getIdPeriodo()
    {
        return $this->idPeriodo;
    }

    /**
     * Set idEstatusProceso
     *
     * @param \AppBundle\Entity\EstatusProceso $idEstatusProceso
     * @return PersonaSolicitud
     */
    public function setIdEstatusProceso(\AppBundle\Entity\EstatusProceso $idEstatusProceso)
    {
        $this->idEstatusProceso = $idEstatusProceso;

        return $this;
    }

    /**
     * Get idEstatusProceso
     *
     * @return \AppBundle\Entity\EstatusProceso 
     */
    public function getIdEstatusProceso()
    {
        return $this->idEstatusProceso;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->fechaSolicitud = new \DateTime();

    }
}

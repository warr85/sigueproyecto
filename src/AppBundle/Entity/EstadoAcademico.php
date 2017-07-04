<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EstadoAcademico
 *
 * @ORM\Table(name="estado_academico", indexes={@ORM\Index(name="fki_id_perido", columns={"id_periodo"}), @ORM\Index(name="fki_solicitud_estado_academico", columns={"id_persona_solicitud"}), @ORM\Index(name="fki_grado_academico_estado_academico", columns={"id_grado_academico"}), @ORM\Index(name="fki_malla_curricular_estado_academico", columns={"id_malla_curricular"}), @ORM\Index(name="fki_persona_institucion_estado_academico", columns={"id_persona_institucion"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EstadoAcademico
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false, options={"comment" = "fecha de registro del estdo academico"})
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=255, nullable=true, options={"comment" = "observacion del registro"})
     */
    private $observacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "identificador del estado academico"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="estado_academico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\PersonaSolicitud
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PersonaSolicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona_solicitud", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPersonaSolicitud;

    /**
     * @var \AppBundle\Entity\PersonaInstitucion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PersonaInstitucion", inversedBy="estados_academicos")
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
     * @var \AppBundle\Entity\MallaCurricular
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MallaCurricular")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_malla_curricular", referencedColumnName="id", nullable=false)
     * })
     */
    private $idMallaCurricular;

    /**
     * @var \AppBundle\Entity\GradoAcademico
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\GradoAcademico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grado_academico", referencedColumnName="id",nullable=false)
     * })
     */
    private $idGradoAcademico;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Inscripcion", mappedBy="idEstadoAcademico", cascade={"all"})
     * */
    protected $hasInscripcion;





    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return EstadoAcademico
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return EstadoAcademico
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string 
     */
    public function getObservacion()
    {
        return $this->observacion;
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
     * Set idPersonaSolicitud
     *
     * @param \AppBundle\Entity\PersonaSolicitud $idPersonaSolicitud
     * @return EstadoAcademico
     */
    public function setIdPersonaSolicitud(\AppBundle\Entity\PersonaSolicitud $idPersonaSolicitud)
    {
        $this->idPersonaSolicitud = $idPersonaSolicitud;

        return $this;
    }

    /**
     * Get idPersonaSolicitud
     *
     * @return \AppBundle\Entity\PersonaSolicitud 
     */
    public function getIdPersonaSolicitud()
    {
        return $this->idPersonaSolicitud;
    }

    /**
     * Set idPersonaInstitucion
     *
     * @param \AppBundle\Entity\PersonaInstitucion $idPersonaInstitucion
     * @return EstadoAcademico
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
     * @return EstadoAcademico
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
     * Set idMallaCurricular
     *
     * @param \AppBundle\Entity\MallaCurricular $idMallaCurricular
     * @return EstadoAcademico
     */
    public function setIdMallaCurricular(\AppBundle\Entity\MallaCurricular $idMallaCurricular)
    {
        $this->idMallaCurricular = $idMallaCurricular;

        return $this;
    }

    /**
     * Get idMallaCurricular
     *
     * @return \AppBundle\Entity\MallaCurricular 
     */
    public function getIdMallaCurricular()
    {
        return $this->idMallaCurricular;
    }

    /**
     * Set idGradoAcademico
     *
     * @param \AppBundle\Entity\GradoAcademico $idGradoAcademico
     * @return EstadoAcademico
     */
    public function setIdGradoAcademico(\AppBundle\Entity\GradoAcademico $idGradoAcademico)
    {
        $this->idGradoAcademico = $idGradoAcademico;

        return $this;
    }

    /**
     * Get idGradoAcademico
     *
     * @return \AppBundle\Entity\GradoAcademico 
     */
    public function getIdGradoAcademico()
    {
        return $this->idGradoAcademico;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->fecha = new \DateTime();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hasInscripcion = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add hasInscripcion
     *
     * @param \AppBundle\Entity\Inscripcion $hasInscripcion
     * @return EstadoAcademico
     */
    public function addHasInscripcion(\AppBundle\Entity\Inscripcion $hasInscripcion)
    {
        $this->hasInscripcion[] = $hasInscripcion;

        return $this;
    }

    /**
     * Remove hasInscripcion
     *
     * @param \AppBundle\Entity\Inscripcion $hasInscripcion
     */
    public function removeHasInscripcion(\AppBundle\Entity\Inscripcion $hasInscripcion)
    {
        $this->hasInscripcion->removeElement($hasInscripcion);
    }

    /**
     * Get hasInscripcion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHasInscripcion()
    {
        return $this->hasInscripcion;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscripcion
 *
 * @ORM\Table(name="inscripcion", uniqueConstraints={@ORM\UniqueConstraint(name="uq_estado_academico_id_seccion", columns={"estado_academico_id", "oferta_academica_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallBacks()
 */
class Inscripcion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador de la inscripcion del estudiante"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="inscripcion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EstadoAcademico", inversedBy="hasInscripcion")
     * @ORM\JoinColumn(name="estado_academico_id", referencedColumnName="id")
     * */
    private $idEstadoAcademico;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Seccion", inversedBy="hasInscripcion")
     * @ORM\JoinColumn(name="oferta_academica_id", referencedColumnName="id")
     * */
    private $idSeccion;


    /**
     * @var \AppBundle\Entity\EstatusUc
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EstatusUc")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estatus_uc", referencedColumnName="id", nullable=false)
     * })
     */
    private $idEstatusUc;


    /**
     * @var \AppBundle\Entity\SeccionComunidad
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SeccionComunidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_seccion_comunidad", referencedColumnName="id", nullable=false)
     * })
     */
    private $idSeccionComunidad;



    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\InscripcionUbicacion", mappedBy="idInscripcion", cascade={"persist","remove"})
     */
    private $ubicaciones;


    /**
     * @var \AppBundle\Entity\Estatus
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Estatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     * })
     */
    private $idEstatus;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date", nullable=false, options={"comment" = "fecha de creacion de la inscripcion"})
     */
    protected $created;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ultima_actualizacion", type="date", nullable=false, options={"comment" = "fecha de actualizacion de la inscripcion"})
     */
    protected $modified;






    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {

        $this->created = new \DateTime();
        $this->modified = new \DateTime();

    }


    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->modified = new \DateTime();

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
     * Set idEstadoAcademico
     *
     * @param \AppBundle\Entity\EstadoAcademico $idEstadoAcademico
     * @return Inscripcion
     */
    public function setIdEstadoAcademico(\AppBundle\Entity\EstadoAcademico $idEstadoAcademico = null)
    {
        $this->idEstadoAcademico = $idEstadoAcademico;

        return $this;
    }

    /**
     * Get idEstadoAcademico
     *
     * @return \AppBundle\Entity\EstadoAcademico
     */
    public function getIdEstadoAcademico()
    {
        return $this->idEstadoAcademico;
    }

    /**
     * Set idSeccion
     *
     * @param \AppBundle\Entity\Seccion $idSeccion
     * @return Inscripcion
     */
    public function setIdSeccion(\AppBundle\Entity\Seccion $idSeccion = null)
    {
        $this->idSeccion = $idSeccion;

        return $this;
    }

    /**
     * Get idSeccion
     *
     * @return \AppBundle\Entity\Seccion
     */
    public function getIdSeccion()
    {
        return $this->idSeccion;
    }

    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return Inscripcion
     */
    public function setIdEstatus(\AppBundle\Entity\Estatus $idEstatus)
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
     * Set created
     *
     * @param \DateTime $created
     * @return Inscripcion
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return Inscripcion
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @return string
     *
     */
    public function __toString() {
        return $this->getIdEstadoAcademico()->getIdPersonaInstitucion()->getIdPersona()->getPrimerNombre();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ubicaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ubicacione
     *
     * @param \AppBundle\Entity\InscripcionUbicacion $ubicacione
     *
     * @return Inscripcion
     */
    public function addUbicacione(\AppBundle\Entity\InscripcionUbicacion $ubicacione)
    {
        $this->ubicaciones[] = $ubicacione;

        return $this;
    }

    /**
     * Remove ubicacione
     *
     * @param \AppBundle\Entity\InscripcionUbicacion $ubicacione
     */
    public function removeUbicacione(\AppBundle\Entity\InscripcionUbicacion $ubicacione)
    {
        $this->ubicaciones->removeElement($ubicacione);
    }

    /**
     * Get ubicaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUbicaciones()
    {
        return $this->ubicaciones;
    }

    /**
     * Set idEstatusUc
     *
     * @param \AppBundle\Entity\EstatusUc $idEstatusUc
     *
     * @return Inscripcion
     */
    public function setIdEstatusUc(\AppBundle\Entity\EstatusUc $idEstatusUc)
    {
        $this->idEstatusUc = $idEstatusUc;

        return $this;
    }

    /**
     * Get idEstatusUc
     *
     * @return \AppBundle\Entity\EstatusUc
     */
    public function getIdEstatusUc()
    {
        return $this->idEstatusUc;
    }

    /**
     * Set idSeccionComunidad
     *
     * @param \AppBundle\Entity\SeccionComunidad $idSeccionComunidad
     *
     * @return Inscripcion
     */
    public function setIdSeccionComunidad(\AppBundle\Entity\SeccionComunidad $idSeccionComunidad)
    {
        $this->idSeccionComunidad = $idSeccionComunidad;

        return $this;
    }

    /**
     * Get idSeccionComunidad
     *
     * @return \AppBundle\Entity\SeccionComunidad
     */
    public function getIdSeccionComunidad()
    {
        return $this->idSeccionComunidad;
    }
}

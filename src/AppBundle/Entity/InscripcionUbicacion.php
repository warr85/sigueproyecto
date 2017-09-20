<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InscripcionUbicacion
 *
 * @ORM\Table(name="inscripcion_ubicacion", uniqueConstraints={@ORM\UniqueConstraint(name="uq_id_inscripcion_ubicacion_seccion", columns={"id_inscripcion", "id_seccion_comunidad"})})
 * @ORM\Entity
 */
class InscripcionUbicacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador de la inscripcion_ubicacion del estudiante"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="inscripcion_ubicacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * @var \AppBundle\Entity\Inscripcion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Inscripcion", inversedBy="ubicaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_inscripcion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idInscripcion;


    /**
     * @var \AppBundle\Entity\SeccionComunidad
     *
     * @ORM\ManyToOne(targetEntity="SeccionComunidad", inversedBy="hasUbicaciones", cascade={"all"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_seccion_comunidad", referencedColumnName="id", nullable=false)
     * })
     */
    private $idSeccionComunidad;


    /**
     * @var string
     *
     * @ORM\Column(name="comuna", type="string", length=20, nullable=false, options={"comment" = "nombre de la comuna"})
     */
    private $comuna;


    /**
     * @var string
     *
     * @ORM\Column(name="consejo_comunal", type="string", length=255, nullable=true, options={"comment" = "nombre del consejo comunal"})
     */
    private $consejoComunal;


    /**
     * @var string
     *
     * @ORM\Column(name="institucion", type="string", length=255, nullable=true, options={"comment" = "nombre de la institucion"})
     */
    private $institucion;


    /**
     * @var string
     *
     * @ORM\Column(name="organizacion_base", type="string", length=255, nullable=true, options={"comment" = "nombre de la organizacion base"})
     */
    private $organizacionBase;


    /**
     * @var string
     *
     * @ORM\Column(name="nombre_proyecto", type="string", length=20, nullable=false, options={"comment" = "nombre del proyecto de investigacion"})
     */
    private $nombreProyecto;


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
     * @return string
     *
     */
    public function __toString() {
        return $this->getNombreProyecto();
    }

    /**
     * Set comuna
     *
     * @param string $comuna
     * @return InscripcionUbicacion
     */
    public function setComuna($comuna)
    {
        $this->comuna = $comuna;

        return $this;
    }

    /**
     * Get comuna
     *
     * @return string 
     */
    public function getComuna()
    {
        return $this->comuna;
    }

    /**
     * Set consejoComunal
     *
     * @param string $consejoComunal
     * @return InscripcionUbicacion
     */
    public function setConsejoComunal($consejoComunal)
    {
        $this->consejoComunal = $consejoComunal;

        return $this;
    }

    /**
     * Get consejoComunal
     *
     * @return string 
     */
    public function getConsejoComunal()
    {
        return $this->consejoComunal;
    }

    /**
     * Set institucion
     *
     * @param string $institucion
     * @return InscripcionUbicacion
     */
    public function setInstitucion($institucion)
    {
        $this->institucion = $institucion;

        return $this;
    }

    /**
     * Get institucion
     *
     * @return string 
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }

    /**
     * Set organizacionBase
     *
     * @param string $organizacionBase
     * @return InscripcionUbicacion
     */
    public function setOrganizacionBase($organizacionBase)
    {
        $this->organizacionBase = $organizacionBase;

        return $this;
    }

    /**
     * Get organizacionBase
     *
     * @return string 
     */
    public function getOrganizacionBase()
    {
        return $this->organizacionBase;
    }

    /**
     * Set nombreProyecto
     *
     * @param string $nombreProyecto
     * @return InscripcionUbicacion
     */
    public function setNombreProyecto($nombreProyecto)
    {
        $this->nombreProyecto = $nombreProyecto;

        return $this;
    }

    /**
     * Get nombreProyecto
     *
     * @return string 
     */
    public function getNombreProyecto()
    {
        return $this->nombreProyecto;
    }

    /**
     * Set idInscripcion
     *
     * @param \AppBundle\Entity\Inscripcion $idInscripcion
     * @return InscripcionUbicacion
     */
    public function setIdInscripcion(\AppBundle\Entity\Inscripcion $idInscripcion)
    {
        $this->idInscripcion = $idInscripcion;

        return $this;
    }

    /**
     * Get idInscripcion
     *
     * @return \AppBundle\Entity\Inscripcion 
     */
    public function getIdInscripcion()
    {
        return $this->idInscripcion;
    }

    /**
     * Set idSeccionComunidad
     *
     * @param \AppBundle\Entity\SeccionComunidad $idSeccionComunidad
     * @return InscripcionUbicacion
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

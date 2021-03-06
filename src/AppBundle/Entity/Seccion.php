<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seccion
 *
 * @ORM\Table(name="seccion",
 *      uniqueConstraints=
 *          {@ORM\UniqueConstraint(name="uq_seccion_oferta",
 *              columns={"nombre", "id_turno", "oferta_academica_id"})
 *          },
 *          indexes={ 
 *              @ORM\Index(name="fki_turno_oferta_academica",
 *                  columns={"id_turno"}),
 *              @ORM\Index(name="fki_persona_institucion_oferta_academica",
 *                  columns={"id_persona_institucion"}),

 *          }
 *  )
 * @ORM\Entity
 */
class Seccion
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=20, nullable=false, options={"comment" = "nombre de la seccion"})
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="aula", type="string", length=10, nullable=true, options={"comment" = "Indica el aula donde se va a dictar la unidad curricular (EN OBSERVACION, ESTE VALOR PUEDE SER VARIABLE PARA UNA MISMA OFERTA)"})
     */
    private $aula;

    /**
     * @var string
     *
     * @ORM\Column(name="cupo", type="decimal", precision=2, scale=0, nullable=false, options={"comment" = "Indica el numero de cupos para esa oferta"})
     */
    private $cupo;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Inscripcion" , mappedBy="idSeccion" , cascade={"all"})
     * */
    protected $hasInscripcion;


    /**
     * @var \AppBundle\Entity\Turno
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Turno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_turno", referencedColumnName="id", nullable=false)
     * })
     */
    private $idTurno;

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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador de las seccion"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="seccion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OfertaAcademica", inversedBy="seccion")
     * @ORM\JoinColumn(name="oferta_academica_id", referencedColumnName="id")
     */
    private $ofertaAcademica;


    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\SeccionComunidad" , mappedBy="idSeccion" , cascade={"persist"})
     * */
    protected $comunidades;




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hasInscripcion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comunidades = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Seccion
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
     * Set aula
     *
     * @param string $aula
     *
     * @return Seccion
     */
    public function setAula($aula)
    {
        $this->aula = $aula;

        return $this;
    }

    /**
     * Get aula
     *
     * @return string
     */
    public function getAula()
    {
        return $this->aula;
    }

    /**
     * Set cupo
     *
     * @param string $cupo
     *
     * @return Seccion
     */
    public function setCupo($cupo)
    {
        $this->cupo = $cupo;

        return $this;
    }

    /**
     * Get cupo
     *
     * @return string
     */
    public function getCupo()
    {
        return $this->cupo;
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
     * Add hasInscripcion
     *
     * @param \AppBundle\Entity\Inscripcion $hasInscripcion
     *
     * @return Seccion
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

    /**
     * Set idTurno
     *
     * @param \AppBundle\Entity\Turno $idTurno
     *
     * @return Seccion
     */
    public function setIdTurno(\AppBundle\Entity\Turno $idTurno)
    {
        $this->idTurno = $idTurno;

        return $this;
    }

    /**
     * Get idTurno
     *
     * @return \AppBundle\Entity\Turno
     */
    public function getIdTurno()
    {
        return $this->idTurno;
    }

    /**
     * Set idPersonaInstitucion
     *
     * @param \AppBundle\Entity\PersonaInstitucion $idPersonaInstitucion
     *
     * @return Seccion
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
     * Set ofertaAcademica
     *
     * @param \AppBundle\Entity\OfertaAcademica $ofertaAcademica
     *
     * @return Seccion
     */
    public function setOfertaAcademica(\AppBundle\Entity\OfertaAcademica $ofertaAcademica = null)
    {
        $this->ofertaAcademica = $ofertaAcademica;

        return $this;
    }

    /**
     * Get ofertaAcademica
     *
     * @return \AppBundle\Entity\OfertaAcademica
     */
    public function getOfertaAcademica()
    {
        return $this->ofertaAcademica;
    }

    /**
     * Add comunidade
     *
     * @param \AppBundle\Entity\SeccionComunidad $comunidade
     *
     * @return Seccion
     */
    public function addComunidade(\AppBundle\Entity\SeccionComunidad $comunidade)
    {
        $this->comunidades[] = $comunidade;

        return $this;
    }

    /**
     * Remove comunidade
     *
     * @param \AppBundle\Entity\SeccionComunidad $comunidade
     */
    public function removeComunidade(\AppBundle\Entity\SeccionComunidad $comunidade)
    {
        $this->comunidades->removeElement($comunidade);
    }

    /**
     * Get comunidades
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComunidades()
    {
        return $this->comunidades;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getNombre();
    }
}

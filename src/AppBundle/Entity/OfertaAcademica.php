<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfertaAcademica
 *
 * @ORM\Table(name="oferta_academica", uniqueConstraints={@ORM\UniqueConstraint(name="i_oferta_academica", columns={"id_unidad_curricular", "id_seccion", "id_oferta_malla_curricular"})}, indexes={@ORM\Index(name="fki_oferta_malla_curricular_oferta_academica", columns={"id_oferta_malla_curricular"}), @ORM\Index(name="fki_seccion_oferta_academica", columns={"id_seccion"}), @ORM\Index(name="fki_turno_oferta_academica", columns={"id_turno"}), @ORM\Index(name="fki_rol_institucion_oferta_academica", columns={"id_persona_institucion"}), @ORM\Index(name="fki_unidad_curricular_oferta_academica", columns={"id_unidad_curricular"})})
 * @ORM\Entity
 */
class OfertaAcademica
{
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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador de la unidad cirrucular"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="oferta_academica_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\UnidadCurricular
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UnidadCurricular")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_unidad_curricular", referencedColumnName="id", nullable=false)
     * })
     */
    private $idUnidadCurricular;

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
     * @var \AppBundle\Entity\Seccion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Seccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_seccion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idSeccion;

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
     * @var \AppBundle\Entity\OfertaMallaCurricular
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OfertaMallaCurricular")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_oferta_malla_curricular", referencedColumnName="id", nullable=false)
     * })
     */
    private $idOfertaMallaCurricular;



    /**
     * Set aula
     *
     * @param string $aula
     * @return OfertaAcademica
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
     * @return OfertaAcademica
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
     * Set idUnidadCurricular
     *
     * @param \AppBundle\Entity\UnidadCurricular $idUnidadCurricular
     * @return OfertaAcademica
     */
    public function setIdUnidadCurricular(\AppBundle\Entity\UnidadCurricular $idUnidadCurricular = null)
    {
        $this->idUnidadCurricular = $idUnidadCurricular;

        return $this;
    }

    /**
     * Get idUnidadCurricular
     *
     * @return \AppBundle\Entity\UnidadCurricular 
     */
    public function getIdUnidadCurricular()
    {
        return $this->idUnidadCurricular;
    }

    /**
     * Set idTurno
     *
     * @param \AppBundle\Entity\Turno $idTurno
     * @return OfertaAcademica
     */
    public function setIdTurno(\AppBundle\Entity\Turno $idTurno = null)
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
     * Set idSeccion
     *
     * @param \AppBundle\Entity\Seccion $idSeccion
     * @return OfertaAcademica
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
     * Set idOfertaMallaCurricular
     *
     * @param \AppBundle\Entity\OfertaMallaCurricular $idOfertaMallaCurricular
     * @return OfertaAcademica
     */
    public function setIdOfertaMallaCurricular(\AppBundle\Entity\OfertaMallaCurricular $idOfertaMallaCurricular = null)
    {
        $this->idOfertaMallaCurricular = $idOfertaMallaCurricular;

        return $this;
    }

    /**
     * Get idOfertaMallaCurricular
     *
     * @return \AppBundle\Entity\OfertaMallaCurricular 
     */
    public function getIdOfertaMallaCurricular()
    {
        return $this->idOfertaMallaCurricular;
    }

    /**
     * Set idPersonaInstitucion
     *
     * @param \AppBundle\Entity\PersonaInstitucion $idPersonaInstitucion
     * @return OfertaAcademica
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
}

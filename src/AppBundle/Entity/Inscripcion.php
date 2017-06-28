<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscripcion
 *
 * @ORM\Table(name="inscripcion", uniqueConstraints={@ORM\UniqueConstraint(name="i_inscripcion", columns={"id_oferta_academica", "id_persona_institucion"})}, indexes={@ORM\Index(name="oferta_academica_inscripcion", columns={"id_oferta_academica"}), @ORM\Index(name="fki_rol_institucion_inscripcion", columns={"id_persona_institucion"}), @ORM\Index(name="fki_estatus_inscripcion", columns={"id_estatus"})})
 * @ORM\Entity
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
     * @var \AppBundle\Entity\PersonaInstitucion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PersonaInstitucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona_institucion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPersonaInstitucion;

    /**
     * @var \AppBundle\Entity\OfertaAcademica
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OfertaAcademica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_oferta_academica", referencedColumnName="id", nullable=false)
     * })
     */
    private $idOfertaAcademica;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idPersonaInstitucion
     *
     * @param \AppBundle\Entity\PersonaInstitucion $idPersonaInstitucion
     * @return Inscripcion
     */
    public function setIdPersonaInstitucion(\AppBundle\Entity\PersonaInstitucion $idPersonaInstitucion = null)
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
     * Set idOfertaAcademica
     *
     * @param \AppBundle\Entity\OfertaAcademica $idOfertaAcademica
     * @return Inscripcion
     */
    public function setIdOfertaAcademica(\AppBundle\Entity\OfertaAcademica $idOfertaAcademica = null)
    {
        $this->idOfertaAcademica = $idOfertaAcademica;

        return $this;
    }

    /**
     * Get idOfertaAcademica
     *
     * @return \AppBundle\Entity\OfertaAcademica 
     */
    public function getIdOfertaAcademica()
    {
        return $this->idOfertaAcademica;
    }

    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return Inscripcion
     */
    public function setIdEstatus(\AppBundle\Entity\Estatus $idEstatus = null)
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
}

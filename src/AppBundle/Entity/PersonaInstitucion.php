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
 * PersonaInstitucion
 *
 * @ORM\Table(name="persona_institucion", uniqueConstraints={@ORM\UniqueConstraint(name="i_persona_institucion", columns={"id_institucion", "id_persona"})}, indexes={@ORM\Index(name="fki_estatus_persona_institucion", columns={"id_estatus"}), @ORM\Index(name="fki_persona_institucion", columns={"id_persona"}), @ORM\Index(name="IDX_E530B3F2EF433A34", columns={"id_institucion"})})
 * @ORM\Entity
 */
class PersonaInstitucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "identificador de registro rol institucion"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="rol_institucion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona", inversedBy="instituciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPersona;

    /**
     * @var \AppBundle\Entity\Institucion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Institucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_institucion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idInstitucion;

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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Invitation", mappedBy="idPersonaInstitucion", cascade={"remove"})
     */

    private $invitacion;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\EstadoAcademico", mappedBy="idPersonaInstitucion", cascade={"persist", "remove"})
     */

    private $estados_academicos;



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
     * @return PersonaInstitucion
     */
    public function setIdPersona(\AppBundle\Entity\Persona $idPersona = null)
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
     * Set idInstitucion
     *
     * @param \AppBundle\Entity\Institucion $idInstitucion
     * @return RolInstitucion
     */
    public function setIdInstitucion(\AppBundle\Entity\Institucion $idInstitucion = null)
    {
        $this->idInstitucion = $idInstitucion;

        return $this;
    }

    /**
     * Get idInstitucion
     *
     * @return \AppBundle\Entity\Institucion
     */
    public function getIdInstitucion()
    {
        return $this->idInstitucion;
    }

    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return RolInstitucion
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


    /**
     * Get __toString
     * @return string
     *
     */
    public function __toString()
    {
        return $this->getIdPersona()->getPrimerNombre() .  ", " . $this->getIdPersona()->getPrimerApellido();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->invitacion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estados_academicos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add invitacion
     *
     * @param \AppBundle\Entity\Invitation $invitacion
     * @return PersonaInstitucion
     */
    public function addInvitacion(\AppBundle\Entity\Invitation $invitacion)
    {
        $this->invitacion[] = $invitacion;

        return $this;
    }

    /**
     * Remove invitacion
     *
     * @param \AppBundle\Entity\Invitation $invitacion
     */
    public function removeInvitacion(\AppBundle\Entity\Invitation $invitacion)
    {
        $this->invitacion->removeElement($invitacion);
    }

    /**
     * Get invitacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvitacion()
    {
        return $this->invitacion;
    }

    /**
     * Add estados_academicos
     *
     * @param \AppBundle\Entity\EstadoAcademico $estadosAcademicos
     * @return PersonaInstitucion
     */
    public function addEstadosAcademico(\AppBundle\Entity\EstadoAcademico $estadosAcademicos)
    {
        $this->estados_academicos[] = $estadosAcademicos;

        return $this;
    }

    /**
     * Remove estados_academicos
     *
     * @param \AppBundle\Entity\EstadoAcademico $estadosAcademicos
     */
    public function removeEstadosAcademico(\AppBundle\Entity\EstadoAcademico $estadosAcademicos)
    {
        $this->estados_academicos->removeElement($estadosAcademicos);
    }

    /**
     * Get estados_academicos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstadosAcademicos()
    {
        return $this->estados_academicos;
    }
}

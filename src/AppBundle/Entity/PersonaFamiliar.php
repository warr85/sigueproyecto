<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonaFamiliar
 *
 * @ORM\Table(name="persona_familiar", uniqueConstraints={@ORM\UniqueConstraint(name="i_familiar", columns={"id_grupo_familiar", "jefe_familiar"}), @ORM\UniqueConstraint(name="uq_persona_familiar_id_persona", columns={"id_persona"})}, indexes={@ORM\Index(name="IDX_8A34CA5EFFBF489D", columns={"id_grupo_familiar"}), @ORM\Index(name="IDX_PARENTESCO", columns={"id_parentesco"})})
 * @ORM\Entity
 */
class PersonaFamiliar
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="jefe_familiar", type="boolean", nullable=false, options={"comment" = "Indica si la persona es Jefe de Familia"})
     */
    private $jefeFamiliar;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del registro"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="familiar_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPersona;

    /**
     * @var \AppBundle\Entity\Parentesco
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Parentesco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parentesco", referencedColumnName="id", nullable=false)
     * })
     */
    private $idParentesco;

    /**
     * @var \AppBundle\Entity\GrupoFamiliar
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\GrupoFamiliar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_familiar", referencedColumnName="id", nullable=false)
     * })
     */
    private $idGrupoFamiliar;



 /**
     * @var \AppBundle\Entity\NivelInstruccion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\NivelInstruccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_nivel_instruccion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idNivelInstruccion;







    /**
     * Set jefeFamiliar
     *
     * @param boolean $jefeFamiliar
     * @return PersonaFamiliar
     */
    public function setJefeFamiliar($jefeFamiliar)
    {
        $this->jefeFamiliar = $jefeFamiliar;

        return $this;
    }

    /**
     * Get jefeFamiliar
     *
     * @return boolean 
     */
    public function getJefeFamiliar()
    {
        return $this->jefeFamiliar;
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
     * Set idPersona
     *
     * @param \AppBundle\Entity\Persona $idPersona
     * @return PersonaFamiliar
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
     * Set idParentesco
     *
     * @param \AppBundle\Entity\Parentesco $idParentesco
     * @return PersonaFamiliar
     */
    public function setIdParentesco(\AppBundle\Entity\Parentesco $idParentesco)
    {
        $this->idParentesco = $idParentesco;

        return $this;
    }

    /**
     * Get idParentesco
     *
     * @return \AppBundle\Entity\Parentesco 
     */
    public function getIdParentesco()
    {
        return $this->idParentesco;
    }

    /**
     * Set idGrupoFamiliar
     *
     * @param \AppBundle\Entity\GrupoFamiliar $idGrupoFamiliar
     * @return PersonaFamiliar
     */
    public function setIdGrupoFamiliar(\AppBundle\Entity\GrupoFamiliar $idGrupoFamiliar)
    {
        $this->idGrupoFamiliar = $idGrupoFamiliar;

        return $this;
    }

    /**
     * Get idGrupoFamiliar
     *
     * @return \AppBundle\Entity\GrupoFamiliar 
     */
    public function getIdGrupoFamiliar()
    {
        return $this->idGrupoFamiliar;
    }

    /**
     * Set idNivelInstruccion
     *
     * @param \AppBundle\Entity\NivelInstruccion $idNivelInstruccion
     * @return PersonaFamiliar
     */
    public function setIdNivelInstruccion(\AppBundle\Entity\NivelInstruccion $idNivelInstruccion)
    {
        $this->idNivelInstruccion = $idNivelInstruccion;

        return $this;
    }

    /**
     * Get idNivelInstruccion
     *
     * @return \AppBundle\Entity\NivelInstruccion 
     */
    public function getIdNivelInstruccion()
    {
        return $this->idNivelInstruccion;
    }
}

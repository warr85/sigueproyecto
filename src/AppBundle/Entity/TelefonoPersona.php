<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TelefonoPersona
 *
 * @ORM\Table(name="telefono_persona", uniqueConstraints={@ORM\UniqueConstraint(name="telefono_persona_numero_key", columns={"numero", "id_persona"}), @ORM\UniqueConstraint(name="i_telefono_persona", columns={"id_persona", "numero"})}, indexes={@ORM\Index(name="fki_codigo_area_telefono_persona", columns={"id_codigo_area"}), @ORM\Index(name="IDX_2B9961C58F781FEB", columns={"id_persona"})})
 * @ORM\Entity
 */
class TelefonoPersona
{
    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="decimal", precision=15, scale=0, nullable=false, options={"comment" = "Numero telefonico"})
     */
    private $numero;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable = false, options={"comment" = "Identificador de numero telefonico"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="telefono_persona_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona", inversedBy="telefonos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPersona;

    /**
     * @var \AppBundle\Entity\CodigoArea
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CodigoArea")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_codigo_area", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCodigoArea;



    /**
     * Set numero
     *
     * @param string $numero
     * @return TelefonoPersona
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
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
     * @return TelefonoPersona
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
     * Set idCodigoArea
     *
     * @param \AppBundle\Entity\CodigoArea $idCodigoArea
     * @return TelefonoPersona
     */
    public function setIdCodigoArea(\AppBundle\Entity\CodigoArea $idCodigoArea = null)
    {
        $this->idCodigoArea = $idCodigoArea;

        return $this;
    }

    /**
     * Get idCodigoArea
     *
     * @return \AppBundle\Entity\CodigoArea 
     */
    public function getIdCodigoArea()
    {
        return $this->idCodigoArea;
    }
}

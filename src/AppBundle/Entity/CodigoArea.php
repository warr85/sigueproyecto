<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CodigoArea
 *
 * @ORM\Table(name="codigo_area", uniqueConstraints={@ORM\UniqueConstraint(name="uq_codigo_area", columns={"nombre"})}, indexes={@ORM\Index(name="fki_tipo_telefono_codigo_area", columns={"id_tipo_telefono"})})
 * @ORM\Entity
 */
class CodigoArea
{
    /**
     * @var integer
     *
     * @ORM\Column(name="nombre", type="integer", nullable=false, options={"comment" = "Nombre del Codigo de area (Numero)"})
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador de codigo de area"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="codigo_area_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\TipoTelefono
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TipoTelefono")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_telefono", referencedColumnName="id", nullable=false)
     * })
     */
    private $idTipoTelefono;



    /**
     * Set nombre
     *
     * @param integer $nombre
     * @return CodigoArea
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return integer 
     */
    public function getNombre()
    {
        return $this->nombre;
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
     * Set idTipoTelefono
     *
     * @param \AppBundle\Entity\TipoTelefono $idTipoTelefono
     * @return CodigoArea
     */
    public function setIdTipoTelefono(\AppBundle\Entity\TipoTelefono $idTipoTelefono = null)
    {
        $this->idTipoTelefono = $idTipoTelefono;

        return $this;
    }

    /**
     * Get idTipoTelefono
     *
     * @return \AppBundle\Entity\TipoTelefono 
     */
    public function getIdTipoTelefono()
    {
        return $this->idTipoTelefono;
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

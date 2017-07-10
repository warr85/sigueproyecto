<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoTelefono
 *
 * @ORM\Table(name="tipo_telefono", uniqueConstraints={@ORM\UniqueConstraint(name="uq_tipo_telefono", columns={"nombre"})})
 * @ORM\Entity
 */
class TipoTelefono
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=20, nullable=false, options={"comment" = "Nombre del tipo de telefono"})
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer" , nullable=false, options={"comment" = "identificador de tipo de telefono"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="tipo_telefono_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return TipoTelefono
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}

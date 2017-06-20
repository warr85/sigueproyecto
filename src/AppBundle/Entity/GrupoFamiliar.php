<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrupoFamiliar
 *
 * @ORM\Table(name="grupo_familiar", uniqueConstraints={@ORM\UniqueConstraint(name="uq_nombre_grupo_familiar", columns={"nombre"})})
 * @ORM\Entity
 */
class GrupoFamiliar
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", nullable=true, options={"comment" = "Nombre que describe al grupo familiar"})
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del grupo familiar"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="grupo_familiar_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return GrupoFamiliar
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

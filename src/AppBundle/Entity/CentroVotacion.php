<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 29/06/16
 * Time: 08:45 AM
 */


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CentroVotacion
 *
 * @ORM\Table(name="centro_votacion", uniqueConstraints={@ORM\UniqueConstraint(name="uq_centro_votacion_id_parroquia", columns={"id_parroquia"})}, indexes={@ORM\Index(name="fki_centro_votacion_parroquia", columns={"id_parroquia"})})
 * @ORM\Entity
 */
class CentroVotacion
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false, options={"comment" = "Nombre del centro de votación"})
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="text", nullable=false, options={"comment" = "direccion del centro de votacion"})
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="integer", nullable=false, options={"comment" = "Codigo del centro de votacion "})
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador de la tabla"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="municipio_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Parroquia
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Parroquia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parroquia", referencedColumnName="id", nullable=false)
     * })
     */
    private $idParroquia;


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CentroVotacion
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
     * Set codigo
     *
     * @param string $codigo
     * @return CentroVotacion
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
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
     * Set idParroquia
     *
     * @param \AppBundle\Entity\Parroquia $idParroquia
     * @return CentroVotacion
     */
    public function setIdParroquia(\AppBundle\Entity\Parroquia $idParroquia)
    {
        $this->idParroquia = $idParroquia;

        return $this;
    }

    /**
     * Get idParroquia
     *
     * @return \AppBundle\Entity\Parroquia 
     */
    public function getIdParroquia()
    {
        return $this->idParroquia;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return CentroVotacion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
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

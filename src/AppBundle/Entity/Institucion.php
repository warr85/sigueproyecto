<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 29/06/16
 * Time: 08:40 AM
 */


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Institucion
 *
 * @ORM\Table(name="institucion", indexes={@ORM\Index(name="fki_institucion_tipo_institucion", columns={"id_tipo_institucion"}), @ORM\Index(name="eje_parroquia_institucion", columns={"id_eje_parroquia"})})
 * @ORM\Entity
 */
class Institucion
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=false, options={"comment" = "Nombre de la institucion.Debe ser unico, las instituciones que compartan y/o alternen el mismo espacio fisico deben diferenciarse por su nombre. Ej: Alde-Bolivar-Dia, Alde-Bolivar-Noche"})
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="text", nullable=false, options={"comment" = "Direccion de ubicacion fisica de la institucion"})
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="latitud", type="string", length=12, nullable=true, options={"comment" = "Coordenada geografica en latitud, ángulo entre cualquier punto del planeta tierra y el ecuador"})
     */
    private $latitud;

    /**
     * @var string
     *
     * @ORM\Column(name="longitud", type="string", length=12, nullable=true, options={"comment" = "Coordenada geografica en longitud, ángulo a lo largo del ecuador desde cualquier punto de la Tierra"})
     */
    private $longitud;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="decimal", precision=12, scale=0, nullable=true,options={"comment" = "Numero de telefono de la institucion"})
     */
    private $telefono;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_aldea_sucre", type="integer", nullable=true)
     */
    private $idAldeaSucre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador de la institucion"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="institucion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\TipoInstitucion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TipoInstitucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_institucion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idTipoInstitucion;

    /**
     * @var \AppBundle\Entity\EjeParroquia
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EjeParroquia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_eje_parroquia", referencedColumnName="id", nullable=false)
     * })
     */
    private $idEjeParroquia;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Institucion
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
     * Set direccion
     *
     * @param string $direccion
     * @return Institucion
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
     * Set latitud
     *
     * @param string $latitud
     * @return Institucion
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;

        return $this;
    }

    /**
     * Get latitud
     *
     * @return string
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param string $longitud
     * @return Institucion
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * Get longitud
     *
     * @return string
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Institucion
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set idAldeaSucre
     *
     * @param integer $idAldeaSucre
     * @return Institucion
     */
    public function setIdAldeaSucre($idAldeaSucre)
    {
        $this->idAldeaSucre = $idAldeaSucre;

        return $this;
    }

    /**
     * Get idAldeaSucre
     *
     * @return integer
     */
    public function getIdAldeaSucre()
    {
        return $this->idAldeaSucre;
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
     * Set idTipoInstitucion
     *
     * @param \AppBundle\Entity\TipoInstitucion $idTipoInstitucion
     * @return Institucion
     */
    public function setIdTipoInstitucion(\AppBundle\Entity\TipoInstitucion $idTipoInstitucion = null)
    {
        $this->idTipoInstitucion = $idTipoInstitucion;

        return $this;
    }

    /**
     * Get idTipoInstitucion
     *
     * @return \AppBundle\Entity\TipoInstitucion
     */
    public function getIdTipoInstitucion()
    {
        return $this->idTipoInstitucion;
    }

    /**
     * Set idEjeParroquia
     *
     * @param \AppBundle\Entity\EjeParroquia $idEjeParroquia
     * @return Institucion
     */
    public function setIdEjeParroquia(\AppBundle\Entity\EjeParroquia $idEjeParroquia = null)
    {
        $this->idEjeParroquia = $idEjeParroquia;

        return $this;
    }

    /**
     * Get idEjeParroquia
     *
     * @return \AppBundle\Entity\EjeParroquia
     */
    public function getIdEjeParroquia()
    {
        return $this->idEjeParroquia;
    }



    public function __toString(){
        return $this->getNombre() . " " . $this->getIdEjeParroquia()->getIdEje()->getNombre();
    }


}
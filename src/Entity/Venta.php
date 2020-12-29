<?php

namespace App\Entity;

use App\Repository\VentaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VentaRepository::class)
 */
class Venta
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity=Empresa::class, inversedBy="ventas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $empresa;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCliente(): ?string
    {
        return $this->cliente;
    }

    public function setCliente(string $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getEmpresa(): ?Empresa
    {
        return $this->empresa;
    }

    public function setEmpresa(?Empresa $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }
}

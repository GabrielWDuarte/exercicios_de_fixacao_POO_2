<?php

// Classe base Veiculo
abstract class Veiculo {
    protected string $modelo;
    protected int $capacidade;

    public function __construct(string $modelo, int $capacidade) {
        $this->modelo = $modelo;
        $this->capacidade = $capacidade;
    }

    // Metodo abstrato para calcular consumo, cada tipo de veiculo implementa o seu
    abstract public function calcularConsumo(float $distancia, int $passageiros = 1): float;
}

// Classe Onibus, consumo fixo por km
class Onibus extends Veiculo {
    private float $consumoPorKm;

    public function __construct(string $modelo, int $capacidade, float $consumoPorKm) {
        parent::__construct($modelo, $capacidade);
        $this->consumoPorKm = $consumoPorKm;
    }

    public function calcularConsumo(float $distancia, int $passageiros = 1): float {
        return $this->consumoPorKm * $distancia;
    }
}

// Classe Taxi, consumo depende do numero de passageiros e distancia
class Taxi extends Veiculo {
    private float $taxaPorPassageiro;

    public function __construct(string $modelo, int $capacidade, float $taxaPorPassageiro) {
        parent::__construct($modelo, $capacidade);
        $this->taxaPorPassageiro = $taxaPorPassageiro;
    }

    public function calcularConsumo(float $distancia, int $passageiros = 1): float {
        return $distancia * $passageiros * $this->taxaPorPassageiro;
    }
}

// Testando os veiculos
$onibus = new Onibus("Mercedes-Benz", 50, 2.5);
$taxi = new Taxi("Toyota Corolla", 4, 0.8);

echo "Consumo do Onibus para 100km: " . $onibus->calcularConsumo(100) . " L\n";
echo "Consumo do Taxi para 50km com 3 passageiros: " . $taxi->calcularConsumo(50, 3) . " L\n";

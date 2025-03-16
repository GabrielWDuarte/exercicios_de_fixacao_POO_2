<?php

// Classe base Funcionario
abstract class Funcionario {
    protected string $nome;
    protected float $salario;
    protected string $cargo;

    public function __construct(string $nome, float $salario, string $cargo) {
        $this->nome = $nome;
        $this->salario = $salario;
        $this->cargo = $cargo;
    }

    // Metodo abstrato para calcular vencimentos
    abstract public function calcularVencimentos(): float;

    // Metodo para exibir informacoes do funcionario
    public function exibirInfo() {
        echo "Nome: {$this->nome}\n";
        echo "Cargo: {$this->cargo}\n";
        echo "Salario: R$ " . number_format($this->salario, 2, ',', '.') . "\n";
        echo "Vencimentos: R$ " . number_format($this->calcularVencimentos(), 2, ',', '.') . "\n";
    }
}

// Classe FuncionarioEfetivo
class FuncionarioEfetivo extends Funcionario {
    private float $bonusAnual;

    public function __construct(string $nome, float $salario, string $cargo, float $bonusAnual) {
        parent::__construct($nome, $salario, $cargo);
        $this->bonusAnual = $bonusAnual;
    }

    public function calcularVencimentos(): float {
        return $this->salario + ($this->bonusAnual / 12); // Divide o bonus pelos meses do ano
    }
}

// Classe FuncionarioTerceirizado
class FuncionarioTerceirizado extends Funcionario {
    private float $custoPorProjeto;

    public function __construct(string $nome, float $salario, string $cargo, float $custoPorProjeto) {
        parent::__construct($nome, $salario, $cargo);
        $this->custoPorProjeto = $custoPorProjeto;
    }

    public function calcularVencimentos(): float {
        return $this->salario + $this->custoPorProjeto; // Adiciona o custo do projeto ao salario
    }
}

// Exemplo de uso:
$func1 = new FuncionarioEfetivo("Carlos Silva", 5000, "Engenheiro", 12000);
$func2 = new FuncionarioTerceirizado("Ana Souza", 4000, "Analista", 1500);

echo "Funcionario Efetivo:\n";
$func1->exibirInfo();

echo "\nFuncionario Terceirizado:\n";
$func2->exibirInfo();

<?php

// Classe base ContaBancaria
abstract class ContaBancaria {
    protected string $numero;
    protected float $saldo;

    public function __construct(string $numero, float $saldo = 0) {
        $this->numero = $numero;
        $this->saldo = $saldo;
    }

    public function depositar(float $valor): void {
        if ($valor > 0) {
            $this->saldo += $valor;
            echo "Deposito de R$ " . number_format($valor, 2, ',', '.') . " realizado com sucesso!\n";
        } else {
            echo "Valor invalido para deposito.\n";
        }
    }

    abstract public function sacar(float $valor): bool;

    public function getSaldo(): float {
        return $this->saldo;
    }
}

// Classe ContaCorrente
class ContaCorrente extends ContaBancaria {
    private float $limiteChequeEspecial;

    public function __construct(string $numero, float $saldo, float $limiteChequeEspecial) {
        parent::__construct($numero, $saldo);
        $this->limiteChequeEspecial = $limiteChequeEspecial;
    }

    public function sacar(float $valor): bool {
        if ($valor > 0 && ($this->saldo + $this->limiteChequeEspecial) >= $valor) {
            $this->saldo -= $valor;
            echo "Saque de R$ " . number_format($valor, 2, ',', '.') . " realizado com sucesso!\n";
            return true;
        } else {
            echo "Saldo insuficiente.\n";
            return false;
        }
    }
}

// Classe ContaPoupanca
class ContaPoupanca extends ContaBancaria {
    private float $taxaJuros;

    public function __construct(string $numero, float $saldo, float $taxaJuros) {
        parent::__construct($numero, $saldo);
        $this->taxaJuros = $taxaJuros;
    }

    public function sacar(float $valor): bool {
        if ($valor > 0 && $this->saldo >= $valor) {
            $this->saldo -= $valor;
            echo "Saque de R$ " . number_format($valor, 2, ',', '.') . " realizado com sucesso!\n";
            return true;
        } else {
            echo "Saldo insuficiente.\n";
            return false;
        }
    }

    public function aplicarJuros(): void {
        $juros = $this->saldo * $this->taxaJuros / 100;
        $this->saldo += $juros;
        echo "Juros de R$ " . number_format($juros, 2, ',', '.') . " aplicados.\n";
    }
}

// Testes
$contaCorrente = new ContaCorrente("12345", 1000, 500);
$contaPoupanca = new ContaPoupanca("67890", 2000, 1.5);

echo "Saldo Conta Corrente: R$ " . number_format($contaCorrente->getSaldo(), 2, ',', '.') . "\n";
$contaCorrente->sacar(1200);
echo "Saldo apos saque: R$ " . number_format($contaCorrente->getSaldo(), 2, ',', '.') . "\n\n";

echo "Saldo Conta Poupanca: R$ " . number_format($contaPoupanca->getSaldo(), 2, ',', '.') . "\n";
$contaPoupanca->aplicarJuros();
echo "Saldo apos juros: R$ " . number_format($contaPoupanca->getSaldo(), 2, ',', '.') . "\n";

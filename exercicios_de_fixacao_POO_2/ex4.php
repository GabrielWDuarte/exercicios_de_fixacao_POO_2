<?php

// Classe Item (representa um item do pedido)
class Item {
    public string $nome;
    public float $preco;

    public function __construct(string $nome, float $preco) {
        $this->nome = $nome;
        $this->preco = $preco;
    }
}

// Classe Pedido (classe base para pedidos)
class Pedido {
    protected int $numero;
    protected array $itens = [];

    public function __construct(int $numero) {
        $this->numero = $numero;
    }

    public function adicionarItem(Item $item): void {
        $this->itens[] = $item;
        echo "Item '{$item->nome}' adicionado ao pedido.\n";
    }

    public function calcularTotal(): float {
        $total = 0;
        foreach ($this->itens as $item) {
            $total += $item->preco;
        }
        return $total;
    }
}

// Classe PedidoDelivery (extende Pedido e adiciona taxa de entrega)
class PedidoDelivery extends Pedido {
    private float $taxaEntrega;

    public function __construct(int $numero, float $taxaEntrega) {
        parent::__construct($numero);
        $this->taxaEntrega = $taxaEntrega;
    }

    public function calcularTotal(): float {
        return parent::calcularTotal() + $this->taxaEntrega;
    }
}

// Testando o sistema
$item1 = new Item("Hamburguer", 15.00);
$item2 = new Item("Refrigerante", 5.00);

$pedido1 = new Pedido(101);
$pedido1->adicionarItem($item1);
$pedido1->adicionarItem($item2);
echo "Total do Pedido Presencial: R$ " . number_format($pedido1->calcularTotal(), 2, ',', '.') . "\n\n";

$pedido2 = new PedidoDelivery(202, 8.00);
$pedido2->adicionarItem($item1);
$pedido2->adicionarItem($item2);
echo "Total do Pedido Delivery (com taxa de entrega): R$ " . number_format($pedido2->calcularTotal(), 2, ',', '.') . "\n";

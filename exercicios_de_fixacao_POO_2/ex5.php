<?php

// Classe base Publicacao
abstract class Publicacao {
    protected string $titulo;
    protected string $autor;
    protected string $descricao;

    public function __construct(string $titulo, string $autor, string $descricao) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->descricao = $descricao;
    }

    // Metodo abstrato que sera implementado nas subclasses
    abstract public function exibirResumo(): string;
}

// Classe Artigo, que extende Publicacao
class Artigo extends Publicacao {
    private int $numeroDePalavras;

    public function __construct(string $titulo, string $autor, string $descricao, int $numeroDePalavras) {
        parent::__construct($titulo, $autor, $descricao);
        $this->numeroDePalavras = $numeroDePalavras;
    }

    public function exibirResumo(): string {
        return "Artigo: '{$this->titulo}' por {$this->autor}. Palavras: {$this->numeroDePalavras}. {$this->descricao}";
    }
}

// Classe Video, que extende Publicacao
class Video extends Publicacao {
    private float $duracao;

    public function __construct(string $titulo, string $autor, string $descricao, float $duracao) {
        parent::__construct($titulo, $autor, $descricao);
        $this->duracao = $duracao;
    }

    public function exibirResumo(): string {
        return "Video: '{$this->titulo}' por {$this->autor}. Duracao: {$this->duracao} minutos. {$this->descricao}";
    }
}

// Testando o sistema
$artigo = new Artigo("PHP para Iniciantes", "João Silva", "Um guia completo sobre PHP.", 1200);
$video = new Video("Introdução ao Laravel", "Maria Souza", "Explicação sobre os conceitos básicos do Laravel.", 15.5);

echo $artigo->exibirResumo() . "\n";
echo $video->exibirResumo() . "\n";

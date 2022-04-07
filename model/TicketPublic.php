<?php namespace model;
/**
 * @desc ticket container attributes, setters and getters
 * @see Ticket for the rest of the class
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.5
 */
class TicketPublic extends \model\Transport {

    protected int $id;

    protected string $title;
    protected string $description;
    protected string $color;
    protected string $keywords;
    protected string $body;
    protected $jour;//datetime

    protected int $prix;
    protected int $diff;
    protected int $temps;
    protected int $personne;
    protected int $hide;
    protected int $cuisinier;
    protected int $love;//l'amour n'est pas à la base de données

    public function setId(int $id): void { $this->id = $id; }
    public function setTitle(string $title): void { $this->title = $title; }
    public function setDescription(string $desc): void { $this->description = $desc; }
    public function setColor(string $color): void { $this->color = $color; }
    public function setKeywords(string $kw): void { $this->keywords = $kw; }
    public function setBody(string $body): void { $this->body = $body; }
    public function setJour($jour): void { $this->jour = $jour; }
    public function setPrix(int $prix): void { $this->prix = $prix; }
    public function setDiff(int $diff): void { $this->diff = $diff; }
    public function setTemps(int $temps): void { $this->temps = $temps; }
    public function setPersonne(int $per): void { $this->personne = $per; }
    public function setHide(int $hide): void { $this->hide = $hide; }
    public function setCuisinier(int $cuisinier): void { $this->cuisinier = $cuisinier; }
    public function setLove(int $love): void { $this->love = $love; }

    public function getId():int { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function getDescription(): string { return $this->description; }
    public function getColor() { return $this->color; }
    public function getKeywords(): string { return $this->keywords; }
    public function getBody(): string { return $this->body; }
    public function getJour() { return $this->jour; }
    public function getPrix(): int { return $this->prix; }
    public function getDiff(): int { return $this->diff; }
    public function getTemps(): int { return $this->temps; }
    public function getPersonne(): int { return $this->personne; }
    public function getHide(): int { return $this->hide; }
    public function getCuisinier(): int { return $this->cuisinier; }
    public function getLove(): int { return $this->love; }
} ?>


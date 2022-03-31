<?php namespace model;
/**
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @desc ticket container
 * @version 0.0.3
 */
class TicketPublic {

    private $id;

    private $title;
    private $description;
    private $color;
    private $keywords;
    private $body;
    private $jour;//datetime

    private int $prix;
    private int $diff;
    private int $temps;
    private int $personne;
    private int $hide;
    private int $love;//l'amour n'est pas à la base de données

    public function setId($id): void { if (is_int(intval($id))) $this->id = $id; }
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
    public function setLove(int $love): void { $this->love = $love; }

    public function getId() { return $this->id; }
    public function getTitle(): ?string { return $this->title; }
    public function getDescription(): ?string { return $this->description; }
    public function getColor(): ?string { return $this->color; }
    public function getKeywords(): ?string { return $this->keywords; }
    public function getBody(): ?string { return $this->body; }
    public function getJour() { return $this->jour; }
    public function getPrix(): ?int { return $this->prix; }
    public function getDiff(): ?int { return $this->diff; }
    public function getTemps(): ?int { return $this->temps; }
    public function getPersonne(): ?int { return $this->personne; }
    public function getHide(): ?int { return $this->hide; }
    public function getLove(): ?int { return $this->love; }
} ?>


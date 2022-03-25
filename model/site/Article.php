<?php namespace model\site;
class Article {/* conception
	et description*/
	private $id;
	private $titre;
	private $article;

	public function getId() {return $this->id; }
	public function getTitre() {return $this->titre; }
	public function getArticle() {return $this->article; }

	public function setId($id) { if ($id > 0) $this->id = $id; }
	public function setTitre($titre) { if (is_string($titre)) $this->titre = $titre; }
	public function setArticle($article) { if (is_string($article)) $this->article = $article; }
} ?>

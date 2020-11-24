<?php
namespace starproject\database\story;

class Articles
{
    public $id;
    public $Articles = [
            'Allwin'=>['description'=>'Vysvětluje počátek světa, ve kterém se příběh odehrává','img'=>'','Allwin','url'=>'/show/allwin/1'],
            'Samuel'=>['description'=>'Začátek hlavního příběhu','img'=>'','Samuel','url'=>'/show/samuel/1'],
            'Isama'=>['description'=>'Navazuje na příběh Samuela','img'=>'','Isama','url'=>'/show/isama/1'],
            'Isamanh'=>['description'=>'Pokračování Isamova příběhu','img'=>'','Isama nový Horizot','url'=>'/show/isamanh/1'],
            'Isamanw'=>['description'=>'Konec Isamova příběhu','img'=>'','Isama nový Svět','url'=>'/show/isamanw/1'],
            'Aeg'=>['description'=>'Příběh má spojitost s příběhem Allwina','img'=>'','Angel & Eklips','url'=>'/show/angel/1'],
            'Mry'=>['description'=>'Vysvětluje původ Mr. ?','img'=>'', 'Mr. Y','url'=>'/show/mry/1'],
            'Star'=>['description'=>'Příběh popisuje minolost Whita Stara','img'=>'','Star','url'=>'/show/star/1'],
            'Hyperion'=>['description'=>'Historie Nového světa','img'=>'','Hyperion','url'=>'/show/hyperion/1'],
            'Terror'=>['description'=>'Důležitá postava v Novém světě','img'=>'','url'=>'/show/terror/1','Terror'],
            'Demoni'=>['description'=>'Příběh vysvětlující rasu Démonů','img'=>'','Demoni','url'=>'/show/demoni/1']
    ]; 
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticles(): ?array
    {
        return $this->Articles;
    }

    public function setArticles(?array $Articles): self
    {
        $this->Articles = $Articles;

        return $this;
    }
}
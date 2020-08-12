<?php

require_once('conn.php');
session_start();

class Klient {

    private $date = null;
    private $wyszuk='';
    function __construct($a) {
        $this->date = $a;
    }

    public function getLibrary($f=false) {
        $sql = 'SELECT id_kl, imiona, nazwiska, miasta.miasto, ulice, kod_pocztowy, numer_domu FROM klient INNER JOIN imie ON klient.imie=imie.id_g';
        $sql .= ' INNER JOIN nawizska on klient.nazwisko=nawizska.Id_n INNER JOIN miasta ON klient.miasto=miasta.Id_m INNER JOIN ulice ON klient.ulica=ulice.Id_ul';
        $cr = $this->date->prepare($sql.$this->wyszuk);
        $cr->execute();
        $row=$cr->fetchAll();
       if($f){
           $row1=Array();
           $iter=0;
        foreach($row as $rows){
         $row1['imie'][$iter]=$rows['imiona'];
         $row1['nazwisko'][$iter]=$rows['nazwiska'];
         $row1['miasto'][$iter]=$rows['miasto'];
         $row1['ulica'][$iter]=$rows['ulice'];
         $row1['kod'][$iter]=$rows['kod_pocztowy'];
         $row1['nr'][$iter]=$rows['numer_domu'];
         $row1['id'][$iter]=$rows['id_kl'];
          $iter++;
        }
       }else return $row;
    }
    
    public function wyszukiwanie($key,$value){
        switch($key){
            case 'imie':{ 
                $this->wyszuk=' WHERE imie.imiona="'.$value.'"';                    
            break;}
            case 'nazwisko':{ 
                $this->wyszuk=' WHERE nawizska.nazwiska="'.$value.'"';                    
            break;}
            case 'miasto':{ 
                $this->wyszuk=' WHERE miasta.Miasto="'.$value.'"';                    
            break;}
            case 'ulice':{ 
                $this->wyszuk=' WHERE ulice.ulice="'.$value.'"';                    
            break;}
        }
        
    }

    public function updateKlient($imie,$nazwisko,$miasto,$ulica,$kod,$nr,$id) {
        $first=true;
        $sql='UPDATE klient SET '; 
        if($this->validate('imie',$imie))
                {$sql.='imie='.$imie; $first=false;}
        if($this->validate('nazwisko',$nazwisko)) 
                {if(!$first) $sql.=','; $sql.='nazwisko='.$nazwisko; $first=false;}
        if($this->validate('miasto',$miasto)) 
                {if(!$first)$sql.=','; $sql.=' miasto='.$miasto; $first=false;}
        if($this->validate('ulica',$ulica)) 
                {if(!$first)$sql.=','; $sql.=' ulica='.$ulica; $first=false;}
        if($this->validate('kod',$kod)) 
                {if(!$first)$sql.=','; $sql.=' kod_pocztowy="'.$kod.'"'; $first=false;}
        if($this->validate('numer',$nr))
                {if(!$first)$sql.=','; $sql.=' numer_domu="'.$nr.'"'; $first=false;}
        $sql.=' where id_kl='.$id;
       $upd=$this->date->prepare($sql);
       $upd->execute();
       
    }
    
    public function createClient($imie,$nazwisko,$miasto,$ulica,$kod,$numer){
        $sql='INSERT INTO klient VALUES(NULL,"'.$imie.'","'.$nazwisko.'","'.$miasto.'","'.$ulica.'","'.$kod.'","'.$numer.'")';
        if($this->validate('imie',$imie) && $this->validate('nazwisko',$nazwisko) && $this->validate('miasto',$miasto)  && $this->validate('ulica',$ulica) 
          && $this->validate('kod',$kod) && $this->validate('numer',$numer))
       $quer=$this->date->prepare($sql);
       $squer->execute();
        
        
    }

    protected function validate($key,$value){
        switch($key){
            case 'imie':{
                if(!is_numeric($value)) $value=(int)$value;
                if($value>0) return true;
            break;}
            case 'nazwisko':{
                if(!is_numeric($value)) $value=(int)$value;
                if($value>0) return true;
            break;}
            case 'miasto':{
                if(!is_numeric($value)) $value=(int)$value;
                if($value>0) return true;
            break;}
            case 'ulica':{
                if(!is_numeric($value)) $value=(int)$value;
                if($value>0) return true;
            break;}
            case 'kod':{
                if(strlen($value)==6 && $value[2]=="-") return true;
            break;}
            case 'numer':{
            if(strlen($value)>0) return true;
            }
            default: return false;
        }
    return false;
        
    }
    
    
};


class Movie {

    private $date = null;
    private $sql_conditions;
    private $order='filmy.id ';
    private $limit='';
    private $search='';
    function __construct($a) {
        $this->date = $a;
    }

    public function getLibrary() {
        $sql = 'SELECT id, tytul, imie.imiona, nawizska.nazwiska, rok_produkcji,opis ,gatunek.gatunek, nosnik.nosnik, cena, kara, plakat.url,avg(ocena) as ocena FROM filmy';
        $sql .= ' INNER JOIN oceny ON oceny.id_f=filmy.id INNER JOIN rezyser ON filmy.rezyser=rezyser.Id_r INNER JOIN imie on rezyser.id_i=imie.Id_g INNER JOIN nawizska ON rezyser.id_n=nawizska.Id_n ';
        $sql .= 'INNER JOIN gatunek ON filmy.gatunek=gatunek.Id_g INNER JOIN plakat on filmy.plakat=plakat.id_p INNER JOIN nosnik on filmy.nosnik=nosnik.Id_n where rezyser.Id_r=filmy.rezyser  GROUP BY oceny.id_f';
        $sql=$sql.$this->search.$this->sql_conditions.' ORDER BY '.$this->order.$this->limit;
        $cr = $this->date->prepare($sql);
        $cr->execute();
        $row=$cr->fetchAll();
        return $row;
    }
    
   
    
    public function wyszukiwanie($key,$value){
         
        switch($key){
            case 'nosnik':{
               $this->search.=' ABD nosnik.nosnik like "%'.$value.'%"';
            break;}
            case 'tytul':{
               $this->search.=' AND filmy.tytul like "%'.$value.'%"';
            break;}
            case 'rezyser':{
                $value=explode(' ',$value);
               $this->search.=' And imie.imiona like "%'.$value[0].'%" AND nawizska.nazwiska like "%'.$value[1].'%"';
            break;}
            case 'rok':{
               $this->search.=' And filmy.Rok_produkcji like "%'.$value.'%"';
            break;}
            case 'gatunek':{
               $this->search.=' AND gatunek.gatunek like "%'.$value.'%"';
            break;}
                
                
        }
    }
        
    public function setConditions($key,$value){
        switch ($key){
            case 'limit':{
                $this->limit=' limit '.$value;
            break;
            }  
                
                
        }
        
    }
        public function setOrder($value='asc',$key='filmy.id'){
        if($value=='asc' || $value=='ascending' || $value=='ASC')
            $this->order.='ASC ';
        else if($value=='desc' || $value=='descending' || $value=='DESC')
            $this->order.='DESC ';
            
        $this->order=$key.' '.$value;
    }
    
    public function updateMovie($rezyser,$rok,$gatunek,$opis,$cena,$kara,$nosnik,$plakat,$id){
        $sql='UPDATE filmy SET '; $first=true;
       
                
        if($this->validate('rezyser',$rezyser)) 
                    { $sql.='rezyser='.$rezyser; $first=false;}
                
        if($this->validate('rok_produkcji',$rok))
                {if(!$first) $sql.=','; $sql.='Rok_produkcji='.$rok; $first=false;}
                
        if($this->validate('gatunek',$gatunek)) 
                {if(!$first) $sql.=','; $sql.='gatunek='.$gatunek; $first=false;}
                
        if($this->validate('opis',$opis)) 
                {if(!$first) $sql.=','; $sql.='Opis="'.$opis.'"'; $first=false;}
                
        if($this->validate('cena',$cena)) 
                {if(!$first) $sql.=','; $sql.='Cena='.$cena; $first=false;}
                
        if($this->validate('kara',$kara)) 
                {if(!$first) $sql.=','; $sql.='kara='.$kara; $first=false;}
                
        if($this->validate('nosnik',$nosnik)) 
                {if(!$first) $sql.=','; $sql.='Nosnik='.$nosnik; $first=false;}
                
        if($this->validate('plakat',$plakat)) 
                {if(!$first) $sql.=','; $sql.='plakat='.$plakat; $first=false;}
                
        $sql.=' WHERE id='.$id;
        $mov=$this->date->prepare($sql);
        $trr=$mov->execute();
        return trr;
    }
    public function getMovies($movieid) {
        $sql = 'SELECT id, tytul, imie.imiona, nawizska.nazwiska, Rok_produkcji,opis ,gatunek.gatunek, nosnik.nosnik, cena, kara, plakat.url FROM filmy';
        $sql .= ' INNER JOIN rezyser ON filmy.rezyser=rezyser.Id_r INNER JOIN imie on rezyser.id_i=imie.Id_g INNER JOIN nawizska ON rezyser.id_n=nawizska.Id_n ';
        $sql .= 'INNER JOIN gatunek ON filmy.gatunek=gatunek.Id_g INNER JOIN plakat on filmy.plakat=plakat.id_p INNER JOIN nosnik on filmy.nosnik=nosnik.Id_n ';
        $sql .= 'WHERE rezyser.Id_r=filmy.rezyser AND filmy.tytul=' . $movieid;

        $getm = $this->date->prepare($sql);
        $getm->execute();
        $tru = $getm->fetch();
        return $tru;
    }
    
    protected function validate($key,$value)
    {
        switch($key){
            case 'tytul':
                if(strlen($value)>=2) return true;
                break;
            case 'rezyser':
                if(!is_numeric($value)) $value=(int)$value;
                if($value>0) return true;
                break;
            case'rok_produkcji':
                if(!is_numeric($value)) $value=(int)$value;
                if($value>1900 && $value<2030) return true;
                break;
            case 'gatunek':
                if(!is_numeric($value)) $value=(int)$value;
                if($value>0) return true;
                break;
            case 'opis':
                if(strlen($value)>=5 && strlen($value)<=500) return true;
                break;
            case 'cena':
                if(!is_numeric($value)) $value=(int)$value;
                if($value>=2 && $value<=20) return true;
                break;
            case 'kara':
                if(!is_numeric($value)) $value=(int)$value;
                if($value>=2 && $value<=20) return true;
                break;
            case 'nosnik':
                if(!is_numeric($value)) $value=(int)$value;
                if($value>0) return true;
                break;
            case 'plakat':
                if(!is_numeric($value)) $value=(int)$value;
                if($value>0) return true;
                break;
            default: return false;
        }
        return false;
    }
    
    
    public function setPoster(){
              
                $uploaddir='plakaty/';
        $nn1=$_FILES['plakat']['name'];
		$nn=$uploaddir.$_FILES['plakat']['name'];
		$tn=$_FILES['plakat']['tmp_name'];
		if(move_uploaded_file($tn,$nn))
		{	
		$nn=$_FILES['plakat']['name'];
		$nn=htmlentities($nn,ENT_QUOTES,"utf-8");
                }
                $sql='INSERT INTO plakat values(NULL,"'.$nn1.'")';
                $sql_1='SELECT id_p FROM plakat WHERE url="'.$nn1.'" limit 1';
                $gret=$this->date->prepare($sql_1);
                $gret->execute();
                $nr=$gret->rowCount();
                $row=$gret->fetch();
                if($nr>0)
                return $row['id_p'];
                else{
                    $geting=$this->date->prepare($sql);
                    $geting->execute();
                    $gret->execute();
                    $row=$gret->fetch();
                    return $row['id_p'];
                }
        
    }
    public function createMovie($tytul,$rezyser,$rok,$gatunek,$opis,$cena,$kara,$nosnik,$plakat){
    
   if($this->validate('opis',$opis) && $this->validate('rezyser',$rezyser) && $this->validate('nosnik',$nosnik) && $this->validate('rok_produkcji',$rok) && $this->validate('cena',$cena) && $this->validate('kara',$kara) && $this->validate('plakat',$plakat) && $this->validate('tytul',$tytul))
   {$sql='INSERT INTO filmy VALUES(NULL,'.$nosnik.',"'.$tytul.'",'.$rok.','.$rezyser.','.$gatunek.',"'.$opis.'",'.$cena.','.$kara.','.$plakat.')';
   print($sql);     
    
   }
   }
};

class Wypozyczenie {

        private $date = null;

    function __construct($a) {
        $this->date = $a;
    }

    public function getLibrary() {
        $sql = 'SELECT wypozyczenia.*,imie.imiona, nawizska.nazwiska FROM `wypozyczenia` INNER JOIN klient ON wypozyczenia.Id_k=klient.Id_kl ';
        $sql .= 'INNER JOIN imie ON klient.imie=imie.Id_g INNER JOIN nawizska ON klient.nazwisko=nawizska.Id_n';
        $cir = $date->prepare($sql);
        $cir->execute();
        $alle = $cir->fetchAll();
        return $alle;
    }

    public function getMovies($param) {
        $sql = 'SELECT wyp_filmowe.Id_wyp_film, wypozyczenia.Id, filmy.tytul, plakat.url FROM `wyp_filmowe`';
        $sql .= 'INNER JOIN filmy ON wyp_filmowe.id_filmu=filmy.id INNER JOIN wypozyczenia ON wyp_filmowe.Id_wypo=wypozyczenia.Id INNER JOIN plakat ON filmy.plakat=plakat.id_p WHERE Id_wyp=' . $param;
        $cer = $date->prepare($sql);
        $cer->execute();
        return $cer->fetchAll();
    }
    
    public function deleteMovie($idwyp,$film)
    {
        if(!validateDelete($film)) return 0;
        if(!validateDelete($idwyp)) return 0;
        $sql='DELETE from wyp_filmowe WHERE id_wypo='.$idwyp.'AND id_filmu='.$idfilm;
        $delete=$this->date->prepare($sql);
        $delete->execute();
    }
    protected function validateDelete($value)
    {
        if(!is_numeric($value)) return false;
        if($value<=0) return false;
    }
    public function wypozyczenie(){
        $today=date('o-m-d');
        $end=new DateTIme($today);
        $today='"'.date('o-m-d').'"';
        $end->modify('+7 day');
        $end='"'.$end->format('Y-m-d').'"';
        $sql='INSERT INTO wypozyczenia VALUES(NULL,'.$_SESSION['user'].','.$today.','.$end.',NULL,3)';
        $wyp=$this->date->prepare($sql);
        $wyp->execute();
        $tru=$_POST['tabelaall'];
        $sql='SELECT id FROM wypozyczenia WHERE data_wyp='.$today.' AND id_k='.$_SESSION['user'].' ORDER BY id DESC LIMIT 1';
        $idkwyp=$this->date->prepare($sql);
        $idkwyp->execute();
        $idke=$idkwyp->fetch();
        print($sql);
        $this->zawarto($idke['id'],$tru);
        
        
    }
    protected function zawarto($id,$movie){
        
        foreach($movie as $m){
            $sql='INSERT INTO wyp_filmowe VALUES(NUlL,'.$id.','.$m.')';
            $t=$this->date->prepare($sql);
            $t->execute();

        }
    }
};

class Dictionary {

    private $date = null;

    function __construct($pdo) {
        $this->date = $pdo;
    }
    
   public function getValueViaId($id,$value){
      
        switch($value){
            case 'imie':{
                $sql='SELECT imie.imiona FROM imie WHERE id_g='.$id;
                break;}
            case 'nazwisko':{
                $sql='SELECT nawizska.nazwiska FROM nawizska where id_n='.$id;
                break;}
            
            case 'miasto':{
                $sql='SELECT miasta.Miasto FROM miasta where id_m='.$id;
                break;}
            case 'ulica':{
                $sql='SELECT ulice.ulice FROM ulice where id_ul='.$id;
                break;}
            
            case 'plakat':{
                $sql='SELECT plakat.url FROM plakat where id_p='.$id;
                break;}
            case 'nosnik':{
                $sql='SELECT nosnik.nosnik FROM nosnik where id_n='.$id;
                break;}
            default: $_SESSION['error_sql']="Niepoprawny argument zapytania!";
                $varg=false;
                return 'B³êdne dane zapytania sql';    
        } 
        $geting=$this->date->prepare($sql);
        $geting->execute();
        $dane=$geting->fetch();
        return $dane; 
    }
    
   public function setValue($value,$key){
      
        switch($key){
            case 'imie':{
                if($this->validate('imie',$value)==false) return 0;
                $sql='INSERT INTO imie values(NULL,"'.$value.'")';
                 $sql_1='SELECT id_g as id FROM imie where imiona="'.$value.'"';
                break;}
            case 'nazwisko':{ 
                if($this->validate('nazwisko',$value)==false) return 0;
                $sql='INSERT INTO nawizska values(NULL,"'.$value.'")';
                $sql_1='SELECT id_n as id FROM nawizska WHERE nazwiska="'.$value.'"';
                break;}
            case 'miasto':{
                if($this->validate('miasto',$value)==false) return 0;
                $sql='INSERT INTO miasta values(NULL,"'.$value.'")';
                 $sql_1='SELECT id_m as id FROM miasta where Miasto="'.$value.'"';
                break;}
            case 'ulica':{
                if($this->validate('ulica',$value)==false) return 0;
                $sql='INSERT INTO ulice values(NULL,"'.$value.'")';
                $sql_1='SELECT id_ul as id FROM ulice where ulice="'.$value.'"';
                break;}
            case 'nosnik':{
            
                $sql='INSERT INTO nosnik values(NULL,"'.$value.'")';
                 $sql_1='SELECT id_n as id FROM nosnik where nosnik="'.$value.'"';
                break;}
            default: $_SESSION['error_sql']="Niepoprawny argument zapytania!";
                $varg=false;
                return 'B³êdne dane zapytania sql';    
        } 
        $gret=$this->date->prepare($sql_1);
        $gret->execute();
        $row=$gret->fetch();
        $ile=$gret->rowCount();
        
        if($ile>0)  
        return $row['id'];
        else {
        $geting=$this->date->prepare($sql);
        $geting->execute();
        $gret->execute();
        $row=$gret->fetch();
        return $row['id'];
       }
    }
        protected function validate($key,$value){
        switch($key){
            case 'imie':{
                if(strlen($value)>0 && strlen($value)<25)
                 return true;
            break;}
            case 'nazwisko':{
                if(strlen($value)>0 && strlen($value)<25)
                 return true;
            break;}
            case 'miasto':{
                if(strlen($value)>0 && strlen($value)<25)
                 return true;
                
            break;}
            case 'ulica':{
                if(strlen($value)>0 && strlen($value)<25)
                 return true;
            break;}
            case 'kod':{
                if(strlen($value)==6 && $value[2]=="-") return true;
            break;}
            case 'numer':{
            if(strlen($value)>0) return true;
            }
            default: return false;
        }
    return false;
        
    }
    public function getLibrary($key){
        switch($key){
            case'gatunek':{
            $sql='SELECT * FROM gatunek';
            break;}
        }
        
        
        $library=$this->date->prepare($sql);
        $library->execute();
        $lib=$library->fetchAll();
        $arr=Array();$iterator=0;
        foreach($lib as $value){
            $arr['gatunek'][$iterator]=$value['gatunek'];
            $arr['id'][$iterator]=$value['Id_g'];
            $iterator++;
        } 
      return $arr;
    }
    
};
class Director{
    
    private $date = null;

    function __construct($pdo) {
        $this->date = $pdo;
    }
    
    public function getLibrary(){
        $join=' INNER JOIN imie ON imie.id_g=rezyser.id_i INNER JOIN nawizska ON nawizska.id_n=rezyser.id_n';
        $sql='SELECT rezyser.id_r, imie.imiona, nawizska.nazwiska FROM rezyser'.$join;      
        $direc=$this->date->prepare($sql);
        $direc->execute();
        $arr=$direc->fetchAll();
        $rezyser_array=Array();
        $it=0;
        foreach($arr as $value)
            {
            $rezyser_array['imie'][$it]=$value['imiona'];
            $rezyser_array['nazwisko'][$it]=$value['nazwiska'];
            $rezyser_array['id'][$it]=$value['id_r'];
            $it++;
            }
            
           return $rezyser_array;
        } 
        
        public function createDirector($im,$naz){
        $sql='INSERT INTO rezyser VALUES(NULL,'.$im.','.$naz.')';
        $sql_1='SELECT id_r FROM rezyser where id_i='.$im.' AND id_n='.$naz;
        $newrez=$this->date->prepare($sql);
        $newrez->execute();
        $rez=$this->date->prepare($sql_1);
        $rez->execute();
        $row=$rez->fetch();
        return $row['id_r'];    
        }
            
    
};
class Ocena{
    
    private $date = null;

    function __construct($pdo) {
        $this->date = $pdo;
    }
    public function getOcenaByUser($user,$movie){
        
        $sql='SELECT ocena FROM oceny where id_f='.$movie.' AND id_k='.$user;
        $mark=$this->date->prepare($sql);
        $mark->execute();
        $mark_fin=$mark->fetch();
        return $mark_fin['ocena'];
    }
    
    public function isMarked($user,$movie){
        
        $sql='SELECT ocena FROM oceny WHERE id_f='.$movie.' AND id_k='.$user;
        $mark=$this->date->prepare($sql);
        $mark->execute();
        $mark_fin=$mark->fetchAll();
        if(count($mark_fin)>0) return true;
        else return false;
    }
    
    public function getMarkByMovie($movie){
        $sql='SELECT avg(ocena) as ocena FROM oceny WHERE id_f='.$movie;
        $mr=$this->date->prepare($sql);
        $mr->execute();
        $markall=$mr->fetch();
    return round($markall['ocena'],1);
    }

    public function setMark($user,$movie,$ocena){
        $sql='INSERT INTO oceny VALUES(NULL,'.$movie.','.$user.','.$ocena.' )';
        $crem=$this->date->prepare();
        $crem->execute();
    }
    public function getStarByMark($mark){
        if($mark>=5) $s= 'gold';
        else if($mark>=4) $s= 'silver';
        else if($mark>=3) $s='bronze';
        else $s='#';
        return $s;
    }
};


class Komentarz{
    private $date=null;
    private $sql_conditions;
       function __construct($pdo) {
        $this->date = $pdo;
    }
    
    public function setSqlWhere($key,$value){
        $this->sql_conditions.=' AND '.$key.'='.$value;
    }
    public function comentOP($param,$key){
        $sql='UPDATE komentarze set OCENA='.$value.'WHERE id_kom='.$key;
        
    }
    
    public function getComment(){
        $join=' INNER JOIN konta ON konta.id=komentarze.uzytkownik_id INNER JOIN filmy on filmy.id=komentarze.content';
        $join.=' INNER JOIN oceny ON oceny.id_k=konta.id';
        $sql='SELECT komentaz, komentarze.ocena as oc, konta.login, oceny.ocena, komentarze.id_kom as id, filmy.tytul FROM komentarze'.$join.' where oceny.id_f=filmy.id ';
        $red=$sql.$this->sql_conditions;
        $koment=$this->date->prepare($sql.$this->sql_conditions);
        $koment->execute();
        $row=$koment->fetchAll();
        $this->clearSqlConditions();

        return $row;
        
    }
    public function clearSqlConditions(){
        $this->sql_conditions='';
    }
    public function createComment($user,$value,$film)
    {
        $sql='INSERT INTO komentarze values(NULL,'.$user.','.$film.','.$value.')';
        $set=$this->date->prepare($sql);
        $set->execute();
    }
    
};

class Koszyk
{
    private $date=null;
           
    function __construct($pdo) {
        $this->date = $pdo;
    }
    public function getKoszykId($user){
                $sql='select id_koszyk from koszyk WHERE koszyk.id_kl='.$user;
        $query=$this->date->prepare($sql);
        $query->execute();
        $row=$query->fetch();
        return $row['id_koszyk'];
    }
    public function getKoszykByUser($user){
        $sql='SELECT id_film,ilosc, koszyk.id_koszyk ,filmy.tytul, imie.imiona, nawizska.nazwiska, plakat.url FROM zawartosc INNER JOIN koszyk ON zawartosc.id_koszyk=koszyk.id_koszyk';
        $sql.=' INNER JOIN filmy ON zawartosc.id_film=filmy.id INNER JOIN plakat ON filmy.plakat=plakat.id_p INNER JOIN rezyser ON filmy.rezyser=rezyser.id_r';
        $sql.=' INNER JOIN imie ON imie.id_g=rezyser.id_i INNER JOIN nawizska ON rezyser.id_n=nawizska.id_n WHERE koszyk.id_kl='.$user;
        $query=$this->date->prepare($sql);
        $query->execute();
        $row=$query->fetchAll();
        return $row;
    }
    protected function sendProduct($movie,$ilosc){
        $sql='INSERT INTO zawartosc VALUES(NULL,'. $_SESSION['kosz'].','.$movie.','.$ilosc.')';
        $set=$this->date->prepare($sql);
        $set->execute();
    }
    protected function clear(){
        $sql='DELETE FROM zawartosc WHERE id_koszyk='.$_SESSION['kosz'];
        $empty=$this->date->prepare($sql);
        $empty->execute();
    }
    protected function deleteMovie($movie){
        
        
        $sql='DELETE FROM zawartosc WHERE id_koszyk='.$_SESSION['kosz'].' AND id_film='.$movie;
        $delet=$this->date->prepare($sql);
        $delet->execute();
       
    }
    
    public function create($user){
        $sql='INSERT INTO koszyk VALUES(NULL,'.$user.')';
        $create=$this->date->prepare($sql);
    }
    public function getCount($koszyk){
        $sql='SELECT count(id_filmu) FROM zawartosc WHERE id_koszyk='.$_SESSION['kosz'];
        $gett=$this->date->prepare($sql);
        $numb=$gett->fetch();
        return $numb;
    }
    protected function zamowienie(){
        $today=date('o-m-d');
       $zam=new Wypozyczenie($this->date);
       $zam->wypozyczenie();
    }
    public function options(){
        switch($_GET['mode']){
            case 'remove': $this->deleteMovie($_POST['film']);
            break;
            case 'add': $this->sendProduct($_POST['film'],1);
            break;
            case 'clear': $this->clear();
            break;
            case 'buy': {$this->zamowienie();
            $this->clear();
            }
            break;
        }
        
    }
}

class User{
    private $date = null;

    function __construct($pdo) {
        $this->date = $pdo;
    }
    public function logUser($nick,$haslo){
     
        $sql='select * from konta where login="'.$nick.'"';
        $verif=$this->date->prepare($sql);
        $verif->execute();
        $ov=$verif->fetch();
            if($ov && password_verify($haslo, $ov['haslo']))
            {
            $_SESSION['log']=true;
            $_SESSION['nick']=$ov['login'];
            $_SESSION['user']=$ov['id'];
            $_SESSION['tryb']=$ov['Typkonta'];
            $koszyk=new Koszyk($this->date);
            $_SESSION['kosz']=$koszyk->getKoszykId($_SESSION['user']);

            header('location:index.php');
            } else header('location:logowanie.php');
    } 
    public function setUser(){
        
        
    }
    
    public function updateUser(){
        
        
    }
   public function getUserData($user){
       $sql='SELECT login,haslo,email, Typkonta FROM konta where nick='.$user;
       $udata=$this->date->prepare($sql);
       $udata->execute();
       $row=$udata->fetchAll();
       return $row;
   } 
};
?>
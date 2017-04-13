<?php 
// Contient la date courante 
$current_date = date("d/m/Y");


// Contient le titre de la page 
$title = "Ma liste de films du " . $current_date;

// Contient les données de films 
$data = array ();

if (($handle = fopen("films.csv", "r")) !== FALSE) {
    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // var_dump($row);
        array_push($data, $row);
        // $data[] = $row;
    }
    fclose($handle);
}

// var_dump($data);

// Fonction destinée à afficher un élément de la liste
function show_row($film) {
    // $film = new Film($row);
    // echo "<li>" . $row[1] . "</li>";
    echo "<tr><td><a href='details.php?film=".$film->id."'>" . $film->title . "</a> </td> <td> " . $film->type. "</td></tr>";
}

// Fonction affichant un select des types de films
function show_select_types_de_film() {
    global $data;
    $types = array();
    foreach ($data as $row) {
        if (!in_array($row[3], $types) && $row[3] !="Type") {
            array_push($types, $row[3]);
            echo "<li role='type'><a role='menuitem' href='index.php?type=".urlencode($row[3])."'>".$row[3] . '</a></li>';
        }
    }
}

// Classe destinée à contenir les propriétés d'un film
class Film{

    public $id;
    public $title;
    public $image;
    public $type; 
    public $year;
    public $country;
    public $director;
    public $length;
    public $abstract;

    public function __construct($row) {
        $this->id = $row[0];
        $this->title = $row[1];
        $this->image = $row[2];
        $this->type = $row[3];
        $this->year = $row[4];
        $this->country = $row[5];
        $this->director = $row[6];
        $this->length =$row[7];
        $this->abstract = $row[8];

    }

public function __toString(){
    return $this->title . ", ". $this->type;
}    
}

class Finder {
    private $_data; 

    public function __construct($data) {
        $this->_data = $data;
    }

    public function find($id) {
        foreach ($this->_data as $row){
            if ($row[0] == $id) {
                return new Film($row);
            }
        }
        Return NULL;
    }
    public function FindByType ($type) {
        $found = array();
        if (!empty($type)){
            foreach($this->_data as $row){
     
                if ($row[3] == $type){
                     $found[] = new Film($row);
                }

            }
        }
        else {
            foreach ($this->_data as $row){
                if ($row[1] != "Title")
                {
                    $found[] = new Film ($row);
                }
            }
        }
return $found;
    }
}

?>
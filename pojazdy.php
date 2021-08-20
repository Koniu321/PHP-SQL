<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja Pojazdów</title>
    <link rel="stylesheet" href="style.css">
<?php
//    $con = mysqli_connect("localhost", "4i2_15", "Start2020", "4i2_15"); //Logowanie do plociennik.info

$con = mysqli_connect('localhost',"root","","projekt_bazy_sql"); //połączenie z phpmyadmin
    

if (!$con) {die("Błąd połączenia z serwerem bazy danych: ".mysqli_connect_error());}

?>
</head>
<body>
   <h3>Dodaj Informacje o samochodzie:</h3>
    <form method="post">
        <input name="marka" required placeholder="Marka Samochodu">
        <input name="nr_silnik" required placeholder="Numer Silnika">
        <input name="nr_nad" required placeholder="Numer Nadwozia">
        <input name="kolor" required placeholder="Kolor">
        <input name="r_prod" required placeholder="Rok Produkcji">
        <input name="id_w" placeholder="ID właściciela">
        <button type="submit" name="dodaj_p">Dodaj</button> <!--dodaj_p czyli dodaj pojazd -->
    </form>
    <h3>Dodaj Informacje o właścicielu:</h3>
    <p>Wprowadzenie istniejącego już ID spowoduje iż dane nie zostaną dodane do bazy</p>
    <form method="post">
        <input name="imie" required placeholder="Imię">
        <input name="nazwisko" required placeholder="Nazwisko">
        <input name="rej" required placeholder="Numer rejestracujny">
        <input name="miejsce" required placeholder="Miasto zarejestrowanie">
        <input name="id_w" required placeholder="(Unikatowe) ID właściciela">
        <input name="uwaga" placeholder="Uwagi co do samochodu">
        <button type="submit" name="dodaj_w">Dodaj</button><!-- dodaj_w czyli dodaj właściciela -->
    </form>

    
<?php
    $pokaz='select id_wlasciciela from wlasciciele';
    $ok= mysqli_query($con,$pokaz);
    echo '<br>Zajęte dotychczas ID: ';
    while($data = mysqli_fetch_assoc($ok)){
        echo implode(", ", $data),', '; 
    }
    
  if(isset($_POST["dodaj_p"]))
  {
      $add = 'insert into samochody values(NULL,"'.$_POST["marka"].'","'.$_POST["nr_silnik"].'","'.$_POST["nr_nad"].'","'.$_POST["kolor"].'", "'.$_POST["r_prod"].'", "'.$_POST["id_w"].'")';
      mysqli_query($con, $add);
  }
    
    if(isset($_POST["dodaj_w"]))
    {
        $add= 'insert into wlasciciele values("'.$_POST["imie"].'","'.$_POST["nazwisko"].'", "'.$_POST["rej"].'", "'.$_POST["miejsce"].'", "'.$_POST["id_w"].'", "'.$_POST["uwaga"].'")';
        mysqli_query($con, $add);
        
    }
?> 
<br><br><br>   
<div id="line"></div>

<h4 id="tekst">Szukaj wg.</h4>
<form method="post">
    <select id="opcje" name="co" onchange="wstaw()">
       <option>-Wybierz-</option>
        <option value="marka">Marki</option>
        <option value="rej">Fragmentu Nr Rejestracyjnego</option>
        <option value="nr">Fragment nr silnika/nadwozia</option>
        <option value="color">Koloru</option>
        <option value="rok">Roku produkcji</option>
        <option value="nazwa">Nazwiska/Imienia właściciela</option>
        <option value="miasto">Miasto zarejestrowania</option>
    </select>
    <div id="tutaj"><input name="szuk" placeholder="Wyszukaj"></div>
   
    <button type="submit" name="wyszukaj">Szukaj</button><br><br>
    <button type="submit" name="pokaz">Pokaż wszystko</button>
</form>
<br>
<!-- Wybór z listy a potem wg tego wyboru szukamy danych w bazie -->
<script>
    function wstaw(){
        let val= document.querySelector("#opcje").value;
        if(val=="rok"){
            document.querySelector("#tutaj").innerHTML= '<input name="od" placeholder="od Roku" required><input name="do" placeholder="do Roku" required>';
        }
        else document.querySelector("#tutaj").innerHTML = '<input name="szuk" placeholder="Wyszukaj">';
    }
</script>
<?php
    function wyswietl($q){
        //    $con = mysqli_connect("localhost", "4i2_15", "Start2020", "4i2_15"); //Logowanie do plociennik.info
        $con = mysqli_connect('localhost',"root","","projekt_bazy_sql");
        $wynik = mysqli_query($con,$q);
        $l = mysqli_num_rows($wynik);
        echo '<table>';
        echo'<tr><th>Marka Samochodu</th><th>Numer Silnika</th><th>Numer Nadwozia</th><th>Kolor</th><th>Rok produkcji</th><th>ID właściciela</th><th>Imie</th><th>Nazwisko</th><th>Numer Rejestracyjny</th><th>Miasto zarejestrowania</th><th>Uwagi</th></tr>';
        for($i=0;$i<$l;$i++){
            $dane = mysqli_fetch_assoc($wynik);
            echo '<tr>';
               echo '<td>'.$dane['Marka_samochodu'].'</td>';
               echo '<td>'.$dane["Numer_silnika"].'</td>';
               echo '<td>'.$dane["Numer_nadwozia"].'</td>';
               echo '<td>'.$dane["Kolor"].'</td>';
               echo '<td>'.$dane["Rok_produkcji"].'</td>';
               echo '<td>'.$dane["id_wlasciciela"].'</td>';
               echo '<td>'.$dane["Imie"].'</td>';
               echo '<td>'.$dane["Nazwisko"].'</td>';
               echo '<td>'.$dane["Numer_rejestracyjny"].'</td>';
               echo '<td>'.$dane["Miejsce_zarejestrowania"].'</td>';
               echo '<td>'.$dane["Uwagi_do_samochodu"].'</td>';
            echo '</tr>';
            
        }
        echo '</table>';
    }
    
    
    if(isset($_POST['wyszukaj'])){
        $poczatek = 'select * from samochody join wlasciciele on samochody.id_wlasciciela = wlasciciele.id_wlasciciela';
        
        if($_POST['co']=='marka'){
            $query=''.$poczatek.' where Marka_samochodu like "%'.$_POST['szuk'].'%" ';
            wyswietl($query); 
        }
        else if($_POST['co']=='rej'){
            $query =''.$poczatek.' where Numer_rejestracyjny like "%'.$_POST['szuk'].'%"';
            wyswietl($query); 
        }
        else if($_POST['co']=='nr'){
            $query = ''.$poczatek.' where Numer_silnika like "%'.$_POST['szuk'].'%" or Numer_nadwozia like "%'.$_POST['szuk'].'%"';
            wyswietl($query); 
        }
        else if($_POST['co']=='color'){
            $query = ''.$poczatek.' where Kolor like "'.$_POST['szuk'].'"';
            wyswietl($query); 
            
        }
        else if($_POST['co']=='rok'){
            $query= ''.$poczatek.' where Rok_produkcji >= '.$_POST['od'].' and Rok_produkcji <= '.$_POST['do'].'';  
            wyswietl($query); 
        }
        else if($_POST['co']=='nazwa'){
            $query= ''.$poczatek.' where Nazwisko or Imie like "'.$_POST['szuk'].'"';
            wyswietl($query);  
        }
        else if($_POST['co']=='miasto'){
            $query= ''.$poczatek.' where Miejsce_zarejestrowania like "'.$_POST['szuk'].'"';
            wyswietl($query);  
        }
    }
    
    if(isset($_POST['pokaz'])){
        $query='select * from samochody join wlasciciele on samochody.id_wlasciciela = wlasciciele.id_wlasciciela';
        wyswietl($query); 
    }
?>

</body>
</html>
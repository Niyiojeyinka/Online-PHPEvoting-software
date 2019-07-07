 <div class="w3-twothird w3-center">

    <div style="max-width:95%;height:90%;overflow-y: scroll;"><center> <br><br><br>
      <style type="text/css">
        
        table, td {
     border: 1px solid black;
} 
th, td {
    padding: 15px;
} 
      </style>
<?php
for ($i=0; $i < count($results) ; $i++) { 
  echo "<b style='color:rgb(0,0,102);font-size:20px;'>".$results[$i]['position_label']."</b><br>";
echo "<div>";

if(is_array($results[$i]['candidates']))
{

  echo "<br><table>";

  //asort($results[$i]['candidates'],SORT_NUMERIC);
echo "<tr><td><b style='margin-right:80px;'>Candidates</b>     </td>";
echo "<td>    <b style='margin-left:40px;'>Votes</b></td></tr>";
$hold_score = [];
  foreach ($results[$i]['candidates'] as $candidate) {
    //use each score as id make the winner unique
    $id = mt_rand(1,100).''.mt_rand(1,100);
echo "<tr><td id='".$id."'><b style='margin-right:80px;'>".strtoupper($candidate['firstname'])." ".strtoupper($candidate['lastname'])." (".strtoupper($candidate['username']).")</b>  <span id='".$id."div'></span>   </td>";
echo "<td>    <span style='margin-left:40px;'>".$candidate['no_votes']."</span></td></tr>";
$hold_score[$candidate['no_votes']] = $id;
//sort($hold_score);
 //var_dump($hold_score);
  $array_keys= array_keys($hold_score);
        sort($array_keys);
     if($array_keys[count($array_keys)-1] != 0)
     {
$winner_line_id = $hold_score[$array_keys[count($array_keys)-1]];
}
echo "<script>";
echo "document.getElementById('".$winner_line_id."').style.color = 'green';";
echo "document.getElementById('".$winner_line_id."div').innerHTML = '  WINNER';";

echo "</script>";
  }

 
  echo "</table><br>";
     
echo "</div>";
}else{
  echo "No candidate for this Post<br>";
}

}





?>


</center>
    </div>
</div>
<html><head><title>LibertyFamily</title>
<style>
td {
	font-weight: bold;
	font-family: Verdana;
	font-size: 12px;
	border: 1px solid black;
	padding: 5px 10px;
	text-align: center;
}
</style>
</head>
<body">
<table>
	<tr>
		<td>#</td>
		<td>Pseudo</td>
		<td>Tag</td>
		<td>Level</td>
		<td>TH</td>
		<td>Trophées</td>
		<td>Etoiles</td>
		<td>Roi</td>
		<td>Reine</td>
		<td>Gardien</td>
		<td>Clan</td>
		<td>Archer</td>
		<td>Balloon</td>
		<td>Barbarian</td>
		<td>Bowler</td>
		<td>Dragon</td>
		<td>Giant</td>
		<td>Goblin</td>
		<td>Golem</td>
		<td>Healer</td>
		<td>Hog Rider</td>
		<td>Lava Hound</td>
		<td>Miner</td>
		<td>Minion</td>
		<td>PEKKA</td>
		<td>Valkyrie</td>
		<td>Wakk Breaker</td>
		<td>Witch</td>
		<td>Wizard</td>
	</tr>
<?php
require_once('./src/connexion.php');
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM membres ORDER BY trophies DESC";
$result = $conn->query($sql);
$i = 0;
while($row = $result->fetch_assoc()) {
$i++;
$pseudo = $row['name'];
$tag = $row['tag'];
$level = $row['expLevel'];
$th = $row['th'];
if ($th == 12) {
	$classTh='style="background-color: blue"';
}
else if ($th == 11) {
	$classTh='style="background-color: white"';
}
else {
	$classTh='style="background-color: red"';
}
$trophees = $row['trophies'];
if ($trophees >= 5000) {
	$classTrophees='style="background-color: purple"';
}
else if ($trophees >= 4100 && $trophees < 5000) {
	$classTrophees='style="background-color: yellow"';
}
else {
	$classTrophees='style="background-color: white"';
}
$etoiles = $row['warStars'];
$clan = $row['clan'];
$queen = $row['queen'];
if ($queen == 60) {
	$classQueen='style="background-color: green"';
}
else if (($queen == 50 && $th == 11) || ($queen == 40 && $th == 10)){
	$classQueen = 'style="background-color: yellow"';
}
else {
	$classQueen = 'style="background-color: red"';	
}
$king =  $row['king'];
if ($king == 60) {
	$classKing='style="background-color: green"';
}
else if (($king == 50 && $th == 11) || ($king == 40 && $th == 10)) {
	$classKing = 'style="background-color: yellow"';
}
else {
	$classKing = 'style="background-color: red"';
}
$warden = $row['warden'];
if ($warden == 30) {
	$classWarden='style="background-color: green"';
}
else if ($warden == 20 && $th == 11) {
	$classWarden = 'style="background-color: yellow"';
}
else if ($th < 11) {
	$classWarden = 'style="background-color: white"';
}
else {
	$classWarden = 'style="background-color: red"';
}

$archer = $row['archer'];
$balloon = $row['balloon'];
$barbarian = $row['barbarian'];
$bowler = $row['bowler'];
$dragon = $row['dragon'];
$giant = $row['giant'];
$goblin = $row['goblin'];
$golem = $row['golem'];
$healer = $row['healer'];
$hogrider = $row['hogrider'];
$lavahound = $row['lavahound'];
$miner = $row['miner'];
$minion = $row['minion'];
$pekka = $row['pekka'];
$valkyrie = $row['valkyrie'];
$wallbreaker = $row['wallbreaker'];
$witch = $row['witch'];
$wizard = $row['wizard'];


$tmp = "<tr>";
$tmp .= "<td>".$i."</td>";
$tmp .= "<td>".$pseudo."</td>";
$tmp .= "<td>".$tag."</td>";
$tmp .= "<td>".$level."</td>";
$tmp .= "<td ".$classTh.">".$th."</td>";
$tmp .= "<td ".$classTrophees.">".$trophees."</td>";
$tmp .= "<td>".$etoiles."</td>";
$tmp .= "<td ".$classKing.">".$king."</td>";
$tmp .= "<td ".$classQueen.">".$queen."</td>";
$tmp .= "<td ".$classWarden.">".$warden."</td>";
$tmp .= "<td>".$clan."</td>";
$tmp .= "<td>".$archer."</td>";
$tmp .= "<td>".$balloon."</td>";
$tmp .= "<td>".$barbarian."</td>";
$tmp .= "<td>".$bowler."</td>";
$tmp .= "<td>".$dragon."</td>";
$tmp .= "<td>".$giant."</td>";
$tmp .= "<td>".$goblin."</td>";
$tmp .= "<td>".$golem."</td>";
$tmp .= "<td>".$healer."</td>";
$tmp .= "<td>".$hogrider."</td>";
$tmp .= "<td>".$lavahound."</td>";
$tmp .= "<td>".$miner."</td>";
$tmp .= "<td>".$minion."</td>";
$tmp .= "<td>".$pekka."</td>";
$tmp .= "<td>".$valkyrie."</td>";
$tmp .= "<td>".$wallbreaker."</td>";
$tmp .= "<td>".$witch."</td>";
$tmp .= "<td>".$wizard."</td>";
$tmp .= "</tr>";
echo $tmp;
}
$conn->close();
?>
</table>
</body>
</html>

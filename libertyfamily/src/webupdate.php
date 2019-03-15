<?php

$base_url = "https://api.clashofclans.com/v1";


$compteurSQL = 0;
require_once 'config.php';


$conn = new mysqli($servername, $username, $password, $dbname);

// Clear de tous les membres
$sql = "DELETE FROM membres";
if ($conn->query($sql) === TRUE)
    echo "Clean OK";
else 
 echo "Clean error";

$url_clan = $base_url .'/clans/'.urlencode($clantag);

$context = stream_context_create(['http' => ['header' => 'Authorization: Bearer '.$token]]);
$json = file_get_contents($url_clan, false, $context);
$clanData = json_decode($json);
$playerData = [];

foreach ($clanData->memberList as $member) {
    $url_player = $base_url .'/players/'.urlencode($member->tag);
    $json = file_get_contents($url_player, false, $context);
    $playerData[] = json_decode($json);
}

$result = array(
    'updatedOn' => time(),
    'clan' => $clanData,
    'players' => $playerData
);

//file_put_contents('../data/clan-info.json', json_encode($result));

$url_clan = $base_url .'/clans/'.urlencode($clantag);

$context = stream_context_create(['http' => ['header' => 'Authorization: Bearer '.$token]]);
$json = file_get_contents($url_clan, false, $context);
$clanData = json_decode($json,true);
$playerData = [];





$tag = mysqli_real_escape_string($conn,$clanData['tag']);
$name = mysqli_real_escape_string($conn,$clanData['name']);
$location = mysqli_real_escape_string($conn,$clanData['location']['id']);
$badgeUrls_small = mysqli_real_escape_string($conn,$clanData['badgeUrls']['small']);
$badgeUrls_large = mysqli_real_escape_string($conn,$clanData['badgeUrls']['large']);
$badgeUrls_medium = mysqli_real_escape_string($conn,$clanData['badgeUrls']['medium']);
$type = mysqli_real_escape_string($conn,$clanData['type']);
$requiredTrophies = mysqli_real_escape_string($conn,$clanData['requiredTrophies']);
$warFrequency = mysqli_real_escape_string($conn,$clanData['warFrequency']);
$isWarLogPublic = (int)$clanData['isWarLogPublic'];
$description = mysqli_real_escape_string($conn,$clanData['description']);

$clanLevel = (int)mysqli_real_escape_string($conn,$clanData['clanLevel']);
$clanPoints = (int)mysqli_real_escape_string($conn,$clanData['clanPoints']);
$clanVersusPoints = (int)mysqli_real_escape_string($conn,$clanData['clanVersusPoints']);
$members = (int)mysqli_real_escape_string($conn,$clanData['members']);
$warWinStreak = (int)mysqli_real_escape_string($conn,$clanData['warWinStreak']);
$warWins = (int)mysqli_real_escape_string($conn,$clanData['warWins']);


/*
* player update
*/
foreach ($clanData['memberList'] as $member) {

    $url_player = $base_url .'/players/'.urlencode($member['tag']);
    $json_player = file_get_contents($url_player, false, $context);
    $player = json_decode($json_player,true);


    $tag = mysqli_real_escape_string($conn,$player['tag']);
    $name = mysqli_real_escape_string($conn,$player['name']);
			$playername = $name;
    $expLevel = (int)mysqli_real_escape_string($conn,$player['expLevel']);
    $league = (int)mysqli_real_escape_string($conn,$player['league']['id']);
    if($league == 0){
        $league = 29000000;
    }
    $trophies = (int)mysqli_real_escape_string($conn,$player['trophies']);
    $versusTrophies = (int)mysqli_real_escape_string($conn,$player['versusTrophies']);
    $attackWins = (int)mysqli_real_escape_string($conn,$player['attackWins']);
    $defenseWins = (int)mysqli_real_escape_string($conn,$player['defenseWins']);
    $bestTrophies = (int)mysqli_real_escape_string($conn,$player['bestTrophies']);
    $donations = (int)mysqli_real_escape_string($conn,$player['donations']);
    $donationsReceived = (int)mysqli_real_escape_string($conn,$player['donationsReceived']);
    $warStars = (int)mysqli_real_escape_string($conn,$player['warStars']);
    $townHallLevel = (int)mysqli_real_escape_string($conn,$player['townHallLevel']);
    $builderHallLevel = (int)mysqli_real_escape_string($conn,$player['builderHallLevel']);
    $bestVersusTrophies = (int)mysqli_real_escape_string($conn,$player['bestVersusTrophies']);
    $versusBattleWins = (int)mysqli_real_escape_string($conn,$player['versusBattleWins']);
    $role = mysqli_real_escape_string($conn,$player['role']);

	
		/*
		* Player Achievements
		*/
		foreach ($player['achievements'] as $achievement)
		{
        $name = mysqli_real_escape_string($conn,$achievement['name']);
        $stars = (int)mysqli_real_escape_string($conn,$achievement['stars']);
        $value = (int)mysqli_real_escape_string($conn,$achievement['value']);
        $target = (int)mysqli_real_escape_string($conn,$achievement['target']);
        $info = mysqli_real_escape_string($conn,$achievement['info']);
        $village = mysqli_real_escape_string($conn,$achievement['village']);

		}

    /*
    * Player Heroes
    */
	$queen = 0;
	$king = 0;
	$warden = 0;
	
    foreach ($player['heroes'] as $hero)
    {
        $name = mysqli_real_escape_string($conn,$hero['name']);
        $level = (int)mysqli_real_escape_string($conn,$hero['level']);
        $maxLevel = (int)mysqli_real_escape_string($conn,$hero['maxLevel']);
        $village = mysqli_real_escape_string($conn,$hero['village']);
		switch ($name) {
			case 'Barbarian King':
				$king = $level;
			break;
			case 'Archer Queen':
				$queen = $level;
			break;
			case 'Grand Warden':
				$warden = $level;
			break;
			
		}
    }

    /*
    * Player Troops
    */
	$i=0;
	
    $archer = 0;
    $balloon = 0;
    $barbarian = 0;
    $bowler = 0;
    $dragon = 0;
    $giant = 0;
    $goblin = 0;
    $golem = 0;
    $healer = 0;
    $hogriver = 0;
    $lavahound = 0;
    $miner = 0;
    $minion = 0;
    $pekka = 0;
    $valkyrie = 0;
    $wallbreaker = 0;
    $witch = 0;
    $wizard = 0;


    foreach ($player['troops'] as $troop)
    {
        $name = mysqli_real_escape_string($conn,$troop['name']);
        $level = (int)mysqli_real_escape_string($conn,$troop['level']);
        $maxLevel = (int)mysqli_real_escape_string($conn,$troop['maxLevel']);
        $village = mysqli_real_escape_string($conn,$troop['village']);
		$i++;
		
		switch ($name) {
			case 'Archer': $archer = $level; break;
			case 'Balloon': $balloon = $level; break;
			case 'Barbarian': $barbarian = $level; break;
			case 'Bowler': $bowler = $level; break;
			case 'Dragon': $dragon = $level; break;
			case 'Giant': $giant = $level; break;
			case 'Goblin': $goblin = $level; break;
			case 'Golem': $golem = $level; break;
			case 'Healer': $healer = $level; break;
			case 'Hog Rider': $hogrider = $level; break;
			case 'Lava Hound': $lavahound = $level; break;
			case 'Miner': $miner = $level; break;
			case 'Minion': $minion = $level; break;			
			case 'P.E.K.K.A': $pekka = $level; break;
			case 'Valkyrie': $valkyrie = $level; break;
			case 'Wall Breaker': $wallbreaker = $level; break;
			case 'Witch': $witch = $level; break;
			case 'Wizard': $wizard = $level; break;
		}
		
		
    }

    /*
    * Player spells
    */
	$i=0;
    foreach ($player['spells'] as $spell)
    {
        $name = mysqli_real_escape_string($conn,$spell['name']);
        $level = (int)mysqli_real_escape_string($conn,$spell['level']);
        $maxLevel = (int)mysqli_real_escape_string($conn,$spell['maxLevel']);
        $village = mysqli_real_escape_string($conn,$spell['village']);
		$i++;
    }
	
	$sql = "INSERT INTO membres VALUES('".$tag."', '".$playername."', '".$expLevel."', '".$trophies."', '".$warStars."', '".$townHallLevel."', 'LibertyZWar', '".$king."','".$queen."','".$warden."','".$archer."','".$balloon."','".$barbarian."','".$bowler."','".$dragon."','".$giant."','".$goblin."','".$golem."','".$healer."','".$hogrider."','".$lavahound."','".$miner."','".$minion."','".$pekka."', '".$valkyrie."','".$wallbreaker."','".$witch."','".$wizard."')";
			        if ($conn->query($sql) === TRUE) 
        {
            $compteurSQL++;
        } 
        else 
        {
	 $compteurSQL++;
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
	}
$conn->close();

echo 'sql request :'.$compteurSQL;
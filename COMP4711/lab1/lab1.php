
<?php
	class Game {
		var $turn;
		var $position;
		var $win = false;
		
		function __construct($squares){
			$this->position = str_split($squares);
		}
		
		function gameStart(){
			if($this->winner('X') == true){
				echo "GAME OVER X wins";
				$this->win = true;
			}else if($this->winner('O') == true){
				echo "GAME OVER O wins";
				$this->win = true;
			}			
			
			$this->turn();
			$this->display();
		}
		
		function turn(){
			$turn_count = 0;
			for($i = 0; $i < 9; $i++){
				if($this->position[$i] == "X" ||
				   $this->position[$i] == "O"){
					$turn_count++;
				}
			}
			if(($turn_count%2) == 1){
				$this->turn = "O";
			}else{
				$this->turn = "X";
			}
		}
		
		function winner($token){
			
			//check for horizontal win combo
			for($row=0; $row<3; $row++){
				$result = true;
				for($col=0; $col<3; $col++){
					if($this->position[3*$row+$col] != $token){
						$result = false;
					}
				}
				if ($result == true){
					return $result;
				}
			}
			
			//check for vertical win combo
			for($row=0; $row<3; $row++){
				$result = true;
				for($col=0; $col<3; $col++){
					if($this->position[$row+($col*3)] != $token){
						$result = false;
					}
				}
				if ($result == true){
					return $result;
				}
			}
			
			//check for diagonal win combo
			//0-4-8 and 2-4-6
			for($diag=0; $diag<3; $diag+=2){
				$result = true;
				for($col=0; $col<3; $col++){
					if($this->position[$diag+($col*(4-$diag))] != $token){
						$result = false;
					}
				}
				if ($result == true){
					return $result;
				}
			}

			return $result;
		}
		
		function display(){
			echo '<link rel="stylesheet" type="text/css" href="mystyle.css">';
			echo '<table border="1" cols="3" style=" font-size:40px; font-weight:bold">';
			echo "<tr>";
			for ($pos = 0; $pos<9; $pos++){
				echo $this->show_cell($pos);
				if ($pos%3 == 2) echo "</tr><tr>";
			}
			echo "</tr>";
			echo "</table>";
		}
		
		function show_cell($which){
			$token = $this->position[$which];
			if($token <> '-') return '<td>'.$token.'</td>';
			$this->newposition = $this->position;
			$this->newposition = $this->position;
			$this->newposition[$which] = $this->turn;
			$move = implode($this->newposition);
			$link = '?board='.$move;
			if($this->win == false){
				return '<td class="unselected"><a href="'.$link.'">-</a></td>';
			}else{
				return '<td></td>';
			}
			
		}
		
		function restart_game(){
			$link = '?board='."---------";
			echo '<br><br><br>';
			echo '<a href="'.$link.'" class="button"><center>Reset Board</center></a>';
		}
	}

	$game = new Game($_GET['board']);
	echo '<h1> <center>COMP 4711 TIC TAC TOE GAME </center></h1>';
	echo '<div style="width:350px; margin:0 auto">';
	$game->gameStart();
	$game->restart_game();
	echo '</div>';
	
	
?>

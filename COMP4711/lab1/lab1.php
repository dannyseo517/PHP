
<?php
	class Game {
		var $turn = "X";
		
		var $position;
		
		function __construct($squares){
			$this->position = str_split($squares);
		}
		
		function winner($token){
			$won = false;
			if (($this->position[0] == $token) &&
				($this->position[1] == $token) &&
				($this->position[2] == $token)) {
				$won = true;
			} else if(($this->position[3] == $token) &&
					  ($this->position[4] == $token) &&
					  ($this->position[5] == $token)) {
				$won = false;
			}
			return $won;	
		}
		
		function display(){
			echo "<table>";
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
			$this->newposition[$which] = "O";
			$move = implode($this->newposition);
			$link = '/?board='.$move;
			return '<td><a href="'.$link.'">-</a></td>';
		}
		
	}
	//$position = $_GET['board'];
	//$squares = str_split($position);
	$game = new Game($_GET['board']);
	//echo $game->turn;
	$game->display();
	
?>

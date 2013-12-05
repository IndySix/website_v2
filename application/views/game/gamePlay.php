<style type="text/css">
#menu  #playButton {
	border-color: #f60;
}
</style>
<div class="playLevel">
<h1><?PHP echo $part_name ?></h1>
<h2>Time</h2>
<p><span id="timer">5:00</span></p>
<h2>Description</h2>
<p><?PHP echo $level['level_description']?></p>
<h2>Score</h2>
<p><span><?PHP echo $maxScore ?></span></p>
<h2>Try's</h2>
<p><span><?PHP echo $trys ?></span></p>
</div>

<script type="text/javascript">
var timer_id       = 0;
var game_end_time  = <?PHP echo $endTime; ?>;
var game_status_id = 0;

function gameStatus(){
  jQuery.get( "<?PHP echo baseUrl('game/status/'.$level['id']) ?>", function( data ) {
    jsonObj = JSON.parse(data);
    if(jsonObj.status == 'stop') {
      //Go back to level select or display message
      window.clearInterval(game_status_id);
    } else if(jsonObj.status == 'score'){
      //go to feedback screen
      window.location.href = "<?PHP echo baseUrl('game/feedback/'.$level['id']) ?>";
    }
  });
}

function timer(){
    var time = -Math.round((new Date().getTime()/1000)- game_end_time);
    var node = document.getElementById("timer");
    if(time >= 0) {
      minutes = Math.floor(time/60);
      seconds = time%60;
      node.innerHTML = minutes+':'+(seconds > 9 ? "" + seconds: "0" + seconds); 
    } else {
        node.innerHTML = "Time is up";
        window.clearInterval(timer_id);
    }
}

gameStatus();
game_status_id = window.setInterval(gameStatus,3000 );

timer();
timer_id = window.setInterval(timer,1000 );
</script>
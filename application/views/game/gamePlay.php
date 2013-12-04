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

timer();
timer_id = window.setInterval(timer,1000 );
</script>
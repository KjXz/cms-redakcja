<body>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="ROK"]'); 
        var container=$('.bootstrap-iso form').length > 0 ? 
		$('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
			format: "yyyy",
			viewMode: "years", 
			minViewMode: "years",
			autoclose: "true",
			orientation: "bottom right",
        })
    });
</script>

<script>
	var number = document.getElementById('number');
	number.onkeydown = function(e) {
		if(!((e.keyCode > 95 && e.keyCode < 106)
		|| (e.keyCode > 47 && e.keyCode < 58) 
		|| e.keyCode == 8)) {
        return false;
    }};
</script>

<br />
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="profile.php"><span class="glyphicon glyphicon-home"></span> 
	  System zarządzania redakcją czasopism</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
	   <li class="active"><a href="#"><span class="glyphicon glyphicon-user"></span>
	   Witaj: <?php echo $login_session; ?></a></li>
	  <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> 
		  Panel Administracyjny <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="dodajtom.php"><b>1.</b> Dodaj tomy</a></li>
            <li><a href="dodajosobe.php"><b>2.</b> Dodaj osoby</a></li>
			<li><a href="dodajartykul.php"><b>3.</b> Dodaj artykuł</a></li>
			<li class="divider"></li>
			<li><a href="edytujwpisy.php"><span class="glyphicon glyphicon-wrench"></span>
			Edycja i usuwanie wpisów</a></li>
			<li><a href="inforec.php"><span class="glyphicon glyphicon-eye-open"></span> 
			Informacje o recenzentach</a></li>
			<li class="divider"></li>
			<li><a href="profile.php"><span class="glyphicon glyphicon-home"></span> 
			Powrót na stronę główną</a></li>
          </ul>
        </li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Wyloguj</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="panel panel-primary">
     <div class="panel-heading"><h2><center>Annales Mathematicae Silesianae</center></h2></div></div>
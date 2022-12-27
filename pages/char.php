<?php 
include 'includes/config.php'; 
include 'includes/header.php';
checkForLogin();

if(!isset($_GET['id']))
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../pages/index.php">';    
	exit;	
}

$charaID = $_GET['id'];
$sesuID = $_SESSION['uID'];

$query = $con->prepare("SELECT * from chars where charid = '$charaID'");
$query->execute();
$gData = $query->fetch();

if($gData['accountid'] != $sesuID)
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../pages/index.php">';    
	exit;	
}


?>
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            <?php echo $gData['charname']; ?>
                        </h1>
                    </div>
                </div>

			<div class="row">
			    <div class="col-lg-2">
					<img src="../bigskins/<?php echo $gData['charskin']; ?>.png" style="height:300px;">
				</div>
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
								Hand Money: $<?php echo number_format($gData['playercash']); ?>
								<hr />
								Bank Money: $<?php echo number_format($gData['playerbankcash']); ?>
								<hr />
								Total Money: $<?php echo number_format($gData['playerbankcash'] + $gData['playercash']); ?>
								<hr />
								Phone Number: <?php if($gData['playerphonenumber'] != 0) echo $gData['playerphonenumber']; 
								else echo "None"; ?>
								<hr />
								Level: <?php echo number_format($gData['playerexplevel']); ?>
								<hr />
								Respect Points: <?php echo number_format($gData['playerrespoints']); ?>/(EDIT THIS)
								<hr />
								Age: <?php echo number_format($gData['playerage']); ?>
								<hr />
								Health: <div class="progress progress-striped active"><div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $gData['phealthbar']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $gData['phealthbar']; ?>%"></div></div>
								<hr />
								Armour: <div class="progress progress-striped active"><div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $gData['parmourbar']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $gData['parmourbar']; ?>%"></div></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

<?php
include 'includes/footer.php'; 
?>

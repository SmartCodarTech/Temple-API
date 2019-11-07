
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content">
<div class="space4"></div>
<div class="space4"></div>

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>

<?php $nonce = create_csrf(); ?>

 <section class="wrapper padding4"> 

<?php if(!empty($series)){ ?>
<div class="col-lg-12">
<div class="tab-pane" id="datatable"> <section class="table-list"> 



<div class="table-responsive"> 
<table class="table table-striped m-b-none" data-ride="datatables"> 
<thead> 
<tr> 

<th width="30%">Titile
</th>  
<th width="50%">Summary
</th> 

<th width="20%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($series as $serie) { ?>
<tr>

  <td><?php echo htmlentities($serie->title);?></td>
  <td><?php echo htmlentities($serie->summary);?></td>


  <td>
  <a class="btn btn-sm" href="<?php echo htmlentities(BASE_URL);?>blog/deleteSeries/<?php echo htmlentities($serie->id);?>"><i class="icon-trash icon-2x" data-title="Delete Series" data-placement="bottom" data-toggle="tooltip"></i></a>
  <a class="btn btn-sm" href="<?php echo htmlentities(BASE_URL);?>blog/editSeries/<?php echo htmlentities($serie->id);?>"><i class="icon-pencil icon-2x" data-title="Edit Series" data-placement="bottom" data-toggle="tooltip"></i></a>
   


  </td>


</tr>


<?php } ?>


</tbody> 
</table> 
</div> </section> 
</div> 

<?php }else{ ?>
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">No Series Created Yet</h3> </section></div>
<?php }?>



<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>

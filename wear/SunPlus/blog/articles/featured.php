
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"> 

<div class="space4"></div>
<div class="space4"></div> 
  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php  }?>


<?php $nonce = create_csrf(); ?>

 <section class="wrapper padding4"> 
 

<?php $categories = get_article_categories(); ?>
<?php $series = get_all_series(); ?>

<?php if(!empty($articles)){ ?>
<div class="col-lg-12">
<div class="tab-pane" id="datatable"> <section class="table-list"> 



<div class="table-responsive"> 

<table class="table table-striped m-b-none" data-ride="datatables"> 
<thead> 
<tr> 
<th width="15%">Article Image
</th>
<th width="15%">Title
</th>
<th width="15%">Author
</th>  
<th width="15%">Section
</th> 
<th width="15%">Series
</th> 
<th width="10%">Type
</th>
<th width="15%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($articles as $articlet) {
 $article = get_featured_by_id($articlet->article_id,$articlet->type);
?>
<?php  if(!empty($article)){?>
<tr>
<td>

<?php if(!empty($article->article_image)){?>
<img   class="img-responsive" width="160px" height="140px" src="<?php echo htmlentities(BASE_URL);?>assets/articles/<?php echo htmlentities($article->article_image)?>"></td>
<div class="space2"></div>
  <?php }else{?>
<img   class="img-responsive" width="160px" height="140px" src="<?php echo htmlentities(BASE_URL);?>assets/default/article_image.jpg">
  <?php }?>
</td>
  <td><?php echo htmlentities($article->title);?></td>
    <td><?php echo htmlentities($article->author);?></td>
    <td><?php if($article->category_id != 0){
    	echo htmlentities(get_section_name_by_id($article->category_id));
    	}else{
    	echo htmlentities("You Must Set Category For Article To Show");}?></td>
    	<td><?php if($article->series_id != 0){
    	echo htmlentities(get_series_name_by_id($article->series_id));
    	}else{
    	echo htmlentities("Article Is Not Part Of Any Series");}?></td>
  <td><?php echo htmlentities($articlet->type);?></td>


  <td>
  <a class="btn  btn-sm btn-danger" href="<?php echo htmlentities(BASE_URL);?>blog/deleteArticleFeatured/<?php echo htmlentities($articlet->id);?>">
  <i class="icon-trash icon-2x"  data-title="Delete Article" data-placement="bottom" data-toggle="tooltip"></i></a>
 


  </td>


</tr>

<?php } ?>


  </div>
<?php } ?>


</tbody> 
</table> 
</div> </section> 
</div> 

<?php }else{ ?>
              <div class="col-lg-12"><section class="panel"> <h2 class="padding3 lato-light">No Featured Articles</h2> </section></div>
<?php }?>



<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>

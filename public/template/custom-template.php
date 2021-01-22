<?php
/**
 * Template Name: Form
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<?php


get_header();
?>
<center>
<?php


?>
<div class="container register">
				<div class="row">
					<div class="col-md-3 register-left">
					</div>
					<div class="col-md-9 register-right">
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<h3 class="register-heading">Info Form</h3>
								<form action="" method="POST">
								<input type="hidden" name="datanonce" value="<?php echo esc_attr( wp_create_nonce() ); ?>">
								<div class="row register-form">
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="title" name="title" placeholder="Title *" value="" required/>
										</div>
										<div class="form-group">
											<input type="text" class="form-control" name="content" placeholder="Content *" value="" required/>
										</div>
										<div class="form-group">
											<input type="text" class="form-control" name="price" id="price" placeholder="Price." value="" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="sku" name="sku" placeholder="SKU." value=""/>
										</div>
										<div class="form-group">


		<input type="text" placeholder="Review" name="review" id="review" class="review"><br>


<input type="submit" class="btnRegister" name="addinfo"  value="Add Info."/>
									</div>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>

			</div>
</center>


<?php
get_footer();

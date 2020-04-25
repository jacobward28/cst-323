

<!-- Ensures that the one looking at the page is an administrator -->
@extends('layouts.appmaster')
@section('title','products')

<!-- Imports needed for the included Jquery table to work properly -->
@section('imports')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="public/css/table.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
@endsection

@section('style')
<style>
    .formLabel{
        color:black;
    }
    .form-control{
        width:60%;
    }
    #ModalLabel{
        color:black;
    }
    #products_info{
        color:white !important;
        margin-left:7.5%;
    }
    #products_paginate{
        margin-right:7.5%;
    }
</style>
@endsection

@section('content')

<!-- Prints out any errors if there are any after an admin has attempted to edit a product -->
@if($errors->count() != 0)
	@foreach($errors->all() as $error)
		<div class="alert alert-danger" role="alert" style="width:20%;">{{$error}}</div><br>
	@endforeach
@endif

<!-- Data table using jquery for managaing product -->
<table id="products" class="table table-striped table-bordered" style="width:85%;">
	<thead>
		<tr>
<!-- 			All the column names for the table -->
			<th scope="col">ID</th>
			<th scope="col">Product Name</th>
			<th scope="col">Price</th>
			<th scope="col">Quantity</th>
			<th scope="col">Description</th>
			
		</tr>
	</thead>
	<tbody>
<!-- 		Iterates over each user returned with this page -->
		@foreach($results as $product)
			<tr>
<!-- 				Iterates over each value for that specific user to allow administrators to view all of a product's information -->
				@foreach($product as $value)
					<td>{{$value}}</td>
				@endforeach
<!-- 				Bootstrap modal for editing products -->
				<div class="modal fade" id="editModal{{$product['IDPRODUCT']}}" tabindex="-1" role="dialog" aria-labelledby="{{$product['IDPRODUCT']}}eLabel" aria-hidden="true">
  					<div class="modal-dialog" role="document">
  						<div class="modal-content">
      						<div class="modal-header">
        						<h5 class="modal-title" id="ModalLabel">Edit product</h5>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          							<span aria-hidden="true">&times;</span>
        						</button>
      						</div>
      						<div class="modal-body">
<!--       							Form contained within the modal for the actual editing of the products -->
        						<form id="edit{{$product['IDPRODUCT']}}" action="ProductEditHandler" method="post"></form>
        							<div class="form-group">
        								<input form="edit{{$product['IDPRODUCT']}}" type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
        								<input form="edit{{$product['IDPRODUCT']}}" type="hidden" name="id" value="{{$product['IDPRODUCT']}}">
        								<label class="formLabel" for="title">Product Name: </label>
										<input form="edit{{$product['IDPRODUCT']}}" type="text" class="form-control" id="name" value="{{$product['PRODUCT_NAME']}}" name="name"><br>
										<label class="formLabel" for="company">Price: </label>
										<input form="edit{{$product['IDPRODUCT']}}" type="text" class="form-control" id="price" value="{{$product['PRICE']}}" name="price"><br>
										<label class="formLabel" for="state">Quantity: </label>
										<input form="edit{{$product['IDPRODUCT']}}" type="text" class="form-control" id="quantity" value="{{$product['QUANTITY']}}" name="quantity"><br>
										<label class="formLabel" for="description">Description: </label>
										<input form="edit{{$product['IDPRODUCT']}}" type="text" class="form-control" id="description" value="{{$product['DESCRIPTION']}}" name="description"><br>
									</div>
      						</div>
      						<div class="modal-footer">
<!--       							Button to close product edit modal -->
        						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--         						Button to submit changes made to product to the admin controller -->
        						<button form="edit{{$product['IDPRODUCT']}}" type="submit" class="btn btn-primary">Save changes</button>
      						</div>
    					</div>
  					</div>
				</div>
<!-- 				Button to open product edit modal -->
				
<!-- 				Delete confirmation modal -->
				<div class="modal fade" id="deleteModal{{$product['IDPRODUCT']}}" tabindex="-1" role="dialog" aria-labelledby="{{$product['IDPRODUCT']}}dLabel" aria-hidden="true">
  					<div class="modal-dialog" role="document">
    					<div class="modal-content">
      						<div class="modal-header">
        						<h5 class="modal-title" id="ModalLabel">Warning!</h5>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          							<span aria-hidden="true">&times;</span>
        						</button>
      						</div>
      						<div class="modal-body" id="ModalLabel">
      							<p>
      							Are you sure that you want to delete this product?
      							</p>
<!--       							Form containing hidden inputs containing necessary information -->
        						<form id="delete{{$product['IDPRODUCT']}}" action="ProductRemoveHandler" method="post"></form>
								<input form="delete{{$product['IDPRODUCT']}}" type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
								<input form="delete{{$product['IDPRODUCT']}}" type="hidden" name="id" value="{{$product['IDPRODUCT']}}"/>
      						</div>
      						<div class="modal-footer">
<!--       							Button to close the modal -->
        						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
<!--         						Button that submits delete form -->
       	 						<button form="delete{{$product['IDPRODUCT']}}" type="submit" class="btn btn-primary">Delete</button>
      						</div>
    					</div>
  					</div>
				</div>
			</tr>
		@endforeach
	</tbody>
</table>

<!-- Script from dataable to enable jquery functionality -->
<script>
	$(document).ready( function () {
  		$('#products').DataTable();
	} );
</script>
@endsection
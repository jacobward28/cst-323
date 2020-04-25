@extends('layouts.appmaster')
@section('title','New Product')



@section('content')
		<!-- form to capture user registration input and send it to the propoer route to lead to the controller -->
		<form action="newProductHandler" method="post">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
			<div class="form-group">
				<label for="name">Product Name: </label>
				<input type="text" class="form-control" id="name" style="width:20%;" name="name"/><br>
				@if($errors->first('name') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('name')}}</div>
				@endif
			</div>
			<div class="form-group">
				<label for="price">Price: </label>
				<input type="text" class="form-control" id="price" style="width:20%;" name="price"/><br>
				@if($errors->first('price') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('price')}}</div>
				@endif
			</div>
			<div class="form-group">
				<label for="quantity">Quantity: </label>
				<input type="text" class="form-control" id="quantity" style="width:20%;" name="quantity"/><br>
				@if($errors->first('quantity') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('quantity')}}</div>
				@endif
			</div>
			<div class="form-group">
				<label for="description">Description: </label>
				<textarea class="form-control" id="description" rows="5" style="width:40%;" name="description"/></textarea><br>
				@if($errors->first('description') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('description')}}</div>
				@endif
			</div>
			<button type="submit" class="btn btn-primary">Add new Product</button>
		</form>
@endsection
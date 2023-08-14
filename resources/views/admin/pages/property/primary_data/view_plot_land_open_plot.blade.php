<div class="row plot-land-open-plot plot-land-fields-child">
		
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Plot Name </label>
				<input disabled value="{{$property->plot_name ?? ''}}"  type="text" name="plot_name" class="form-control" id="">
			</div>
		</div>
		
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Plot No</label>
				<input disabled value="{{$property->plot_no ?? ''}}"  type="text" name="plot_no" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Street Name/No/Road No</label>
				<input disabled value="{{$property->street_details ?? ''}}"  type="text" name="street_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Colony/Locality Name</label>
				<input disabled value="{{$property->locality_name ?? ''}}"  type="text" name="locality_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Owner Full Name </label>
				<input disabled value="{{$property->owner_name ?? ''}}"  type="text" name="owner_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Contact No</label>
				<input disabled value="{{$property->contact_no ?? ''}}"  type="text" name="contact_no" class="form-control" id="">
			</div>
		</div>

	</div>
	<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				@if($property->boundary_wall_availability == 1)
				<span class="mdi mdi-decagram text-success"></span>
				<label class="form-check-label" >
					Boundary Wall/Fencing available
				</label>
				@endif
					
			</div>
		</div>

		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
			    @if($property->any_legal_litigation_board == 1)
				<span class="mdi mdi-decagram text-success"></span>
				<label class="form-check-label" >
					Any Legal Litigation board
				</label>
				@endif
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
			    @if($property->ownership_claim_board == 1)
				<span class="mdi mdi-decagram text-success"></span>
				<label class="form-check-label" >
					Ownership claim board
				</label>
				@endif
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
			    @if($property->bank_auction_board == 1)
				<span class="mdi mdi-decagram text-success"></span>
				<label class="form-check-label" >
					Bank auction board
				</label>
				@endif
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
			    @if($property->for_sale_board == 1)
				<span class="mdi mdi-decagram text-success"></span>
				
				<!--<input disabled @if($property->for_sale_board == 1) checked @endif class="form-check-input"  name="for_sale_board" value="1" type="checkbox" value="" >-->
				<label class="form-check-label" >
					For Sale/Lease Board
				</label>
				@endif
			</div>
		</div>
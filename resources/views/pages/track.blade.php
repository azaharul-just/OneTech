@extends('layouts.app')
@section('content')

    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 "  style="border: 1px solid grey; padding: 20px;">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center">
                            <h4>Your Order Status</h4>
                    	</div> <br>

					      <div class="progress">

					      	@if($track->status == 0 )
 										  <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div><br>
 									{{-- 	  <small class="text-danger"><b>Your Order are under review <b></small> --}}
					      	@elseif($track->status == 1)
					      				  <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>

					      				   <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>

					      				 {{--   <small class="text-success"><b>Payment Accept Under Processing<b></small> --}}
					      	@elseif($track->status == 2)
					      	        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>

					      		   <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>

					      		   <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
					      		    {{--  <small class="text-success"><b>Packing Done Handover Progress<b></small> --}}
					      	@elseif($track->status == 3)
                                     <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>


							       <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>


							       <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>

							        <div class="progress-bar bg-success" role="progressbar" style="width: 35%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
					      	@else
					      	    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div><br>
					      	@endif
					      </div>

					 </div>

				
					     @if($track->status == 0)
					     <h6>Note: <b>Payment Accept Under Processing<b>    </h6>
					     @elseif($track->status == 1)
					      <h6>Note: <b>Payment Accept Under Processing<b>    </h6>
					     @elseif($track->status == 2)
					      <h6>Note: <b>Packing Done Handover Progress<b>    </h6>
					     @elseif($track->status == 3)
					      <h6>Note: <b>Successfully Delevered Your Order<b>    </h6>
					     	@else
					     <h6>Note: <b>Order Cancel<b>    </h6>
					      	@endif
					     
					 <br><hr>
					  <div class="col-lg-12">
		                    <div class="contact_form_container">
		                        <div class="contact_form_title text-center">Your Order Details</div> <br>

		                        <table class="table">
		                        	<tr>
		                        		<th>PaymentType :</th>
		                        		<td>{{ $track->payment_type }}</td>
		                        	</tr>
		                        	<tr>
		                        		<th>Transection ID :</th>
		                        		<td>{{ $track->payment_id }}</td>
		                        	</tr>
		                        	<tr>
		                        		<th>Balance  ID :</th>
		                        		<td>{{ $track->blnc_transection }}</td>
		                        	</tr>
		                        	<tr>
		                        		<th>Subtotal :</th>
		                        		<td>{{ $track->subtotal }}</td>
		                        	</tr>
		                        	<tr>
		                        		<th>Shipping :</th>
		                        		<td>{{ $track->shipping }}</td>
		                        	</tr>
		                        	<tr>
		                        		<th>Total :</th>
		                        		<td>{{ $track->total }}</td>
		                        	</tr>
		                        	<tr>
		                        		<th>Date :</th>
		                        		<td>{{ $track->date }}</td>
		                        	</tr>
		                        </table> 
							 </div>
					</div>


				</div>
			</div>
		</div>

@endsection
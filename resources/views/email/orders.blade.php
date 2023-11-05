<style>
	.btn {
		background-color: #4CAF50; /* Green */
		border: none;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		cursor: pointer;
	}
	.btn:hover {
		background-color: #3e8e41;
	}
	.btn:active {
		background-color: #3e8e41;
		box-shadow: 0 5px #666;
		transform: translateY(4px);
	}
</style>

<h2>Thanks for your purchase!</h2>
<h4>Your Order Details: </h4>
@foreach($transaction->stock as $stock)
	{!! $stock->content !!}
@endforeach
<h4>Please, write your review here:</h4>
<a href="{{ route('review.write', $transaction->review_code) }}" class="btn btn-primary">Write Review</a>

<h2>Thanks for your purchase!</h2>
<h4>Your Order Details: </h4>
{!! $transaction->stock !!}
<h4>Please, write your review here:</h4>
<a href="{{ route('review.write', $transaction->review_code) }}">{{ route('review.write', $transaction->review_code) }}</a>



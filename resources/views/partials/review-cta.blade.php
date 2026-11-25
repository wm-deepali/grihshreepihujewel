@switch($reviewState)
  @case('can')
    <button type="button" class="btn {{ $btnClass ?? 'btn-white' }}" data-model=".review-pop">Write a Review</button>
    @break

  @case('guest')
    <a href="{{ route('user.login') }}" class="btn {{ $btnClass ?? 'btn-white' }}">Login to Write a Review</a>
    @break

  @case('reviewed')
    <p style="margin:0">Thank you, you have already reviewed this product.</p>
    @break

  @default
    <p style="margin:0">Only customers who have received this product can review it.</p>
@endswitch
<article class="story_card">
  <a href="{{ url('blog-detail') }}" class="sc-img">
    <img src="{{ asset('assets/images/home/' . $s['img']) }}" alt="{{ $s['alt'] }}" loading="lazy" />
    <span class="sc-brand">{{ $s['brand'] }}</span>
  </a>
  <div class="sc-body">
    <span class="sc-cat">{{ $s['cat'] }}</span>
    <h4><a href="{{ url('blog-detail') }}">{{ $s['title'] }}</a></h4>
    <p>{{ $s['text'] }}</p>
    <div class="sc-foot">
      <span class="sc-date">
        <i class="fa-regular fa-calendar" aria-hidden="true"></i><time datetime="YYYY-MM-DD">DD Mon YYYY</time>
      </span>
      <a href="{{ url('blog-detail') }}" class="sc-link">Read More <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></a>
    </div>
  </div>
</article>
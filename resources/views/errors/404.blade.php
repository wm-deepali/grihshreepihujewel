@extends('layouts.app')

@section('title', '404 Error | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/other/other.css') }}" />
@endpush

@section('content')
  <section class="lost-secA">
    <div class="container">
      <div class="ls-card">
        <div class="ls-text">
          <span class="ls-status">Page Not Found</span>
          <h1>This page has wandered off</h1>
          <p class="ls-msg">
            The link may be old or the page may have moved. Head back home or pick up where you left off in our collection.
          </p>
          <div class="ls-btns">
            <a href="{{ url('/') }}" class="btn btn-primary">
              <i class="fa-solid fa-house" aria-hidden="true"></i> Back to Home
            </a>
            <a href="{{ url('products') }}" class="btn btn-outline-primary">
              <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i> Shop Now
            </a>
          </div>
        </div>
        <div class="ls-art">
          <div class="ls-ring">
            <span class="ls-code" aria-hidden="true">404</span>
          </div>
          <p class="ls-title">Try these instead</p>
          <ul class="ls-links">
            @foreach([
              ['fa-solid fa-gem', 'Necklace Sets'],
              ['fa-regular fa-gem', 'Earrings'],
              ['fa-solid fa-bed', 'Bedding'],
              ['fa-solid fa-fire-flame-simple', 'Home Decor'],
            ] as [$icon, $label])
              <li>
                <a href="{{ url('products') }}"><i class="{{ $icon }}" aria-hidden="true"></i> {{ $label }}</a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </section>
@endsection
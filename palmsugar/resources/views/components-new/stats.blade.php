{{-- resources/views/components/stats.blade.php --}}
{{-- Static key stats — edit angka langsung di sini atau ambil dari config/settings --}}

<section id="stats" class="stats section light-background">
  <div class="container">
    <div class="row gy-4 justify-content-center text-center">

      <div class="col-6 col-md-3">
        <div class="stats-item">
          <span class="stats-number purecounter"
            data-purecounter-start="0"
            data-purecounter-end="740"
            data-purecounter-duration="2">0</span>
          <span class="stats-unit">MT</span>
          <p class="stats-label">Annual Production Capacity</p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="stats-item">
          <span class="stats-number purecounter"
            data-purecounter-start="0"
            data-purecounter-end="770"
            data-purecounter-duration="2">0</span>
          <span class="stats-unit">K+</span>
          <p class="stats-label">Coffee Plants Under Management</p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="stats-item">
          <span class="stats-number purecounter"
            data-purecounter-start="0"
            data-purecounter-end="4"
            data-purecounter-duration="1">0</span>
          <span class="stats-unit">+</span>
          <p class="stats-label">International Export Markets</p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="stats-item">
          <span class="stats-number">84</span>
          <span class="stats-unit">.25</span>
          <p class="stats-label">Arabica Cupping Score</p>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- Tambahkan style ini di main.css jika belum ada --}}
{{--
.stats { padding: 60px 0; }
.stats-item { padding: 20px; }
.stats-number {
  font-family: var(--heading-font);
  font-size: 3rem;
  font-weight: 700;
  color: var(--accent-color);
  line-height: 1;
}
.stats-unit {
  font-family: var(--heading-font);
  font-size: 1.5rem;
  color: var(--accent-color);
}
.stats-label {
  font-size: 0.9rem;
  color: color-mix(in srgb, var(--default-color), transparent 30%);
  margin-top: 8px;
  margin-bottom: 0;
}
--}}

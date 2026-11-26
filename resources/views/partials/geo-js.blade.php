<script>
  window.Geo = (function ($) {
    var CITY_URL = "{{ route('state.cities', '__ID__') }}";
    var cache = {};

    function esc(s) { return $('<div>').text(s).html(); }

    // cities of a state, cached per state id; always resolves with an array
    function load(sid) {
      var d = $.Deferred();
      if (!sid) return d.resolve([]).promise();
      if (cache[sid]) return d.resolve(cache[sid]).promise();

      $.ajax({ url: CITY_URL.replace('__ID__', sid), method: 'GET', dataType: 'json' })
        .done(function (rows) { cache[sid] = rows || []; d.resolve(cache[sid]); })
        .fail(function (xhr) {
          console.error('Cities request failed', xhr.status, CITY_URL.replace('__ID__', sid));
          d.resolve([]);
        });
      return d.promise();
    }

    // refresh custom select plugins if the theme uses any
    function refresh($el) {
      if ($.fn.niceSelect) $el.niceSelect('update');
      if ($.fn.select2 && $el.data('select2')) $el.trigger('change.select2');
      if ($.fn.selectpicker) $el.selectpicker('refresh');
    }

    // state <select> -> city <select>
    function bind($state, $city) {
      if (!$state.length || !$city.length) {
        console.warn('Geo.bind: state/city select not found');
        return;
      }

      function fill(cities, selected) {
        var html = '<option value="">Select city</option>';
        $.each(cities, function (_, c) {
          html += '<option value="' + c.id + '">' + esc(c.name) + '</option>';
        });
        $city.html(html).prop('disabled', !cities.length);
        if (selected) $city.val(String(selected));
        refresh($city);
      }

      function sync(selected) {
        var sid = $state.val();
        if (!sid) { fill([]); return; }
        $city.prop('disabled', true).html('<option value="">Loading…</option>');
        refresh($city);
        load(sid).done(function (cities) {
          if ($state.val() === sid) fill(cities, selected); // ignore stale responses
        });
      }

      $state.on('change', function () {
        var pending = $city.attr('data-pending');
        $city.removeAttr('data-pending');
        sync(pending || null);
      });

      sync($city.attr('data-selected')); // edit forms: load cities and keep the saved one
    }

    return { bind: bind, loadCities: load };
  })(jQuery);
</script>
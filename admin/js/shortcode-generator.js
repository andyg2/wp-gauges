jQuery(document).ready(function ($) {
  let previewGauge = null;

  function updatePreviewGauge() {
    const highlights = [];
    const ranges = ['green', 'yellow', 'orange', 'red'];
    const barColors = {
      'green': '0,255,0,.15',
      'yellow': '255,255,0,.15',
      'orange': '255,127,0,.15',
      'red': '255,0,0,.15'
    };

    ranges.forEach(function(range) {
      const start = $('#gauge-' + range + '-start').val() || $('#gauge-' + range + '-start').attr('placeholder');
      const end = $('#gauge-' + range + '-end').val() || $('#gauge-' + range + '-end').attr('placeholder');
      if (start && end) {
        highlights.push({
          from: parseFloat(start),
          to: parseFloat(end),
          color: 'rgba(' + barColors[range] + ')'
        });
      }
    });

    const options = {
      renderTo: 'preview-gauge',
      width: 300,
      height: 300,
      minValue: parseFloat($('#gauge-min').val() || $('#gauge-min').attr('placeholder')),
      maxValue: parseFloat($('#gauge-max').val() || $('#gauge-max').attr('placeholder')),
      value: parseFloat($('#gauge-initial').val() || $('#gauge-initial').attr('placeholder')),
      units: $('#gauge-units').val() || $('#gauge-units').attr('placeholder'),
      title: $('#gauge-title').val() || $('#gauge-title').attr('placeholder'),
      majorTicks: ($('#gauge-ticks').val() || $('#gauge-ticks').attr('placeholder')).split(' ').map(Number),
      animationRule: 'bounce',
      animationDuration: 750,
      animatedValue: true,
      colorBarProgress: 'rgba(50,200,50,.75)',
      highlights: highlights,
    };

    if (previewGauge) {
      previewGauge.destroy();
    }

    previewGauge = new RadialGauge(options).draw();
    
    const animateTo = parseFloat($('#gauge-animateto').val() || $('#gauge-animateto').attr('placeholder'));
    if (!isNaN(animateTo)) {
      previewGauge.value = animateTo;
    }
  }

  function generateShortcode() {
    var attributes = [];

    // Basic attributes
    var title = $('#gauge-title').val();
    if (title !== '') {
      attributes.push('title="' + title + '"');
    }else{
      attributes.push('title="Title"');
    }

    var units = $('#gauge-units').val();
    if (units !== '') {
      attributes.push('units="' + units + '"');
    }else{
      attributes.push('units="units"');
    }

    var titletag = $('#gauge-titletag').val();
    if (titletag !== '') {
      attributes.push('titletag="' + titletag + '"');
    }else{
      attributes.push('titletag="h2"');
    }

    var titlecol = $('#gauge-titlecol').val();
    if (titlecol !== '') {
      attributes.push('titlecol="' + titlecol + '"');
    }else{
      attributes.push('titlecol="black"');
    }

    var ticks = $('#gauge-ticks').val();
    if (ticks !== '') {
      attributes.push('ticks="' + ticks + '"');
    }else{
      attributes.push('ticks="0 2 4 6 8 10"');
    }

    // Numeric values
    var min = $('#gauge-min').val();
    if (min !== '') {
      attributes.push('min="' + min + '"');
    }else{
      attributes.push('min="0"');
    }

    var max = $('#gauge-max').val();
    if (max !== '') {
      attributes.push('max="' + max + '"');
    }else{
      attributes.push('max="10"');
    }

    var initial = $('#gauge-initial').val();
    if (initial !== '') {
      attributes.push('initial="' + initial + '"');
    }else{
      attributes.push('initial="0"');
    }

    var animateto = $('#gauge-animateto').val();
    if (animateto !== '') {
      attributes.push('animateto="' + animateto + '"');
    }else{
      attributes.push('animateto="5"');
    }

    // Color ranges
    var ranges = ['green', 'yellow', 'orange', 'red'];
    for (var i = 0; i < ranges.length; i++) {
      var range = ranges[i];
      var start = $('#gauge-' + range + '-start').val();
      var end = $('#gauge-' + range + '-end').val();
      if (start !== '' && end !== '') {
        attributes.push(range + '="' + start + ' ' + end + '"');
      }else{
        let i2 = i * 2.5;
        attributes.push(range + '="' + i2 + ' ' + (i2+2.5) + '"');
      }
    }

    // Generate the shortcode
    var shortcode = '[gauge' + (attributes.length ? ' ' + attributes.join(' ') : '') + ']';

    // Display the shortcode
    $('#shortcode-text').text(shortcode);
    $('#shortcode-output').show();
  }

  // Initialize preview gauge
  updatePreviewGauge();

  // Add input change handlers for live preview
  $('#gauge-shortcode-generator input, #gauge-shortcode-generator select').on('input change', function() {
    updatePreviewGauge();
  });

  // Generate shortcode button click handler
  $('#generate-shortcode').on('click', function (e) {
    e.preventDefault();
    generateShortcode();
  });

  // Copy to clipboard button click handler
  $('#copy-shortcode').on('click', function () {
    var shortcodeText = $('#shortcode-text').text();
    navigator.clipboard.writeText(shortcodeText).then(function () {
      var $button = $('#copy-shortcode');
      $button.text('Copied!');
      setTimeout(function () {
        $button.text('Copy to Clipboard');
      }, 2000);
    });
  });
});



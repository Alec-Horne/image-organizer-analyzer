$(function() {
  var $save = $('#savebtn');
  var $reset = $('#resetbtn');
  
  /* As soon as slider value changes call applyFilters */
  $('input[type=range]').change(applyFilters);

  function applyFilters() {
    var hue = parseInt($('#hue').val());
    var cntrst = parseInt($('#contrast').val());
    var vibr = parseInt($('#vibrance').val());
    var sep = parseInt($('#sepia').val());
	var gam = parseInt($('#gamma').val());
	var brght = parseInt($('#brightness').val());
	var sat = parseInt($('#saturation').val());
	var noise = parseInt($('#noise').val());
	var sharp = parseInt($('#sharpen').val());
	var clip = parseInt($('#clip').val());
	var expsre = parseInt($('#exposure').val());

    Caman('#canvas', function() {
      this.revert(false);
      this.hue(hue).contrast(cntrst).vibrance(vibr).sepia(sep).gamma(gam).saturation(sat)
	  .brightness(brght).noise(noise).sharpen(sharp).clip(clip).exposure(expsre).render();
    });
  }
  
  $reset.on('click', function(e) {
    $('input[type=range]').val(0);
    Caman('#canvas', img, function() {
      this.revert(false);
      this.render();
    });
  });
  
  $save.on('click', function(e) {
    Caman('#canvas', img, function() {
      this.render(function() {
        this.save('png');
      });
    });
  });
});
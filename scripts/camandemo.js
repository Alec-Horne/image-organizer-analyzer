$(function() {
  var canvas = document.getElementById('canvas');
  var ctx = canvas.getContext('2d');

  var $reset = $('#resetbtn');
  var $brightness = $('#brightnessbtn');
  var $noise = $('#noisebtn');
  var $sepia = $('#sepiabtn');
  var $contrast = $('#contrastbtn');
  var $color = $('#colorbtn');

  var $vintage = $('#vintagebtn');
  var $lomo = $('#lomobtn');
  var $emboss = $('#embossbtn');
  var $tiltshift = $('#tiltshiftbtn');
  var $radialblur = $('#radialblurbtn');
  var $edgeenhance = $('#edgeenhancebtn');

  var $posterize = $('#posterizebtn');
  var $clarity = $('#claritybtn');
  var $orangepeel = $('#orangepeelbtn');
  var $sincity = $('#sincitybtn');
  var $sunrise = $('#sunrisebtn');
  var $crossprocess = $('#crossprocessbtn');

  var $hazydays = $('#hazydaysbtn');
  var $love = $('#lovebtn');
  var $grungy = $('#grungybtn');
  var $jarques = $('#jarquesbtn');
  var $pinhole = $('#pinholebtn');
  var $oldboot = $('#oldbootbtn');
  var $glowingsun = $('#glowingsunbtn');

  var $hdr = $('#hdrbtn');
  var $oldpaper = $('#oldpaperbtn');
  var $pleasant = $('#pleasantbtn');

  var $save = $('#savebtn');

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

  /* Creating custom filters */
  Caman.Filter.register("oldpaper", function() {
    this.pinhole();
    this.noise(10);
    this.orangePeel();
    this.render();
  });

  Caman.Filter.register("pleasant", function() {
    this.colorize(60, 105, 218, 10);
    this.contrast(10);
    this.sunrise();
    this.hazyDays();
    this.render();
  });

  $reset.on('click', function(e) {
    $('input[type=range]').val(0);
    Caman('#canvas', function() {
      this.revert(false);
      this.render();
    });
  });

  /* In built filters */
  $brightness.on('click', function(e) {
    Caman('#canvas', function() {
      this.brightness(30).render();
    });
  });

  $noise.on('click', function(e) {
    Caman('#canvas', function() {
      this.noise(10).render();
    });
  });

  $contrast.on('click', function(e) {
    Caman('#canvas', function() {
      this.contrast(10).render();
    });
  });

  $sepia.on('click', function(e) {
    Caman('#canvas', function() {
      this.sepia(20).render();
    });
  });

  $color.on('click', function(e) {
    Caman('#canvas', function() {
      this.colorize(60, 105, 218, 10).render();
    });
  });

  $vintage.on('click', function(e) {
    Caman('#canvas', function() {
      this.vintage().render();
    });
  });

  $lomo.on('click', function(e) {
    Caman('#canvas', function() {
      this.lomo().render();
    });
  });

  $emboss.on('click', function(e) {
    Caman('#canvas', function() {
      this.emboss().render();
    });
  });

  $tiltshift.on('click', function(e) {
    Caman('#canvas', function() {
      this.tiltShift({
        angle: 90,
        focusWidth: 600
      }).render();
    });
  });

  $radialblur.on('click', function(e) {
    Caman('#canvas', function() {
      this.radialBlur().render();
    });
  });

  $edgeenhance.on('click', function(e) {
    Caman('#canvas', function() {
      this.edgeEnhance().render();
    });
  });

  $posterize.on('click', function(e) {
    Caman('#canvas', function() {
      this.posterize(8, 8).render();
    });
  });

  $clarity.on('click', function(e) {
    Caman('#canvas', function() {
      this.clarity().render();
    });
  });

  $orangepeel.on('click', function(e) {
    Caman('#canvas', function() {
      this.orangePeel().render();
    });
  });

  $sincity.on('click', function(e) {
    Caman('#canvas', function() {
      this.sinCity().render();
    });
  });

  $sunrise.on('click', function(e) {
    Caman('#canvas', function() {
      this.sunrise().render();
    });
  });

  $crossprocess.on('click', function(e) {
    Caman('#canvas', function() {
      this.crossProcess().render();
    });
  });

  $love.on('click', function(e) {
    Caman('#canvas', function() {
      this.love().render();
    });
  });

  $grungy.on('click', function(e) {
    Caman('#canvas', function() {
      this.grungy().render();
    });
  });

  $jarques.on('click', function(e) {
    Caman('#canvas', function() {
      this.jarques().render();
    });
  });

  $pinhole.on('click', function(e) {
    Caman('#canvas', function() {
      this.pinhole().render();
    });
  });

  $oldboot.on('click', function(e) {
    Caman('#canvas', function() {
      this.oldBoot().render();
    });
  });

  $glowingsun.on('click', function(e) {
    Caman('#canvas', function() {
      this.glowingSun().render();
    });
  });

  $hazydays.on('click', function(e) {
    Caman('#canvas', function() {
      this.hazyDays().render();
    });
  });

  /* Calling multiple filters inside same function */
  $hdr.on('click', function(e) {
    Caman('#canvas', function() {
      this.contrast(10);
      this.contrast(10);
      this.jarques();
      this.render();
    });
  });

  /* Custom filters that we created */
  $oldpaper.on('click', function(e) {
    Caman('#canvas', function() {
      this.oldpaper();
      this.render();
    });
  });

  $pleasant.on('click', function(e) {
    Caman('#canvas', function() {
      this.pleasant();
      this.render();
    });
  });

  /* You can also save it as a jpg image, extension need to be added later after saving image. */

  $save.on('click', function(e) {
    Caman('#canvas', function() {
      this.render(function() {
        this.save('png');
      });
    });
  });
});
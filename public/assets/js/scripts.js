$("#flipbook").turn({
    width: 800,
    height: 600,
    autoCenter: true
});


//taille des pages du menu
function resizePages() {
    var pageWrappers = document.querySelectorAll('#flipbook .page-wrapper');
    for (var i = 0; i < pageWrappers.length; i++) {
      var pageWrapper = pageWrappers[i];
      pageWrapper.classList.add ('large-page');
    }
  }

  window.addEventListener('load', function() {
    resizePages();
  });
  
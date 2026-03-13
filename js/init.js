"use strict";

!(function (t) {
  if (!document.getElementById(t)) {
    var n = document.createElement('div');
    n.id = t;
    document.body.appendChild(n);
  }
})('nuvidio-widget');

!(function (t) {
  if (!document.getElementById(t)) {
    var n = document.createElement('div');
    n.id = t;
    var i = document.getElementById('nuvidio-widget');
    i.appendChild(n);
  }
})('nuvidio-widget-container');

(function(window) {
  if (window.NuVidioWidget) {
    return
  }
  window.NuVidioWidget = {};
  window.NuVidioWidget._c = []
  const methods = ['init'];
  methods.forEach(methodName => {
    window.NuVidioWidget[methodName] = function() {
      window.NuVidioWidget._c.push([methodName, arguments]);
    }
  });
})(window);

!(function (t, e, r) {
  if (!document.getElementById(t)) {
    var n = document.createElement('script');
    for (var a in ((n.src =
      'https://widget.nuvidio.com/js/nuvidio-widget.min.js'),
    (n.type = 'text/javascript'),
    (n.id = t),
    (n.async = true),
    r))
    n.onload = (() => {
      if (window.NuVidioWidget._c.length > 0) {
        window.NuVidioWidget._c.forEach((f) => {
          switch(f[0]) {
            case 'init':
              window.NuVidio.init(...f[1]);
              break;
          }
        });
      } else {
        if (window.NuVidio && window.NuVidioId) {
          window.NuVidio.init(window.NuVidioId, window.NuVidioConfigs);
        }
      }
      window.NuVidioWidget.init = window.NuVidio.init;
    });
    r.hasOwnProperty(a) && n.setAttribute(a, r[a]);
    var i = document.getElementById('nuvidio-widget');
    i.appendChild(n);
  }
})('nuvidio-widget-script', 0, {
  crossorigin: 'anonymous',
});
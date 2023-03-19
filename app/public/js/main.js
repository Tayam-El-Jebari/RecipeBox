    const params = window.location.pathname.split("/");

    function setStyle(foldername, styleName) {
      var style = document.createElement('link');
      style.setAttribute("rel", "stylesheet");
      style.setAttribute("type", "text/css");
      if (styleName != "") {
        style.setAttribute("href", "/css/" + foldername + "/" + styleName + ".css");
      } else {
        style.setAttribute("href", "/css/home.css");
      }
      document.head.appendChild(style);
    }
    setStyle(params[1], params[1]);
    if (params[2] != "") {
      setStyle(params[1], "detailPage")
    }
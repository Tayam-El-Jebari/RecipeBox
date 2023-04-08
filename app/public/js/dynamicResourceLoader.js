document.addEventListener('DOMContentLoaded', async function () {
function setScript(foldername, scriptname) {
  return new Promise((resolve) => {
    const script = document.createElement("script");
    script.setAttribute("type", "text/javascript");
    script.setAttribute("src", "../../js/" + foldername + "/" + scriptname + ".js");
    script.onload = () => {
      resolve();
    };
    document.body.appendChild(script);
  });}

  function shouldLoadNutritionalLoader() {
    const url = window.location.href;
    return url.match(/^(http:\/\/|https:\/\/)[\w-]+(\.[\w-]+)*\/products\?id=\d+$/);
  }

  //done only because the product detail page doesn't need the products.js to function
  if (shouldLoadNutritionalLoader()) {
    setScript("products", "productsNutritionalLoader");
  }else {
      //added await so scripts that require other scripts load in the correct order 
    await setScript(params[1], params[1]);

  }

 //added for if you want a second js on a detail page for example
if (params[2] != null) {
    await setScript(params[1], params[2]);
  }

  


});
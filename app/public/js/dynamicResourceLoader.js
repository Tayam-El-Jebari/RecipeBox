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

  //added await so scripts that require other scripts load in the correct order 
  await setScript(params[1], params[1]);
  if (params[2] != null) {
    setStyle(params[1], "detailPage");
    setStyle(params[1], params[2]);
    await setScript(params[1], params[2]);
  }
});
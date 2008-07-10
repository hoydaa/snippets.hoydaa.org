function toogle(target_id, up_id, down_id)
{
  var target = document.getElementById(target_id);
  var up = document.getElementById(up_id);
  var down = document.getElementById(down_id);

  if (up.style.display != "none")
  {
    Effect.BlindUp(target);
    up.style.display = "none";
    down.style.display = "inline";
  }
  else
  {
    Effect.BlindDown(target);
    down.style.display = "none";
    up.style.display = "inline";
  }
}
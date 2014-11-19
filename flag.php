<!DOCTYPE html>
<html>
<body>

<p>Hi, Use this script.</p>

<button onclick="flag()">Click me</button>

<script>
function myReason()
{
var x;

var reason=prompt("Please enter the reason for flagging that device","Defective");

if (reason!=null)
  {
  x="The device has been flaged for being " + reason + "!";
  alert(x);
  }
}

function flag()
{
var x;
var r=confirm("Flagging a device means that you have declared it as un useful!\nDo you wish to continue?");
if (r==true)
  {
  myReason();
  }
}
</script>

</body>
</html>



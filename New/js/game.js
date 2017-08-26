var ypos;
var xpos;
var gameOn;
var up;
var down;
var pitch;
var speed;
var airplaneLength;
var resumeDistance;
function initalize()
{
  ypos = 200;
  xpos = 0;
  gameOn=true;
  up = false;
  down = false;
  pitch = 0;
  speed = 15;
  airplaneLength = 100;
  $('#scenery').css("left", -(xpos-100));
  $('#airplane').css("transform", "scaleX(-1) rotate("+pitch*9+"deg) ");
  $('#airplane').css("bottom", ypos);
  $('#mobileControlLeft').click(function(){
    down = false;
    up = true; 
    setTimeout(function(){up =false}, 100);
  });
  $('#mobileControlRight').click(function(){
      up = false;
      down = true;
      setTimeout(function(){down =false}, 100);
  });
}
function game(){
    moveScenery();
    airPlane();
}

//---------------------Scenery--------------------------//
function moveScenery(){
  if(gameOn)
  {
     xpos +=  (speed*Math.cos(pitch*.15708));
    
    $('#scenery').animate({
      left: -(xpos-100),
      }, 
      20,
      function(){
      moveScenery();
    });
  }
}
//----------------------airPlane------------------------//
 
//-------keyboard controls ----------//
  
$(document).keydown(function(e) {
    
    switch(e.which) {
        case 37: // up
              up = true;
        break;
        case 39://down
              down = true;
        default: return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
});

// keyup handler
$(document).keyup(function(e){
    switch(e.which) {
        case 37: // up
              up = false;
        break;
        case 39://down
              down = false;
        default: return; // exit this handler for other keys
    }
});
//---------Mobile controls ---------//



function airPlane(){
  hitGround();
  hitMountain();
  hitResume();
  autoCrash();
  if(gameOn)
  {
    if(speed < 0)
    {
      pitch = -90;
      ypos --;
    }
    if(up)
    {
      pitch += speed/30; 
    }
    else if(down)
    {
       pitch -= speed/30;
    }

    speed -= (Math.sin(pitch*.15708))/3;
    ypos += (speed*Math.sin(pitch*.15708));
    $('#airplane').css("transform", "scaleX(-1) rotate("+pitch*9+"deg) ");
    $('#airplane').animate({
      bottom: ypos,
      }, 
      1,
      function(){
      airPlane();
    }); 
  }
  else//game is over
  {
    gameOn=false;
  }
}
function hitGround()
{
  if(ypos < -17)
  {
    endGame("lost");
    gameOn=false;
  }
}
function hitMountain()
{ 
  for(var i =0; i < mountains.length; i++)
  {
    if((xpos + airplaneLength) > (ypos/2+mountains[i].distance) && ypos < (mountains[i].size*.8) && xpos+airplaneLength < ( mountains[i].size + mountains[i].distance - ypos/2))
    {
      endGame(mountains[i].id);
      gameOn=false;
    }
  }

}
function hitResume()
{
  if(xpos>resumeDistance && xpos < resumeDistance +100 && ypos<60 )
  {
      endGame("resume");
      gameOn=false;
  }
}
function autoCrash()
{
  if(xpos>resumeDistance+100)
  {
    pitch = -1;
  }
}
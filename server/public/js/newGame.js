//Input
//-Start
//-DivToBindTo
//-projects and function calls to be executed on hit
//-resume and function calls to be executed on hit
//-crash handler function calls 
//Output
//entire gui
class Game {
	constructor(divToBindTo, isMobile)
	{
		this.distance = 600;
		this.frameRate = 30;
		this.divToBindTo = divToBindTo;
		var parent = this;
		this.controls = new Controls(divToBindTo, parent, isMobile);
		this.airplane = new AirPlane(divToBindTo, this.controls);
		this.hitboxes = new HitBoxes(this.airplane.getLength()); //must be after airplane creation
		this.scenery = new Scenery(divToBindTo);
		if(isMobile){
			this.scenery.addBackground('<img src="img/tilt.svg" style="width:200px; position:absolute; bottom:0px; left:0px;">');
		}
		else{
			this.scenery.addBackground('<img src="img/arrows.png" style="width:200px; position:absolute; bottom:0px; left:100px;">');
		}
		
		this.running =false;
		
	}
	addProject(project, hitFunction){
		var mountain = new Mountain(this.scenery.div(), project, hitFunction);
		mountain.render();
		this.distance += mountain.newDistance(this.distance);
		this.hitboxes.addHitBox(mountain);
	}
	createTrashcan(hitFunction){
		var trashcan = new trashcan(Scenery.div(), hitFunction);
		this.distance += trashcan.newDistance(distance);
		this.hitboxes.addHitBox(trashcan);
	}
	render(){
		this.airplane.render();
		this.scenery.render(this.airplane.getX());
	}

	start(){
		this.running=true;

		var self = this;
		function both(){
			self.run();
			self.render();
		}
		this.loop = setInterval(both,1);
	}
	stop(){
		this.running =false;
		clearInterval(this.loop);
		this.controls.reset();
		this.airplane.initiateStartValues();
		this.render();
	}
	delayedStop(){
		this.running =false;
		clearInterval(this.loop);
		var self = this;
		setTimeout(function(){
			self.controls.reset();
			self.airplane.initiateStartValues();
			self.render();
		}, 1000);	
	}
	run(){
		this.airplane.reCalculate();
		if(this.hitboxes.checkHitBoxes(this.airplane.getX(), this.airplane.getY())){
			this.delayedStop();
		}
		if(this.airplane.getY() < -17){
			this.stop();
		}
		if(this.airplane.getX() < this.distance){
			//this.airplane.crash();
		}
	}
}
//Input
//-Controls
//Output
//-image rotation
//-image position
//output of its position
class AirPlane {
	constructor(divToBindTo, controller){
		this.controller = controller;
		this.divToBindTo = divToBindTo;
		this.initiateStartValues();
		$('#'+this.divToBindTo).append('<img id ="airplane" style="left:100px;" src="img/airplane.png">');
	}
	initiateStartValues(){
		this.planeLength = 100;
		this.pitch = 0;
		this.speed = 3;
		this.y=200;
		this.x=0; 
		this.oldPitch;
	}
	speedUp(){
		this.speed++;
	}
	crash(){
		while(this.speed > 0){
			this.speed -= .5;
		}
	}
	reCalculate(){
		this.oldPitch = this.pitch;
		var temp = .005/Math.abs(this.speed);
		if(temp > 90){
			temp = 90;
		}
		this.pitch -= temp;
		if(this.controller.Up()){
			this.pitch += this.speed/25; 
		}
		if(this.controller.Down()){
			this.pitch -= this.speed/25;
		}
		this.speed -= (Math.sin(this.pitch*.15708))/80;
    	this.y += (this.speed*Math.sin(this.pitch*.15708));
    	this.x += (this.speed*Math.cos(this.pitch*.15708));
	}
	render(){
	    $({deg: this.oldPitch*9}).animate({deg: this.pitch*9}, {
	        duration: 10,
	        step: function(now){
	            $('#airplane').css({
	                 transform: "scaleX(-1) rotate(" + now + "deg)"
	            });
	        }
	    });
	    $('#airplane').css("bottom", this.y); 
	}
	getLength(){
		return this.planeLength;
	}
	getX(){
		return this.x;
	}
	getY(){
		return this.y;
	}
}
//Input:
//-Line of project info 
//-Divtobindto
//-Distance from left
//Output
//-Actual Mountain with hit box
//-Distance it added to the total distance 
//-Link to project
function makeid() {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

  for (var i = 0; i < 5; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}
class Mountain {
	constructor(divToBindTo, project,hitFunction){
		this.divToBindTo = divToBindTo;
		this.hitFunction = hitFunction;
		this.project = project;
		this.div=makeid();
	}
	render(){
		var text="";
		this.mountainWidth = this.project.importance*50 + 100;
		text += `<img id="mountainImg${this.div}" src="img/mountains.png" style=" z-index:2;height: ${this.mountainWidth}px; width:${this.mountainWidth}px;  position:absolute; bottom:0px;" >`;
		text += `<div id="mountainText${this.div}" style="z-index:3;position:absolute;  bottom:0px; width: ${this.mountainWidth}px; text-align:center;"><h3 style="color:white;"> ${this.project.name} </h3></div>`;
		$("#" + this.divToBindTo).append(text);
	}
	newDistance(distance){
		this.distance = distance;
		$("#mountainImg" + this.div).css( "left", `${distance}px`);
		$("#mountainText" + this.div).css( "left", `${distance}px`);
		return this.mountainWidth+Math.random()*500;
	}
	isHit(x,y,airplaneLength){
		if((x + airplaneLength) > (y/2+this.distance) && y < (this.mountainWidth*.8) && x+airplaneLength < ( this.mountainWidth*1.1 + this.distance - y/2))
	    {
	    	return true;
	    }
	    else{
	    	return false;
	    }
	}
	hitFunction(){
		this.hitFunction();
	}
	
}
//Input 
//-Distance
//-DivToBindTo
//Output
//-Actual trashcan 
//-Hitbox with link
class Tashcan {
	constructor(divToBindTo, hitFunction){
		this.divToBindTo = divToBindTo;
		this.hitFunction = hitFunction;
		this.width = 100;
		$("#" + this.divToBindTo).append('<img id ="trashCan" src="img/trashCan.png" >');
	}
	newDistance(distance){
		this.distance = distance;
		$("trashCan").css( "left", `${distance}px`);
		return this.width;
	}
	isHit(x,y,airplaneLength){
		if(x>this.distance && x < this.distance +100 && y<60 ){
  			return true;
  		}
  		else {
  			return false;
  		}
	}
	hitFunction(){
		this.hitFunction();
	}
}
//Input 
//-Class to bind to
//Output
//-Signals output 

class Controls{
	constructor(divToBindTo, parent, isMobile)
	{
		this.running = false;
		this.divToBindTo = divToBindTo;
		this.up = false;
		this.down = false;
		var self = this;
		if(isMobile){
			window.addEventListener('deviceorientation', function(event) {
			  var alpha = event.alpha;
			  var beta = event.beta;
			  var gamma = event.gamma;
			   

				if(gamma > 20){
					if(!(self.running)){
			       			
			       			self.running = true;
			       			
			            	parent.start();
			            }
					self.up=false;
					self.down=true;
				}else if(gamma < -20)
				{
					if(!(self.running)){
			       			
			       			self.running = true;
			       			
			            	parent.start();
			            }
					self.up =true;
					self.down=false;
				}else{

					self.up=false;
					self.down=false;
				}
			}, false);

		}
		else{
			$(document).keydown(function(e) {  
			    switch(e.which) {
			        case 37: // up
			            self.up = true;
			            if(!(self.running)){

			            	
			            	self.running = true;
			            	parent.start();
			            	
			            }
			           	
			        break;
			        case 39://down
			        	
			       		if(!(self.running)){
			       			
			       			self.running = true;
			       			
			            	parent.start();
			            }
			            self.down = true;
			        default: return; // exit this handler for other keys
			    }
			    e.preventDefault(); // prevent the default action (scroll / move caret)
			});
		}
		// keyup handler
		$(document).keyup(function(e){
		    switch(e.which) {
		        case 37: // up
		              self.up = false;
		        break;
		        case 39://down
		              self.down = false;
		        default: return; // exit this handler for other keys
		    }
		});
	}
	reset(){
		this.up = false;
		this.down = false;
		this.running =false;
	}
	Up(){
		return this.up;
	}
	Down(){
		return this.down;
	}
}
//Input
//-Hitbox
//-x,y
//Output
//-Hit box Function call 
//TODO
//-implement r-tree detection
class HitBoxes{
	constructor(airplaneLength){
		this.HitBoxArray =[];
		this.airplaneLength = airplaneLength;
	}
	addHitBox(HitBox){
		//make sure this is pushing by reference and not by actual object
		this.HitBoxArray.push(HitBox);
	}
	checkHitBoxes(x,y){
		for(var i =0; i < this.HitBoxArray.length; i++){
			if(this.HitBoxArray[i].isHit(x,y,this.airplaneLength)){
				this.HitBoxArray[i].hitFunction();
				return true;
			}
		}
		return false;
	}
}
//Input
//-divToBindTo
//-x
//Output 
//-Update GUI visual
class Scenery{
	constructor(divToBindTo){
		this.divToBindTo = divToBindTo;
		this.newDiv = "idScenery"
		$("#" + this.divToBindTo).append('<div id="'+this.newDiv+'" style="top:0px; position:absolute; height:100%;"></div>');
	}
	render(x){
		$('#' + this.newDiv).css("left", -(x-100));
	}
	div(){
		return this.newDiv;
	}
	addBackground(element){
		$('#' + this.newDiv).append(element);
	}
	
}

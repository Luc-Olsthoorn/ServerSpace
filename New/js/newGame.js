//Input
//-Start
//-DivToBindTo
//-projects and function calls to be executed on hit
//-resume and function calls to be executed on hit
//-crash handler function calls 
//Output
//entire gui
class Game {
	constructor(divToBindTo)
	{
		this.distance = 0;
		this.divToBindTo = divToBindTo;
		this.controls = new Controls(divToBindTo);
		this.airplane = new AirPlane(divToBindTo, this.controls);
		this.hitboxes = new HitBoxes(airplane.getLength()); //must be after airplane creation
		this.scenery = new Scenery(divToBindTo);
		this.frameRate = 60;
	}
	addProject(project, hitFunction){
		var mountain = new Mountain(Scenery.div(), project, hitFunction);
		mountain.render();
		this.distance += mountain.newDistance(this.distance);
		this.HitBoxes.addHitBox(mountain);
	}
	createTrashcan(hitFunction){
		var trashcan = new trashcan(Scenery.div(), hitFunction);
		this.distance += trashcan.newDistance(distance);
		this.HitBoxes.addHitBox(trashcan);
	}
	start(){
		var i =0;
		while(1){
			this.airplane.reCalculate();
			if(this.hitboxes.checkHitBoxes(this.airplane.getX(), this.airplane.getY())){
				return "hit";
			}
			if(this.airplane.getY() < -17){
				return "ground";
			}
			if(this.airplane.getX() < this.distance){
				this.airplane.crash();
			}
			if(i%(60/this.frameRate)==0){
				this.airplane.render();
				this.scenery.render();
			}
			i++;
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
		this.planeLength = 100;
		this.pitch = 0;
		this.speed = 15;
		this.y=200;
		this.x=0;
		$('#'+this.divToBindTo).append('<img id ="airplane" src="img/airplane.png">');
	}

	speedUp(){
		this.speed++;
	}
	crash(){
		while(this.speed > 0){
			this.speed-=.5;
		}
	}
	reCalculate(){
		if(this.speed < 0)
	    {
	      this.pitch = -90;
	      this.y --;
	    }
		if(this.controller.Up())
			this.pitch += this.speed/30; 
		}
		if(this.controller.Down()){
			this.pitch -= this.speed/30;
		}
		this.speed -= (Math.sin(this.pitch*.15708))/3;
    	this.y += (this.speed*Math.sin(this.pitch*.15708));
    	this.x += (this.speed*Math.cos(this.pitch*.15708));
	}
	render(){
		$('#airplane').css("transform", "scaleX(-1) rotate("+this.pitch*9+"deg) ");
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
class Mountain {
	constructor(divToBindTo, project,hitFunction){
		this.divToBindTo = divToBindTo;
		this.hitFunction = hitFunction;
		this.project = project;
	}
	render(){
		this.mountainWidth = this.project.importance*50 + 100;
		text += `<img id="mountainImg${this.project.name}" src="img/mountains.png" style=" z-index:2;height: ${size} px; width:${this.mountainWidth}px;  position:absolute; bottom:0px;" >`;
		text += `<div id="mountainText${this.project.name}" style="z-index:3;position:absolute;  bottom:0px; width: ${this.mountainWidth}px; text-align:center;"><h3 style="color:white;"> ${this.project.name} </h3></div>`;
		$(this.divToBindTo).append(text);
	}
	newDistance(distance){
		this.distance = distance;
		$("mountainImg" + this.project.name).css( "left", `${distance}px`;
		$("mountainText" + this.project.name).css( "left", `${distance}px`;
		return this.mountainWidth+Math.random()*500;
	}
	isHit(x,y,airplaneLength){
		if((x + airplaneLength) > (y/2+this.distance) && y < (this.mountainWidth*.8) && x+airplaneLength < ( this.mountainWidth + this.distance - y/2))
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
		this.width = 
	}
	newDistance(distance){
		this.distance = distance;
		$("trashCan").css( "left", `${distance}px`;
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
	constructor(divToBindTo)
	{
		this.divToBindTo = divToBindTo;
		this.up = false;
		this.down = false;
		$(document).keydown(function(e) {  
		    switch(e.which) {
		        case 37: // up
		              this.up = true;
		        break;
		        case 39://down
		              this.down = true;
		        default: return; // exit this handler for other keys
		    }
		    e.preventDefault(); // prevent the default action (scroll / move caret)
		});

		// keyup handler
		$(document).keyup(function(e){
		    switch(e.which) {
		        case 37: // up
		              this.up = false;
		        break;
		        case 39://down
		              this.down = false;
		        default: return; // exit this handler for other keys
		    }
		});
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
		for(var i =0; i < this.HitBoxArray; i++){
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
		$("#" + this.divToBindTo).append('<div id="">'+this.newDiv+'</div>');
	}
	render(x){
		$('#' + this.divToBindTo).css("left", -(x-100));
	}
	div(){
		return this.newDiv;
	}
	
}
var projects = [
				{"name":"Auto-Email","description":"Built an Angularjs based web app to auto generate, visualize, and edit the weekly email. Used the FB api to pull the json asynchronously among multiple groups of upcoming events","link":"http://lamp.cse.fau.edu/~lolsthoorn2014/auto_Email/", "img":"img/autoEmail.png", "importance":"5"},	
				{"name":"TigerZone","description":"Developed a Java applet to connect to a Server, and play a board game using a simple AI. Was on an Agile Team of 5, initiated version control and unit testing","link":"https://github.com/aznxed/TigerZone_Remastered", "img":"img/tigerZone.jpg", "importance":"4"},	
				{"name":"Auto-Calendar","description":"Built a MEAN stack web app, using Google calendar API to display a person's schedule","link":"https://github.com/Luc-Olsthoorn/auto-calendar", "img":"img/calendar.png", "importance":"3"},					
				{"name":"Amoro","description":"A website I do web work for, as well as creating and maintaing the mobile/html5 design of the website","link":"http://www.amoro.com", "img":"img/amoro.jpg", "importance":"1"},
				{"name":"Sandia National Labs Intern","description":"Wrote a modular geographical data web framework using SpringMVC, Requirejs, JQuery, Bootstrap. Developed an algorithm based on graphs for automatically adjusting components to fit on differing screen sizes using jQuery, and JavaScript. Developed a UI for adding, deleting, moving and resizing components using JQuery and JQuery-ui, worked on an agile team of four","link":"http://wwww.Sandia.gov", "img":"img/sandia.png", "importance":"6"},
				{"name":"UFACM","description":"Built the website using a custom google sheets CMS","link":"http://ufacm.xyz", "img":"img/ufacm.png", "importance":"5"},
				{"name":"EWEEK2016","description":"Designed the frontend for the 2016 EWeek for UF","link":"http://ufbec.org/eweek2016/", "img":"img/Eweek.png", "importance":"3"},
				{"name":"GatorMotorWorks","description":"Built a php mysql site for a startup in gainesville selling custom parts","link":"http://gatormotorworks.com", "img":"img/GatorMotorWorks.png", "importance":"2"},
				{"name":"Scribbl","description":"a social drawing app built in angularjs NodeJS and Mongo DB","link":"https://github.com/scribblapp/Scribbl", "img":"img/scribbl.jpg", "importance":"1"},
				{"name":"NOM","description":"PHP based webapp that feeds your gathering","link":"http://lamp.cse.fau.edu/~lolsthoorn2014/nom.html", "img":"img/nom.jpg", "importance":"1"}
				];
//var isTouchDevice = 'ontouchstart' in document.documentElement;
$(document).ready(function()
{
	$('#introPage').transition({duration   : '0s'});
	loadAll();
	setTimeout(function()
	{
		$('#introPage').transition({duration   : '1s'});
		$('#mainPage').transition({duration   : '1s'});
		$('#game').transition({duration   : '1s'});	
		$('#bottomLinks').transition({duration   : '1s'});
		$('#projectList').transition({duration   : '1s'});
		$('#projectSection').transition({duration   : '1s'});
		if($( window ).width() < 600)
		{
			$('#mobileControlRight').transition({duration   : '1s'});
			$('#mobileControlLeft').transition({duration   : '1s'});
		}
	},1000);
});
var mountains = [];
function createGame(divToBindTo){
	//create Game
	var total = 0;
	var distance = 500;
	var text="";
	var size;
	for(var i = 0; i < projects.length; i++)
	{
		var temp ={};
		size = projects[i].importance*50 + 100;
		text += '<img src="img/mountains.png" style=" z-index:2;height:'+ size +'px; width:'+ size +'px;  position:absolute; left:'+ distance + 'px; bottom:0px;" >';
		text += '<div style="z-index:3;position:absolute; left:'+ distance + 'px; bottom:0px; width: '+size+'px; text-align:center;"><h3 style="color:white;">'+ projects[i].name+' </h3></div>';
		temp.id = i;
		temp.size = size;
		temp.distance = distance+20;
		mountains.push(temp);

		distance += size+Math.random()*500;
	}
	total = distance + size;
	$('#scenery').append(text);
	$('#trashCan').css("left", (total+100));
	$('#gameResume').css("left", (total+100));
	resumeDistance = total+100;
}
function createProjectPage()
{
	for(var i =0; i < projects.length; i++)
	{
		var	text = '<img id ="projectList' + i +'" src="'+projects[i].img+'" class="ui wireframe image "  >';
		$('#normalProjects').append(text);
		$('#projectList' + i).click({ value: i },function(event){
			$('.modal').modal('hide');
			$('#project' + event.data.value).modal('show');
			console.log("project"+ event.data.value);
		});
	}
	$('.sequenced.images .image').visibility({
	    type       : 'image',
	    transition : 'fade in',
	    duration   : 1000
 	});
}
function runGame()
{
	game();
	//runs game
}
function endGame(result)
{
	//$('#gameIntro').css("display","none");
	if(result == "win")
	{
		$('#win').transition({duration   : '1s'});
	}
	else if(result == "lost")
	{
		$('#lost').modal('show');
	}
	else if(result == "resume")
	{
		$('#resume').modal('show');
	}
	else
	{
		$('#project' + result).modal('show');
	}
}
function loadAll(){
	$('#loading').progress({total: 5});
	$('#loading').progress('increment');
	loadProjects();
	$('#loading').progress('increment');
	createGame();
	$('#loading').progress('increment');
	createProjectPage();
	$('#loading').progress('increment');
	setupModal();
	$('#loading').progress('increment');

	$('#mainPage').visibility({
	    once       : false,
	    continuous : true,
	    onPassing  : function(calculations) {
	    	var transperacy = 1 - calculations.percentagePassed;
	      	var newColor = 'rgba(0, 0, 0, ' + transperacy +')';
	      	$('body').css('background-color', newColor);
	      	console.log(newColor);
	    }
	  });

}
function loadProjects()
{
	var text = "";
	for(var i =0; i<projects.length; i++)
	{
		text = "";
		text += '<div id="project'+i+'" style="display:none;" class="ui basic modal">';
		text += '<div class="ui container very padded text">';
		text +=  '<div class="ui horizontal divider inverted">';
		text += '<h1 class="inverted">';
		text += projects[i].name;
		text += '</h1>';
		text += '</div>';
		text += '<div class="ui grid">';
		text += '<div class="eight wide column">';
		text += '<img class="ui medium circular image" src="'
		text += projects[i].img;
		text += '">';
		text += '</div>';
		text += '<div class="eight wide column">';
		text += '<h3 style="color:white; font-style: italic;font-weight: normal;">"';
		text += projects[i].description;
		text += '"</h3>';
		text += '<a href = " ';
		text += projects[i].link;
		text += '"><button class="ui inverted button">Website</button></a>';
		text += '</div></div>';
		text +=  '<div class="ui inverted divider"></div>';
		text += '<div class="actions">';
        text +=  '<div class="ui red basic inverted button projects">View Projects Normally</div>';
        text +=  '<div class="ui green basic game inverted button">Play again</div>';
        text+= '</div>';
		text += '</div></div>';
		$('body').append(text);
	}
}
function setupModal()
{
	$('#playBtn').click(function(){
		initalize();
		runGame();
	});

	$('.game').click(function(){
		initalize();
		$('.modal').modal('hide');
	});
	$('.projects').click(function(){
		$('.modal').modal('hide');
		$('#projects').modal('show');

	});
	$('.back').click(function(){
		$('.modal').modal('hide');
		initalize();
	});
	$('.modal').modal('setting', 'closable', false);
}
function setupProjects(){
	$('.ui.sticky').sticky({
    context: '#projectSection'
  });
}


var projects = [
				{"name":"Alacarte","googleDocURL":'https://docs.google.com/presentation/d/e/2PACX-1vTAFgeJtYkR0gu-vDtPbShsvK7dOURB7mHndJMXXISdxDTGm2eG8bx6NAfVjx_jryV7-TuTGZwqOZ9s/embed?start=true&loop=false&delayms=3000" width="960" height="569" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"', "importance":"5", "height":"600"},	
				{"name":"DataHub","googleDocURL":"https://docs.google.com/document/d/1kNGKrbwFrCANBu_oDjKUoaBlnUY75c-cFjEGSuCq950/pub?embedded=true", "importance":"3", "height":"600"},
				{"name":"Auto-Email","googleDocURL":"https://docs.google.com/document/d/1YdpPPdBFeJNIP1fWZFcxhnntoK-1wXs2QejlCGs2dVk/pub?embedded=true", "importance":"5", "height":"400"},
				{"name":"TigerZone","googleDocURL":"https://docs.google.com/document/d/1t3RP6gxz_0c8DRpCYOw7T1a-HE30bvb1kK0mjKwcSwc/pub?embedded=true", "importance":"2", "height":"400"},
				{"name":"Auto-Calendar", "googleDocURL":"https://docs.google.com/document/d/1VBz2G5E0zM8Ot_32PRQBzSsfuSt3yomRipAgRP9jNW4/pub?embedded=true", "importance":"3", "height":"400"},
				{"name":"UFACM","googleDocURL":"https://docs.google.com/document/d/1FYKEMG9mkMujYSkCJ4JSwmlqsZpqm5VDO-eGhfkVxIU/pub?embedded=true", "importance":"4", "height":"400"},
				{"name":"EWEEK2016","googleDocURL":"https://docs.google.com/document/d/e/2PACX-1vQ8ZSQ7nWWiANX2Lda-7ZSZ5fOrIgZT7gGgf8kpn632hxWC_OJPvKv76kGdqczlfqYsCao0o0geU85F/pub?embedded=true", "importance":"2", "height":"400"},
				{"name":"Scribbl","googleDocURL":"https://docs.google.com/document/d/1V7SlU8FRpmXMQ31taKdur3dxgzb-Z6rNUoMsVvXoUqk/pub?embedded=true", "importance":"1", "height":"400"},
				{"name":"NOM","googleDocURL":"https://docs.google.com/document/d/12AxHBhlSRTtx2EXgNdJHkkngU4lOEG0ZISCIN8TV3UY/pub?embedded=true", "importance":"1", "height":"400"}
				];
var work =[{"name":"Sandia National Labs Intern Pt.1","googleDocURL":"https://docs.google.com/document/d/1AmiNO6RKw2L-NiHGy3sWVxJZ6SSdo6Pe8c09IACRnHg/pub?embedded=true",  "importance":"6", "height":"1000"},
	{"name":"Sandia National Labs Intern Pt.2","googleDocURL":"https://docs.google.com/document/d/1UEdJmhbTAB3v_mrLBvYTpVVJEnzFejeesEV3BRG9sAY/pub?embedded=true", "importance":"6" , "height":"1400"},
	{"name":"GatorMotorWorks", "googleDocURL":"https://docs.google.com/document/d/1DcnWJFeq2Rrg0-f67oiE_ubNVfXX61_HtTab7htYk20/pub?embedded=true","importance":"2", "height":"800"},
	{"name":"Amoro", "googleDocURL":"https://docs.google.com/document/d/1zXYFTCVdJzsbf3mRTdsm9Wu5Muvq_VNamjCotYg6MzA/pub?embedded=true", "importance":"2", "height":"400"}
];
var about = [{"name":"General", "googleDocURL":"https://docs.google.com/document/d/1mn7kBDPJpJm26uldQtUCcOUoECd8duho_bAnVzYw4Ws/pub?embedded=true", "importance":"2", "height":"400"},
	{"name":"DJ/Producing", "googleDocURL":"https://docs.google.com/document/d/18WSxuHYHi7uda0sdo9uKSayMBTmh6vb2c9oCIQg3I0k/pub?embedded=true", "importance":"2", "height":"400"}];
var resume = [{"name":"View", "googleDocURL":"https://docs.google.com/document/d/1gk2ZTqwowVei5fepCZEEoMToVgA6etjq4bZdtOKMRTk/pub?embedded=true", "importance":"2", "height":"1400"}];
//var isTouchDevice = 'ontouchstart' in document.documentElement;
$(document).ready(function()
{

	website = new Website(projects);
});

class MenuItem {
	constructor(subMenuHeader, name, execute){
		var item = $(`<a class="item">${name}</a>`);
		subMenuHeader.append(item);
		item.on('click', function(){
			execute();
		});
	}
}

class Page{
	constructor(googleDocURL){
		this.iframeSize=0;
		this.height = 0;
		this.inputHeight=0;
		var self=this;
		this.html=$(`<iframe style="border: 0" width="100" frameborder="0" scrolling="no" src="${googleDocURL}"></iframe>`);
		this.loading=$(`<div class="ui active loader"></div>`);
	}
	setHtml(divToBindTo){
		var width = $( "#projectAttatchment" ).width();
		console.log(width);
		this.height = 660*this.inputHeight/width;
		var self =this;
		this.html.css("display","none");
		$("#" + divToBindTo).html(this.html);
		$("#" + divToBindTo).addClass(" active inverted ");
		$("#" + divToBindTo).append(this.loading);
		$("#" + divToBindTo).css("background-color","white")
		$("#" + divToBindTo).css("height", this.height);
		self.html.on('load',function(){
			console.log("in");
			self.loading.remove();
			self.html.css("display","inherit");
			$("#" + divToBindTo).html(this.html);
			$("#" + divToBindTo).removeClass(" active ");
		});
	}
	setHeight(inputHeight){
		this.inputHeight = inputHeight;
	}
	addMenuItem(subMenuHeader, name, execute)
	{
		this.menuItem = new MenuItem(subMenuHeader, name, execute);
	}
	getSize(){
		return this.size;
	}
}

class PageSection{
	constructor(divToBindTo)
	{
		this.pageArray=[];
		this.divToBindTo = divToBindTo;
		this.menuID = "menuBar";
		this.contentID = "projectAttatchment";
		$("#"+ this.divToBindTo).append(`
		<div class="ui container">
			<div class="ui stackable grid">
  				<div class="four wide column" >
   					<div class="ui vertical fluid tabular menu" id="${this.menuID}"></div>
				</div>
				<div class="twelve wide stretched column">
    				<div class="ui container">
      					<div class="ui embed container center" id="${this.contentID}" style="height:100%; overfow:auto;"  >
						</div>
					</div>
				</div>
  			</div>
  		</div>`);

	}
	addPage(subMenuHeader, item, onClickCall){
		var page = new Page(item.googleDocURL);
		page.setHeight(item.height);
		page.addMenuItem(subMenuHeader, item.name, onClickCall);
		this.pageArray.push(page);
	}
	addPageHeader(name){
		var menuHeader = $(`<div class="ui vertical fluid tabular menu" >
   								<div class="header">${name}</div>
							</div>`);
		var subMenuHeader = $(`<div class="menu" ></div>`);
		menuHeader.append(subMenuHeader);
		$("#" + this.menuID).append(menuHeader);
		return subMenuHeader;
	}
	switchPage(index){
		console.log("called");
		this.pageArray[index].setHtml(this.contentID);

	}
	getIndex(){
		return this.pageArray.length;
	}
}
class Website {
	constructor(projects){
		this.gameDiv = "game";
		this.footer = "footer";
		this.mainPageDiv = "mainPage";
		this.bottomLinksDiv = "bottomLinks"
		this.pageSectionDiv = "pageSection";
		this.loadingScreenDiv = "intro";
		this.mobile=false;
		if ($( window ).width() < 960) {
    		this.mobile=true;
		}
		this.loadingScreen =  new LoadingScreen(this.loadingScreenDiv);
		this.loadingScreen.addToIncrement(3);

		this.pageSection = new PageSection(this.pageSectionDiv);
		this.loadingScreen.increment();

		this.game = new Game(this.gameDiv, this.mobile);
		this.game.render();
		this.loadingScreen.increment();

		//add projects

		this.addNewSubsection("Projects", projects, true);
		this.addNewSubsection("Work", work, true);
		this.addNewSubsection("About", about, false);
		this.addNewSubsection("Resume", resume, false);
		//default to about me
		this.pageSection.switchPage(12);
		//show the divs
		this.loadingScreen.increment();
		this.loadingScreen.hide();
		$('#' + this.gameDiv).transition({duration   : '3s'});
		$('#' + this.mainPageDiv).transition({duration   : '3s'});
		$('#' + this.footer).transition({duration   : '3s'});
		$('#' + this.bottomLinksDiv).transition({duration   : '3s'});
		$('#' + this.pageSectionDiv).transition({duration   : '3s'});
	}
	addNewSubsection(name, items, game){
		var self = this;
		var projectMenuHeader = this.pageSection.addPageHeader(name);
		for(var i=0; i<items.length;i++){
			var index = this.pageSection.getIndex();
			function switchItem(temp){ return function (){
				$("html, body").animate({
					scrollTop: $(document).height()*3/5
				}, 1000, 'swing');
				self.pageSection.switchPage(temp);
			}};
			var temporaryFunction = switchItem(index);

			if(game){
				this.game.addProject(items[i], temporaryFunction);
			}
			this.pageSection.addPage(projectMenuHeader, items[i], temporaryFunction);
		}
	}
}
class LoadingScreen{
	constructor(divToBindTo){
		this.divToBindTo = divToBindTo;
		this.incrementer = 0;
		this.incrementTotalAmount = 0;
		this.loadingBar = $(`<div class="ui tiny progress" id="loading">
	  			<div class="bar ">
	    			<div class="progress"></div>
				</div>
    		</div>`);
		this.wrapper= $(`
      	<div style="top:35%; position:absolute; width:100%">
			<h1 class="header inverted thin " style="text-align:center; color:white;  margin:0px;">LUC OLSTHOORN</h1>
			<p class=" grey-text lighten-3" style="color:white;text-align:center;">web developer//coder//musician</p>

		</div>`);
		this.wrapper.append(this.loadingBar);
		$("#"+this.divToBindTo).append(this.wrapper);
	}
	increment(){
		this.loadingBar.progress('increment');
		this.incrementer++;
		if(this.incrementTotalAmount == this.incrementer){

			return true;
		}
		else{
			return false;
		}
	}
	addToIncrement(amount){
		this.incrementTotalAmount += amount;
		this.loadingBar.progress({total: this.incrementTotalAmount});
	}
	hide(){
		$('#' + this.divToBindTo).transition({duration   : '3s'});
	}
}

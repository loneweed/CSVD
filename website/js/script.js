  function getById(id) {
    if (document.getElementById) {
      return document.getElementById(id);
    } else if (document.all) {
      return document.all[id];
    } else if (document.layers) {
      return document.layers[id];
    } else {
      return null;
    }
  }

  function popupmenu(s){
    if (getById("menu"+s)!=null){
      var m =getById("menu"+s);
      if (m.style.display=='block') {m.style.display ='none';}
      else{ m.style.display ='block';}
    }
  }
  
  function em(item, act){
    item.className = "menuitem " + act;
  }
	function menus(id, ix, mx, b, f){
	  for (var i=1; i<=mx; i++){
	    if (getById(id+i)!=null) {
	      getById(id+i).style.display="none";
	    }
	    if (getById(id+'c'+i)!=null){
  	    getById(id+'c'+i).style.color = b;
  	    getById(id+'c'+i).style.backgroundColor = 'white';
	    }
    }
  	if (getById(id+ix)!=null){
    	getById(id+ix).style.display="block";
	    if (getById(id+'c'+ix)!=null){
  	    getById(id+'c'+ix).style.color = f;
  	    getById(id+'c'+ix).style.backgroundColor = b;
	    }
    }
	}	

	function resetpro(){
	  getById("t2").value ='';
	  getById("t3").value ='';
	  getById("s2").innerHTML =''
	  getById("psbutton").disabled = true;
	}
	function ckeckname(){
		var i = 1;
		var s ='<font color="red"> O </font>';
		var v1 = trims( getById("t1").value );
		var v2 = trims( getById("t2").value );
		var v3 = trims( getById("t3").value );

		if ( ( v1.length >=2 ) && confim(v1)) getById("s0").innerHTML = "P";
		else  { getById("s0").innerHTML = s; i = 0; }
		if ( v2.length >= 6 ) {
			getById("s2").innerHTML ='P';
			//getById("p2").style.display = 'block';
		}
		else  { 
			getById("s2").innerHTML = s; 
			//getById("p2").style.display = 'none';
			i = 0; 
		}
		if ( ( v3.length >= 6 )&&( v2 == v3 ) ) getById("s3").innerHTML ='P';
		else  {	getById("s3").innerHTML = s; i = 0; }

		getById("button1").disabled = (i!=1);
	}
	function ckeckMB(){
		var i = 1;
		var s ='<font color="red"> O </font>';
		var v1 = trims( getById("t1").value );
		var v2 = trims( getById("t2").value );
		var v3 = trims( getById("t3").value );

		if ( ( v1.length >=2 ) && confim(v1)) getById("s1").innerHTML = "P";
		else  { getById("s1").innerHTML = s; i = 0; }
		if ( v2.length >= 6 ) {
			getById("s2").innerHTML ='P';
			getById("p2").style.display = 'block';
		}
		else  { 
			getById("s2").innerHTML = s; 
			getById("p2").style.display = 'none';
			i = 0; 
		}
		if ( ( v3.length >= 6 )&&( v2 == v3 ) ) getById("s3").innerHTML ='P';
		else  {	getById("s3").innerHTML = s; i = 0; }

		getById("button1").disabled = (i!=1);
	}
	
	function trims(str){
		while (str.substring(0,1) == ' ') {
			str = str.substring(1,str.length);
		}
		return str;
	}
	function confim(str){
		var s = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_";
		if (str!=null){
  		for (var i=0; i < str.length; i++){
  			if (s.match( str.substr(i,1))==null) { return false; break;}
  		}
  		for (var i=0; i < str.length; i++){
  			if (str.substr(i,1)=='@') { str = str; }
  		}
  	}
		return true;
	}
	function revert(id)
	{
	  var doc = getById('post'+id);
		if (doc.style.display=="none") {sh(1, id);}
		doc.style.display= 'block';
		zoomin();
	}
	function cancel(id)
	{
		getById('comment'+id).reset();
		getById('post'+id).style.display='none';
	}
	
	function fontSize(size,id)
	{	
		getById('blogtext'+id).style.fontSize=size+'px';
	}

	function sh(i, obj)
	{
		getById("s"+obj+"_1").className = "uncheck";
		getById("s"+obj+"_2").className = "uncheck";
		getById("s"+obj+"_3").className = "uncheck";
		getById("s"+obj+"_"+i).className = "check";
		getById("txtbox"+obj).style.height = (i* 100);
	}
	function editeur(id){
	  var box = getById("commbox"+id);
	  var db  = getById("commbody"+id);
	  var msg = getById("editbox"+id);
	  var txt = getById("msgedit"+id);
	  var h = db.offsetHeight;
	  if (h < 80) h = 100;
    txt.style.height = h + "px";
	  box.style.display = "none";
	  msg.style.display = "block";
	  zoomin();
	}
	function unedit(id){
	  var box = getById("commbox"+id);
	  var msg = getById("editbox"+id);
	  var fm  = getById("editform"+id);
	  fm.reset();
	  box.style.display = "block";
	  msg.style.display = "none";
	}
	function checkedit(id){
	  var d1 = trims(getById("subedit"+id).value);
	  var d2 = trims(getById("msgedit"+id).value);
	  var btn= getById("button"+id);
	  btn.disabled = ((d2=="")||(d1==""));
	}
  function zoomin(){
    if (getById("pagemem")!=null){
      getById("pagemem").style.display = "none";
    }
    if (getById("mainpage")!=null){
      getById("mainpage").style.left = body.offsetLeft + 30 + "px"; 
      getById("mainpage").className  = "pagezoom";
    }
    if ( getById("toolbar1")!=null){
      getById("toolbar1").style.display = "none";
    }
    if ( getById("toolbar2")!=null){
      getById("toolbar2").style.display = "block";
    }
  }
  function zoomout(){
    var p = getById("mainpage");
    var m = getById("pagemem");
    m.style.display = "block";
    p.style.left    = body.offsetLeft + 350 + "px"; 
    p.className     = "pagebase";
    if ( getById("toolbar1")!=null){
      getById("toolbar1").style.display = "block";
    }
    if ( getById("toolbar2")!=null){
      getById("toolbar2").style.display = "none";
    }
  }
  function comment(id, v){
    if (v==null) v= 0;
    var txt = getById("msgtxt"+id);
    var com = getById("combox");
    var tag = getById("msgtag");
    if ((txt.style.display == "block") ||(txt.style.display == "")){
      txt.style.display = "none";
      com.style.display = "block";
    }else{
      txt.style.display = "block";
      com.style.display = "none";
    }
  }
function init_logo(n, obj){
	var mx = 12;
	var lms =''
	+'<div id="logoview" '
	+'	style="background-color:menu; border:1px solid silver; padding:0px; height:82px; width:82px;">'
	+'<img src="user/ulogo.asp?uid='+n+'" height="80" width="80"></div>'
	+'<input id="userlogos" name="userlogo" type="hidden" value="1" />'
	+'<div id="menulogo" style="text-align:center; width:80px; margin:5 0 0 0;">'
	+'<span style="width:18px;"><img id="previmg" onclick="javas'+'cript:slogo(0);"'
	+'	border="0" height="16" src="style/button/icon_prev.png" style="cursor:hand; display:none;" title="select prev logo" width="16"></span><span '
	+'  style="width:18px;"><img id="nextimg" onclick="javas'+'cript:slogo(1);"'
	+'  border="0" height="16" src="style/button/icon_next.png" style="cursor:hand;" title="select next logo" width="16"></span>'
	+'</div>';
	getById(obj).innerHTML = lms ;
}

function slogo(m)
{
	var i = getById("userlogo").value;
	var p = getById("previmg");
	var n = getById("nextimg");
	if (m == 1) { i++; p.style.display='block';}
	if (m == 0) { i--; n.style.display='block';}
	if (i <= 1) { p.style.display='none';}
	if (i >= 24) { n.style.display='none'; }
	getById("userlogo").value = i;
	getById("logoview").innerHTML = "<img src='user/ulogo.asp?_c=sel&uid="+i+"'>";
	if (getById("logobutton")!=null) getById("logobutton").disabled=false;
}
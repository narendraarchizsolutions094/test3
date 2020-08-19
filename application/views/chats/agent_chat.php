  <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-app.js"></script>  
  <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-analytics.js"></script>  
  <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-firestore.js"></script>


<style type="text/css">
	*, *:before, *:after {
  box-sizing: border-box;
}

:root {
  --white: #fff;
  --black: #000;
  --bg: #f8f8f8;
  --grey: #999;
  --dark: #1a1a1a;
  --light: #e6e6e6;
  --wrapper-agent: 1000px;
  --blue: #00b0ff;
}



.wrapper-agent {
  position: relative;
  left: 50%;
  width: var(--wrapper-agent);
  height: 800px;
  -webkit-transform: translate(-50%, 0);
          transform: translate(-50%, 0);
}

.container-agent {
  position: relative;
  top: 50%;
  left: 50%;
  width: 80%;
  height: 75%;
  background-color: var(--white);
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}
.container-agent .left {
  float: left;
  width: 37.6%;
  min-height: 552px;
  max-height: 552px;
  border: 1px solid var(--light);
  background-color: var(--white);
}
.container-agent .left .top {
  position: relative;
  width: 100%;
  height: 96px;
  padding: 29px;
}

.container-agent .left input {
  float: left;
  width: 188px;
  height: 42px;
  padding: 0 15px;
  border: 1px solid var(--light);
  background-color: #eceff1;
  border-radius: 21px;
  font-family: 'Source Sans Pro', sans-serif;
  font-weight: 400;
}
.container-agent .left input:focus {
  outline: none;
}
.container-agent .left .people {
  margin-left: -1px;
  border-right: 1px solid var(--light);
  border-left: 1px solid var(--light);
  width: calc(100% + 2px);
}
.container-agent .left .people .person {
  position: relative;
  width: 100%;
  padding: 12px 10% 16px;
  cursor: pointer;
  background-color: var(--white);
  border-bottom: 1px solid; 
  border-top: 1px solid; 
}

.container-agent .left .people .person img {
  float: left;
  width: 40px;
  height: 40px;
  margin-right: 12px;
  border-radius: 50%;
  -o-object-fit: cover;
     object-fit: cover;
}
.container-agent .left .people .person .name {
  font-size: 14px;
  line-height: 22px;
  color: var(--dark);
  font-family: 'Source Sans Pro', sans-serif;
  font-weight: 600;
}
.container-agent .left .people .person .time {
  font-size: 14px;
  position: absolute;
  top: 16px;
  right: 10%;
  padding: 0 0 5px 5px;
  color: var(--grey);
  background-color: var(--white);
}
.container-agent .left .people .person .preview {
	visibility: hidden;
  font-size: 14px;
  display: inline-block;
  overflow: hidden !important;
  width: 70%;
  white-space: nowrap;
  text-overflow: ellipsis;
  color: var(--grey);
}
.container-agent .left .people .person.active, .container-agent .left .people .person:hover {
  margin-top: -1px;
  margin-left: -1px;
  padding-top: 13px;
  border: 0;
  background-color: var(--blue);
  width: calc(100% + 2px);
  padding-left: calc(10% + 1px);
}
.container-agent .left .people .person.active span, .container-agent .left .people .person:hover span {
  color: var(--white);
  background: transparent;
}
.container-agent .left .people .person.active:after, .container-agent .left .people .person:hover:after {
  display: none;
}
.container-agent .right {
  position: relative;
  float: left;
  width: 62.4%;
  height: 100%;
}
.container-agent .right .top {
  width: 100%;
  height: 47px;
  padding: 15px 29px;
  background-color: #eceff1;
}
.container-agent .right .top span {
  font-size: 15px;
  color: var(--grey);
}
.container-agent .right .top span .name {
  color: var(--dark);
  font-family: 'Source Sans Pro', sans-serif;
  font-weight: 600;
}
.container-agent .right .chat {
  position: relative;
  display: none;
  overflow: auto;
  padding: 0 35px 92px;
  border-width: 1px 1px 1px 0;
  border-style: solid;
  border-color: var(--light);
  height: calc(553px - 48px);
  -webkit-box-pack: end;
          justify-content: flex-end;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
          flex-direction: column;
}
.container-agent .right .chat.active-chat {
  display: block;
  display: -webkit-box;
  display: block;
}
.container-agent .right .chat.active-chat .bubble {
  -webkit-transition-timing-function: cubic-bezier(0.4, -0.04, 1, 1);
          transition-timing-function: cubic-bezier(0.4, -0.04, 1, 1);
}
.container-agent .right .chat.active-chat .bubble:nth-of-type(1) {
  -webkit-animation-duration: 0.15s;
          animation-duration: 0.15s;
}
.container-agent .right .chat.active-chat .bubble:nth-of-type(2) {
  -webkit-animation-duration: 0.3s;
          animation-duration: 0.3s;
}
.container-agent .right .chat.active-chat .bubble:nth-of-type(3) {
  -webkit-animation-duration: 0.45s;
          animation-duration: 0.45s;
}
.container-agent .right .chat.active-chat .bubble:nth-of-type(4) {
  -webkit-animation-duration: 0.6s;
          animation-duration: 0.6s;
}
.container-agent .right .chat.active-chat .bubble:nth-of-type(5) {
  -webkit-animation-duration: 0.75s;
          animation-duration: 0.75s;
}
.container-agent .right .chat.active-chat .bubble:nth-of-type(6) {
  -webkit-animation-duration: 0.9s;
          animation-duration: 0.9s;
}
.container-agent .right .chat.active-chat .bubble:nth-of-type(7) {
  -webkit-animation-duration: 1.05s;
          animation-duration: 1.05s;
}
.container-agent .right .chat.active-chat .bubble:nth-of-type(8) {
  -webkit-animation-duration: 1.2s;
          animation-duration: 1.2s;
}
.container-agent .right .chat.active-chat .bubble:nth-of-type(9) {
  -webkit-animation-duration: 1.35s;
          animation-duration: 1.35s;
}
.container-agent .right .chat.active-chat .bubble:nth-of-type(10) {
  -webkit-animation-duration: 1.5s;
          animation-duration: 1.5s;
}
.container-agent .right .write {
  position: absolute;
  bottom: 29px;
  left: 30px;
  height: 42px;
  padding-left: 8px;
  border: 1px solid var(--light);
  background-color: #eceff1;
  width: calc(100% - 58px);
  border-radius: 5px;
}
.container-agent .right .write input {
  font-size: 16px;
  float: left;
  width: 347px;
  height: 40px;
  padding: 0 10px;
  color: var(--dark);
  border: 0;
  outline: none;
  background-color: #eceff1;
  font-family: 'Source Sans Pro', sans-serif;
  font-weight: 400;
}
.container-agent .right .write .write-link.attach:before {
  display: inline-block;
  float: left;
  width: 20px;
  height: 42px;
  content: '';
  background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/attachment.png");
  background-repeat: no-repeat;
  background-position: center;
}
.container-agent .right .write .write-link.smiley:before {
  display: inline-block;
  float: left;
  width: 20px;
  height: 42px;
  content: '';
  background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/smiley.png");
  background-repeat: no-repeat;
  background-position: center;
}
.container-agent .right .write .write-link.send:before {
  display: inline-block;
  float: left;
  width: 20px;
  height: 42px;
  margin-left: 11px;
  content: '';
  background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/send.png");
  background-repeat: no-repeat;
  background-position: center;
}
.container-agent .right .bubble {
  font-size: 16px;
  position: relative;
  display: inline-block;
  clear: both;
  margin-bottom: 8px;
  padding: 13px 14px;
  vertical-align: top;
  border-radius: 5px;
}
.container-agent .right .bubble:before {
  position: absolute;
  top: 19px;
  display: block;
  width: 8px;
  height: 6px;
  content: '\00a0';
  -webkit-transform: rotate(29deg) skew(-35deg);
          transform: rotate(29deg) skew(-35deg);
}
.container-agent .right .bubble.you {
  float: left;
  color: var(--white);
  background-color: var(--blue);
  align-self: flex-start;
  -webkit-animation-name: slideFromLeft;
          animation-name: slideFromLeft;
}
.container-agent .right .bubble.you:before {
  left: -3px;
  background-color: var(--blue);
}
.container-agent .right .bubble.me {
  float: right;
  color: var(--dark);
  background-color: #eceff1;
  align-self: flex-end;
  -webkit-animation-name: slideFromRight;
          animation-name: slideFromRight;
}
.container-agent .right .bubble.me:before {
  right: -3px;
  background-color: #eceff1;
}
.container-agent .right .conversation-start {
  position: relative;
  width: 100%;
  margin-bottom: 27px;
  text-align: center;
}
.container-agent .right .conversation-start span {
  font-size: 14px;
  display: inline-block;
  color: var(--grey);
}
.search{
	width: 36px;
    height: 36px;
    margin-top: 3px;
    margin-left:15px;
}
.container-agent .right .conversation-start span:before, .container-agent .right .conversation-start span:after {
  position: absolute;
  top: 10px;
  display: inline-block;
  width: 30%;
  height: 1px;
  content: '';
  background-color: var(--light);
}
.container-agent .right .conversation-start span:before {
  left: 0;
}
.container-agent .right .conversation-start span:after {
  right: 0;
}

@keyframes slideFromLeft {
  0% {
    margin-left: -200px;
    opacity: 0;
  }
  100% {
    margin-left: 0;
    opacity: 1;
  }
}
@-webkit-keyframes slideFromLeft {
  0% {
    margin-left: -200px;
    opacity: 0;
  }
  100% {
    margin-left: 0;
    opacity: 1;
  }
}
@keyframes slideFromRight {
  0% {
    margin-right: -200px;
    opacity: 0;
  }
  100% {
    margin-right: 0;
    opacity: 1;
  }
}
@-webkit-keyframes slideFromRight {
  0% {
    margin-right: -200px;
    opacity: 0;
  }
  100% {
    margin-right: 0;
    opacity: 1;
  }
}

</style>
<br>
<div class="wrappe-agent">
    <div class="container-agent">
        <div class="left">
            <div class="top">
                <input type="text" placeholder="Search" />
                <a href="javascript:;" class="fa fa-search btn btn-circle btn-default btn-sm search"></a>
            </div>
            <ul class="people" style="list-style-type: none;padding-left: 0px;">       
            </ul>
        </div>
        <div class="right" style="min-height: 575px; max-height: 575px;">
            <div class="top"><span>To: <span class="name"></span></span>
            </div>           
            <div class="write">
                <!-- <a href="javascript:;" class="write-link attach"></a> -->
                <input type="text" id="chat-input"/>
                <!-- <a href="javascript:;" class="write-link smiley"></a> -->
                <a href="javascript:;" class="write-link send"></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

function after_load(){	
	let friends = {
	  list: document.querySelector('ul.people'),
	  all: document.querySelectorAll('.left .person'),
	  name: '' },

	chat = {
	  container: document.querySelector('.container-agent .right'),
	  current: null,
	  person: null,
	  name: document.querySelector('.container-agent .right .top .name') };

	friends.all.forEach(f => {
	  f.addEventListener('mousedown', () => {
	    f.classList.contains('active') || setAciveChat(f);
	  });
	});

	function setAciveChat(f) {
	  friends.list.querySelector('.active').classList.remove('active');
	  f.classList.add('active');
	  chat.current = chat.container.querySelector('.active-chat');
	  chat.person = f.getAttribute('data-chat');
	  chat.current.classList.remove('active-chat');
	  chat.container.querySelector('[data-chat="' + chat.person + '"]').classList.add('active-chat');
	  friends.name = f.querySelector('.name').innerText;
	  chat.name.innerHTML = friends.name;
	}
}


</script>

<script>    
    var firebaseConfig = {
      apiKey: 'AIzaSyB8uP-mYOUCKGvjv_MQ1a-lsrlboYdmFg4',
	  authDomain: 'chat-6512f.firebaseapp.com',
	  projectId: 'chat-6512f'
    };    
    firebase.initializeApp(firebaseConfig);
    var db = firebase.firestore();
    function add_user(){ 
    	datetime = "<?=date('Y-m-d h:i:sa')?>";     	
		db.collection("users").doc("<?=$this->session->user_id?>").set({
		    name:"<?=$this->session->fullname?>",
		    comp_id:"<?=$this->session->companey_id?>",
		    uid:"<?=$this->session->user_id?>",
		    type:"agent",
		    time:datetime
		},{merge: true})
		.then(function(docRef) {
		  
		})
		.catch(function(error) {
		    console.error("Error adding document: ", error);
		});
    }
    add_user();    
    function get_user_list(){
    	var comp_id = "<?=$this->session->companey_id?>";
    	db.collection("users").where("comp_id", "==", comp_id).where("type", "==", 'enquiry')
	    .get()
	    .then(function(querySnapshot) {
	    	var i = 0;
	        querySnapshot.forEach(function(doc) {	        	
	            
	        	doc = doc.data();

	        	var date = doc.time.slice(-11);
	        	var name	=	doc.name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					    return letter.toUpperCase();
					});
	        	html = '<li class="person" data-chat="'+doc.uid+'"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/thomas.jpg" alt=""/><span class="name">'+name+'</span><span class="time">'+date+'</span><span class="preview" ></span></li>';
	            $(".people").append(html);
	            //console.log(name);
	            $(".right .top .name").html(name);
	            $(".right>.top").after('<div class="chat" data-chat="'+doc.uid+'"></div>');
	            db.collection("messages").orderBy('time','desc').get()
			    .then(function(msgSnapshot) {
			        msgSnapshot.forEach(function(msg) {	            
			        	msg_data	=	msg.data();
			        	if (msg_data.sender_id == doc.uid) {
			        		msg = '<div class="bubble you">'+msg_data.message+'<br><small style="font-size:8px;float:right;">'+doc.time+'</small></div>';
			        	}else if (msg_data.receiver_id == doc.uid) {
			        		msg = '<div class="bubble me">'+msg_data.message+'<br><small style="font-size:8px;float:right;">'+doc.time+'</small></div>';
			        	}			        	
			        	$("div[data-chat="+doc.uid+"]").append(msg);
			        });
			    });
			    if (i == 0) {			    	
				    document.querySelector('.chat[data-chat='+doc.uid+']').classList.add('active-chat');
					document.querySelector('.person[data-chat='+doc.uid+']').classList.add('active');
			    }
				i++;
	        });
	        after_load();
	    })
	    .catch(function(error) {
	        console.log("Error getting documents: ", error);
	    });
    }

    get_user_list();

    $(".send").on('click',function(){
    	var msg = $("#chat-input").val(); 
	    if(msg.trim() == ''){
	      return false;
	    }
	    a = document.querySelector('.active-chat');
	    uid = a.getAttribute('data-chat');
	    generate_message(msg, 'me',uid);
	    send_message(msg);	   
    });

    function send_message(msg){
		a = document.querySelector('.active-chat');
	    uid = a.getAttribute('data-chat');
		var agent_id = "<?=$this->session->user_id?>";      
		datetime = "<?=date('Y-m-d h:i:sa')?>";       

		db.collection("messages").add({
		  id:uid+'_'+agent_id,
		  time: datetime,
		  message: msg,
		  sender_id: "<?=$this->session->user_id?>",
		  receiver_id: uid,
		  comp_id:"<?=$this->session->companey_id?>"
		})
		.then(function(docRef) {		  
		})
		.catch(function(error) {
		  console.error("Error adding document: ", error);
		});
    }      

    function generate_message(msg, type,uid) {
		datetime = "<?=date('Y-m-d h:i:sa')?>";           	
	    var str = '<div class="bubble '+type+'">'+msg+'<br><small style="font-size:8px;float:right;">'+datetime+'</small></div>';	    
	    $("div[data-chat="+uid+"]").append(str);	    
	    if(type == 'me'){
	     $("#chat-input").val(''); 
	    }
	    $("div[data-chat="+uid+"]").stop().animate({ scrollTop: $("div[data-chat="+uid+"]")[0].scrollHeight}, 1000);  	    
  	}  


  	/*const doc = db.collection('users');
	const observer = doc.onSnapshot(docSnapshot => {	  
	  get_user_list();
	});*/

	comp_id = "<?=$this->session->companey_id?>"
	const msg = db.collection('messages').where('comp_id','==',comp_id);
	const msg_observer = msg.onSnapshot(docSnapshot => {	  
	   	docSnapshot.docChanges().forEach(change => {	   		
	      if (change.type === 'added') {
	      	msg_data	=	change.doc.data();	        
			uid = msg_data.receiver_id;			
			if (isNaN(msg_data.sender_id)) {
				uid = msg_data.sender_id;
        		msg = '<div class="bubble you">'+msg_data.message+'<br><small style="font-size:8px;float:right;">'+doc.time+'</small></div>';
        	}else if (!isNaN(msg_data.sender_id)) {
        		msg = '<div class="bubble me">'+msg_data.message+'<br><small style="font-size:8px;float:right;">'+doc.time+'</small></div>';
        	}			        	
        	$("div[data-chat="+uid+"]").append(msg);
	      }
	    });
	});
</script>


 
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
  
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/4.0.2/bootstrap-material-design.css">

<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link rel="stylesheet" type="text/css" href="<?=base_url().'assets/css/'?>chat.css">  

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url().'assets/js/'?>chat.js"></script>


</head>
<body>
<div id="center-text">   
</div> 
<div id="body"> 
  
<div id="chat-circle" class="btn btn-raised">
        <div id="chat-overlay"></div>
        <i class="material-icons">speaker_phone</i>
  </div>
  
  <div class="chat-box">
    <div class="chat-box-header">
      ChatBot
      <span class="chat-box-toggle"><i class="material-icons">close</i></span>
    </div>
    <div class="chat-box-body">
      <div class="chat-box-overlay">   
      </div>
      <div class="chat-logs">
       
      </div><!--chat-log -->
    </div>
    <div class="chat-input">      
      <form>
        <input type="text" id="chat-input" placeholder="Send a message..."/>
      <button type="submit" class="chat-submit" id="chat-submit"><i class="material-icons">send</i></button>
      </form>      
    </div>
  </div>
</div>

</body>
</html>

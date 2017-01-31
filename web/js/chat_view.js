 // This object will be sent everytime you submit a message in the sendMessage function.
    
    // START SOCKET CONFIG
    /**
     * Note that you need to change the "127.0.0.1" for the URL of your project. 
     * According to the configuration in Sockets/Chat.php , change the port if you need to.
     * @type WebSocket
     */

    conn.onopen = function(e) {
        console.info("Connection established succesfully");
    };

    conn.onmessage = function(e) {
        var data = JSON.parse(e.data);
        Chat.appendMessage(data.user_psedo, data.message);
        
        console.log(data);
    };
    
    conn.onerror = function(e){
        alert("Error: Unable to connect to the chat server.");
        console.error(e);
    };
    // END SOCKET CONFIG
   
    
    /// Some code to add the messages to the list element and the message submit.
    document.getElementById("form-submit").addEventListener("click",function(){
        var msg = document.getElementById("form-message").value;
        
        if(!msg){
            alert("Please send something on the chat");
        }
        
        Chat.sendMessage(msg);
        // Empty text area
        document.getElementById("form-message").value = "";
    }, false);
    
    // Mini API to send a message with the socket and append a message in a chat-list element.
    var Chat = {
        appendMessage: function(user_psedo,message){
            var from;
            
            if(user_psedo == clientInformation.user_psedo){
                from = "me";
                Msg.registerMsg(clientInformation.conv_id, clientInformation.user_id, clientInformation.message);
            }else{
                from = user_psedo;
            }
            
            // Append List Item
            var msg_content = document.getElementById("chat-list");
            var div = document.createElement("div");
            if(from == "Me"){
            	div.className = "conv_msg_me";
            }
            else{
            	div.className = "conv_msg_other";
            }
            div.appendChild(document.createTextNode(from + " (" + new Date().toLocaleString() + ") : "+ message));
            msg_content.appendChild(div);
            msg_content.scrollTop = msg_content.scrollHeight;
            
           
        },
        sendMessage: function(text){
            clientInformation.message = text;
            // Send info as JSON
            conn.send(JSON.stringify(clientInformation));
            // Add my own message to the list
            this.appendMessage(clientInformation.user_psedo, clientInformation.message);
        }
    };
    
    var Msg ={
    	registerMsg: function (conv_id,user_id,message){
    		 $.ajax({
    	          'url': 'push_msg:' +  conv_id + ':' +  user_id + ':' + message,
    	          success: function(data) {
    	             //(success) do something...
    	             //variable "data" contains data returned by the controller. 
    	          }
    	       });
    	}
    };
    function showInvite(){  
        //document.cookie = 'MCEvilPopupClosed=;path=/;expires=Thu, 01 Jan 1970 00:00:00 UTC;';  
        require(["mojo/signup-forms/Loader"], function(L) {  
            L.start({"baseUrl":"mc.us9.list-manage.com",  
                "uuid":"CHANGE ME",  
                "lid":"CHANGE ME"});   
        });  
    } 
    
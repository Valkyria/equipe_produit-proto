 // This object will be sent everytime you submit a message in the sendMessage function.
    /*var clientInformation = {
        user_psedo: new Date().getTime().toString()
        // You can add more information in a static object
    };*/
    
    // START SOCKET CONFIG
    /**
     * Note that you need to change the "127.0.0.1" for the URL of your project. 
     * According to the configuration in Sockets/Chat.php , change the port if you need to.
     * @type WebSocket
     */
    //var conn = new WebSocket('ws://127.0.0.1:8080/2');

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
    
    // Mini API to send a message with the socket and append a message in a UL element.
    var Chat = {
        appendMessage: function(user_psedo,message){
            var from;
            
            if(user_psedo == clientInformation.user_psedo){
                from = "me";
            }else{
                from = user_psedo;
            }
            
            // Append List Item
            var ul = document.getElementById("chat-list");
            var li = document.createElement("li");
            li.appendChild(document.createTextNode(from + " : "+ message));
            ul.appendChild(li);
            //TODO push to DB
        },
        sendMessage: function(text){
            clientInformation.message = text;
            // Send info as JSON
            conn.send(JSON.stringify(clientInformation));
            // Add my own message to the list
            this.appendMessage(clientInformation.user_psedo, clientInformation.message);
        }
    };
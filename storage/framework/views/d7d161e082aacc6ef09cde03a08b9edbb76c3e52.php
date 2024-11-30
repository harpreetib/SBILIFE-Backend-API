
<script>

function openchat() {
    
    Talk.ready.then(function () {
		var me = new Talk.User({
            id: '<?php echo $profileDetail->exhim_id;?>b2bexpo',
            name: '<?php echo $profileDetail->exhim_organization_name;?>',
            email: '<?php echo $profileDetail->exhim_contact_email;?>',
			role: 'user',
		});
		window.talkSession = new Talk.Session({
			appId: '6SG5GBvc',
			me: me,
		
		});
		
		var inbox = talkSession.createInbox({});
    inbox.mount(document.getElementById('talkjs-container'));
		});


 
    $('#chat-box1').css('display','block');
    $('.chat-button').css('display','block');
    
}

Talk.ready.then(function () {
		var me = new Talk.User({
            id: '<?php echo $profileDetail->exhim_id;?>b2bexpo',
            name: '<?php echo $profileDetail->exhim_organization_name;?>',
            email: '<?php echo $profileDetail->exhim_contact_email;?>',
			role: 'user',
		});
		window.talkSession = new Talk.Session({
			appId: '6SG5GBvc',
			me: me,
			
		});
	

	talkSession.unreads.on('change', function (unreadConversations) {
  var amountOfUnreads = unreadConversations.length;
  
  // update the text and hide the badge if there are
  // no unreads.
  $('#notifier-badge')
    .text(amountOfUnreads)
    .toggle(amountOfUnreads > 0);

  // update the tab title so users can easily see that they have
  // messages waiting
  if (amountOfUnreads > 0) {
    document.title = '(' + amountOfUnreads + ') New Message';
  } else {
    document.title = 'Virtual VAC 2022';
  }
});

		});


    function startChat(lemmid,name,email) {
     
    
    //var usrId = lemmid+'vac2022';
     
      
            usrId = 'USER'+lemmid+'b2bexpo';
        

        Talk.ready.then(function () {
    var me = new Talk.User({
      id: '<?php echo $profileDetail->exhim_id;?>b2bexpo',
      name: '<?php echo $profileDetail->exhim_organization_name;?>',
      email: '<?php echo $profileDetail->exhim_contact_email;?>',
      role: 'exhibitor',
    });
    window.talkSession = new Talk.Session({
      appId: '6SG5GBvc',
      me: me,
    	
    });

    var other = new Talk.User({
        id: usrId,
        name: name,
        email: email,
        role: 'visitor',
      });
  
    var conversation = talkSession.getOrCreateConversation(
      Talk.oneOnOneId(me, other)
    );
    

    conversation.setParticipant(me);
    conversation.setParticipant(other);
    var inbox = talkSession.createInbox({ selected: conversation });
    inbox.mount(document.getElementById('talkjs-container'));
    $('.chat-button').css('display','block');
    
  });

  $('#chat-box1').css('display','block');
  
    $('#chat-box1').css('display','block');
    
    
  
  
    }


    function closeChat() {
            $('#chat-box1').css('display','none');
            
     }
     
     
     
     

    </script><?php /**PATH /home/megaspace/public_html/admin/resources/views/layouts/talkjs.blade.php ENDPATH**/ ?>
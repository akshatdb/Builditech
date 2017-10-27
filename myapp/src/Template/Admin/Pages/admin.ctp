				<section class="wrapper style1">
					<div class="container">
						<div class="row 200%">
							<div class="3u 12u(narrower)">
								<div id="sidebar1">

									<!-- Sidebar 1 -->

										<section>
											<h3>Manage Customers</h3>
											<ul class="links">
												<li><?= $this->Html->link('Add Booking',['prefix'=>false,'controller' =>'Bookings','action'=>'add'],['class' => 'button alt link-btn']); ?></li>
												<li><?= $this->Html->link('List All Bookings',['controller' =>'Bookings','action'=>'index'],['class' => 'button alt link-btn']); ?></li>		
											</ul>
										</section>

										<section>
                                            <div class="quick-task">
											<h3>Quick Tasks</h3>
											<ul class="links">
												<li><input type="text" id="print-id" placeholder="Booking ID"/></li>
												<li><a class="button alt link-btn" id="print-btn">Print Reciept</a></li>	
											</ul>
                                            </div>
                                            <h3>Send Mail</h3>
                                            <ul class="links">
                                                <li><input type="text" id="mail-id" placeholder="Email ID"/></li>
                                                <li><textarea style="margin-top:10px" id="mail-body" placeholder="Message"></textarea></li>
                                                <li id="send-mail-response"></li>
                                                <li id="send-mail-li"><a class="button alt link-btn" id="send-mail">Send Mail</a>
                                                	<center><img id="send-mail-load" src="/images/loading.gif" class="loading-gif"/><center></li>    
                                            </ul>
										</section>

								</div>
							</div>
							<div class="6u 12u(narrower) important(narrower)">
								<div id="content">
										<article>
											<header>
												<h2>Admin Panel</h2>
												<p>Page to manage Projects,Bookings and Agents</p>
											</header>

											<h3>Contact Requests</h3>
											<div id="contactList"><center><img src='/images/loading.gif' class='loading-gif'/><center></div>
											<h3>Pending Request</h3>
											<div id="bookingList"><center><img src='/images/loading.gif' class='loading-gif'/><center></div>
										</article>

								</div>
							</div>
							<div class="3u 12u(narrower)">
								<div id="sidebar2">

									<!-- Sidebar 2 -->

										<section>
											<h3>Manage Projects</h3>
											<ul class="links">
												<li><a href="../admin/projects/add" class= "button alt link-btn">Add a new Project</a></li>
												<li><a href="../admin/projects/index" class= "button alt link-btn">See and Edit Projects</a></li>
												<li><a href="../admin/images/manage" class= "button alt link-btn">Delete Projects Images</a></li>
                                                <li><a href="../admin/videos/manage" class= "button alt link-btn">Delete Projects Videos</a></li>
											</ul>
										</section>

										<section>
											<h3>Manage Users</h3>
											<ul class="links">
												<li><?= $this->Html->link('Add Agent',['controller' =>'users','action'=>'register','agent'],['class' => 'button alt link-btn']); ?></li>
												<li><?= $this->Html->link('Add Admin',['controller' =>'users','action'=>'register','admin'],['class' => 'button alt link-btn']); ?></li>
												<li><?= $this->Html->link('Manage Agents',['controller' =>'users','action'=>'index','agent'],['class' => 'button alt link-btn']); ?></li>
												<li><?= $this->Html->link('Manage Admins',['controller' =>'users','action'=>'index','admin'],['class' => 'button alt link-btn']); ?></li>
											</ul>
										</section>
                                        <section>
                                            <h3>Manage Website</h3>
                                            <ul class="links">
                                                <li><?= $this->Html->link('Add Gallery Images',['controller' =>'galleryimages','action'=>'add'],['class' => 'button alt link-btn']); ?></li>
                                                <li><?= $this->Html->link('Delete Gallery Images',['controller' =>'galleryimages','action'=>'manage'],['class' => 'button alt link-btn']); ?></li>
                                            </ul>
                                        </section>

								</div>
							</div>
						</div>
					</div>
				</section>
				    <script>
            function setBookingList(query){$.ajax({
                    type: "POST",
                    header: {'X-CSRF-TOKEN' : this.csrfToken},
                    url: query,
                    data: {
                        "_csrfToken": '<?= $this->request->params['_csrfToken'] ?>'
                        },
                    success: function(data){
                    	$('#bookingList').hide().html(data).fadeIn();
                    	setTooltips();
                    	setPaginator();
                    }
                        ,
                    dataType: 'html'
                });}
           function setContactList(query){ $.ajax({
                    type: "POST",
                    header: {'X-CSRF-TOKEN' : this.csrfToken},
                    url: query,
                    data: {
                        "_csrfToken": '<?= $this->request->params['_csrfToken'] ?>'
                        },
                    success: function(data){
                    	$('#contactList').hide().html(data).fadeIn();
                    	setTooltips();
                    	setPaginator();
                    	$('.message-body').hide();
                    	$('.message-btn').click(function(){
                    			$('#myMessage').fadeToggle();
                    			$('.message-modal-content').html($(this).next().html());
    					});
    					$('.close-modal').click(function(event){
    						$('#myMessage').fadeToggle();
    					});
                        $('.email-id-col').click(function(){
                            var idmail = $(this).html();
                            $('#mail-id').val(idmail);
                        });
                    }
                        ,
                    dataType: 'html'
                });}
       setBookingList('/admin/bookings/listBookings');
       setContactList('/admin/contact/listContacts');
       function setPaginator(){ $('.booking-paginate a').click(function(event){
        	event.preventDefault();
        	if($(this).attr('href')){
            $('#bookingList').html("<center><img src='/images/loading.gif' class='loading-gif'/><center>");
        	setBookingList($(this).attr('href'));}});
       $('.contact-paginate a').click(function(event){
        	event.preventDefault();
        	if($(this).attr('href'))
            {
            $('#contactList').html("<center><img src='/images/loading.gif' class='loading-gif'/><center>");
        	setContactList($(this).attr('href'));}});
        }
        function setTooltips(){$('.tooltiptext').hide();
        $('.tooltip').mouseover(function(){
            $(this).next().show();
        }).mouseout(function(){
            $(this).next().hide();
        });}
        
        setTooltips();
        function closePrint () {
                document.body.removeChild(this.__container__);
        }
        function setPrint () {
              this.contentWindow.__container__ = this;
              this.contentWindow.onbeforeunload = closePrint;
              this.contentWindow.onafterprint = closePrint;
              this.contentWindow.focus(); // Required for IE
              this.contentWindow.print();
        }
        function doPrint(){ 
                        var oHiddFrame = document.createElement("iframe");
                        oHiddFrame.onload = setPrint;
                        oHiddFrame.style.visibility = "hidden";
                        oHiddFrame.style.position = "fixed";
                        oHiddFrame.style.right = "0";
                        oHiddFrame.style.bottom = "0";
                        oHiddFrame.src = '/admin/bookings/print/'+ $('#print-id').val();
                        document.body.appendChild(oHiddFrame);
        }
        $('#print-btn').click(doPrint);
        $('#send-mail-load').hide();
        $('#send-mail-response').hide();
        function sendMail(){
        	$('#send-mail').hide();
        	$('#send-mail-load').show();;
            $.ajax({
                    type: "POST",
                    header: {'X-CSRF-TOKEN' : this.csrfToken},
                    url: '/admin/contact/sendMail',
                    data: {
                        "mailid": $('#mail-id').val(),
                        "mailbody": $('#mail-body').val(),
                        "_csrfToken": '<?= $this->request->params['_csrfToken'] ?>'
                        },
                    success: function(data){
                    	$('#send-mail-load').hide();
                    	$('#send-mail').show();
                        $('#send-mail-response').html(data['message']);
  	                    if(data['code'] == 1)
                    		$('#send-mail-response').css({'background-color':'#17a228'});
                    	else
                    		$('#send-mail-response').css({'background-color':'#cf1616'});
                        $('#send-mail-response').fadeIn().delay(1000).fadeOut();
                    }
                        ,
                    dataType: 'json'
                });
        }
        $('#send-mail').click(sendMail);
    </script>

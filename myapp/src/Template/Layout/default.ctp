<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        BuildiTech
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('main.css') ?>
    <?= $this->Html->css('fotorama.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->script('jquery.min.js') ?>
    <?= $this->Html->script('fotorama.js') ?>
</head>
 
        <body>
        <?= $this->Flash->render() ?>
        <div id="page-wrapper">

            <!-- Header -->
                <div id="header">

                    <!-- Logo -->
                        <h1><a href="/home" id="logo">Buildi<em>Tech</em></a></h1>

                    <!-- Nav -->
                        <nav id="nav">
                            <ul>
                                <li><a href="/home">Home</a></li>
                                <li><a href="/gallery">Gallery</a></li> 
                                <li><a href="/home/#board">Management</a></li>
                                <li>
                                  <a href="#">Projects</a>
                                    <ul>
                                      <?php $projects = Cake\ORM\TableRegistry::get('Projects')->find('all')->all();?>
                                      <?php foreach($projects as $project): ?>
                                          <li><?= $this->Html->link($project->project_name,['prefix' => false, 'controller' => 'projects', 'action' => 'view',$project->id]); ?></li>
                                      <?php endforeach; ?>
                                    </ul>
                                </li>
                                <li><a href="/about">About</a></li>
                                <li>
                                    <a href="#">More</a>
                                    <ul>
                                        <?php if($userRole === 'admin') : ?>
                                        <li><?= $this->Html->link('Admin Panel', ['prefix' => 'admin', 'controller' => 'Pages', 'action' => 'display','admin']); ?></li>
                                        <?php endif; ?>
                                          <?php if($loggedIn): ?>
                                          <li><?= $this->Html->link('New Booking', ['prefix' => false, 'controller' => 'Bookings', 'action' => 'add']); ?></li>
                                          <?php endif; ?>
                                        <li><?= $this->Html->link('Privacy Policy', ['prefix' => false, 'controller' => 'Pages', 'action' => 'display','privacy']); ?></li>
                                        <?php if($loggedIn) : ?>
                                        <li><?= $this->Html->link('Logout', ['prefix'=>false,'controller' => 'users', 'action' => 'logout']); ?></li>
                                        <?php else : ?>
                                          <li><?= $this->Html->link('Login', ['prefix'=>false,'controller' => 'users', 'action' => 'login']); ?></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>

                            </ul>
            </nav>

        </div>

        <?= $this->fetch('content') ?>
             <!-- Footer -->
        <div id="footer">
                        </section>
          <div class="container">
            <div class="row">
              <section class="3u 6u(narrower) 12u$(mobilep)">
                <h3>Links to Stuff</h3>
                <ul class="links">
                  <li><a href="#">Mattis et quis rutrum</a></li>                
                  <li><a href="#">Suspendisse amet varius</a></li>
                  <li><a href="#">Sed et dapibus quis</a></li>
                  <li><a href="#">Rutrum accumsan dolor</a></li>
                  <li><a href="#">Mattis rutrum accumsan</a></li>
                  <li><a href="#">Suspendisse varius nibh</a></li>
                  <li><a href="#">Sed et dapibus mattis</a></li>
                </ul>
              </section>
              <section class="3u 6u$(narrower) 12u$(mobilep)">
                <h3>More Links to Stuff</h3>
                <ul class="links">
                  <li><a href="#">Duis neque nisi dapibus</a></li>
                  <li><a href="#">Sed et dapibus quis</a></li>
                  <li><a href="#">Rutrum accumsan sed</a></li>
                  <li><a href="#">Mattis et sed accumsan</a></li>
                  <li><a href="#">Duis neque nisi sed</a></li>
                  <li><a href="#">Sed et dapibus quis</a></li>
                  <li><a href="#">Rutrum amet varius</a></li>
                </ul>
              </section>
              <section class="6u 12u(narrower)">
                <h3>Get In Touch</h3>
                <div style="display:absolute" id="contactus" ></div>
                <?= $this->Form->create('Contact', array('url' => 'Contact/add')); ?>
                  <div class="row 100%">
                    <div class="12u 12u(mobilep)">
                      <?= $this->Form->control('name',array('placeholder' => 'Name', 'label' => false, 'required' => true));?>
                    </div>
                  </div>
                  <div class="row 50%">
                    <div class="6u 12u(mobilep)">
                      <?= $this->Form->control('email',array('placeholder' => 'Email', 'label' => false, 'required' => true));?>
                    </div>
                    <div class="6u 12u(mobilep)">
                      <?= $this->Form->control('contact',array('placeholder' => 'Contact Number', 'label' => false, 'required' => true, 'maxlength' => 12,'minlength' => 10));?>
                    </div>                    
                  </div>
                  <div class="row 50%">
                    <div class="12u">
                      <?= $this->Form->control('body',array('type' => 'textarea', 'placeholder' => 'Message', 'label' => false, 'required' => true));?>
                    </div>
                  </div>
                  <div class="row 50%">
                    <div class="12u">
                      <ul class="actions">
                        <li><?= $this->Form->control('Submit',array('type'=>'submit','class'=>'button alt')) ?></li>
                      </ul>
                    </div>
                  </div>
                <?= $this->Form->end() ?>
            </div>
          </div>

          <!-- Icons -->
            <ul class="icons">
              <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
              <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
              <li><a href="#" class="icon fa-github"><span class="label">GitHub</span></a></li>
              <li><a href="#" class="icon fa-linkedin"><span class="label">LinkedIn</span></a></li>
              <li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
            </ul>

          <!-- Copyright -->
            <div class="copyright">
              <ul class="menu">
                <li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
              </ul>
            </div>

        </div>

    </div>
    <div id="myMessage" class="modal">
      <div class="modal-content set-box">
        <h1>Message</h1>
        <p class="message-modal-content"></p>
        <a class="close-modal close-btn"><i class="fa fa-close"></i></a>
      </div>
    </div>
    <div id="myModal" class="modal">
      <div class="modal-content">
      <p><h1>DISCLAIMER</h1>
1)
Thank you for visiting our website.
We are currently in the process of revising our website in consonance with the Real Estate (Regulation and Development) Act, 2016 and the Rules made thereunder (“RERA”), which have been brought into effect from 1st May, 2017.
Until our website is duly revised and updated, none of the images, material, stock photography, projections, details, descriptions and other information that are currently available and/or displayed on the website, should be deemed to be or constitute advertisements, solicitations, marketing, offer for sale, invitation to offer, invitation to acquire, including within the purview of the RERA.
You are therefore requested to directly verify all details and aspects of any proposed booking/acquisition of units/premises, directly with our authorised representatives. Please do not rely on the information contained on this website, until our revision and updation is complete.




2)
This disclaimer ("Disclaimer") will be applicable to the Website. By using or accessing the Website you agree with the Disclaimer without any qualification or limitation. The Company reserves the right to add, alter or delete material from the Website at any time and may, at any time, revise these Terms without notifying you. You are bound by any such amendments and the Company therefore advise that you periodically visit this page to review the current Terms.
The Websites and all its content are provided with all faults on an "as is" and "as available" basis. No information given under this Website creates a warranty or expand the scope of any warranty that cannot be disclaimed under applicable law. Your use of the Website is solely at your own risk. This website is for guidance only. It does not constitute part of an offer or contract. Design & specifications are subject to change without prior notice. Computer generated images are the artist's impression and are an indicative of the actual designs.
The particulars contained on the mentions details of the Projects/developments undertaken by the Company including depicting banners/posters of the Project. The contents are being modified in terms of the stipulations / recommendations under the Real Estate Regulation and Development Act, 2016 and Rules made thereunder ("RERA") and accordingly may not be fully in line thereof as of date. We shall sincerely try to update the changes and place the same on this website for your convenience but we do not guarantee about its being complete in all respects. You are therefore required to verify all the details, including area, amenities, services, terms of sales and payments and other relevant terms independently with the sales team/ company prior to concluding any decision for buying any unit(s) in any of the said projects. Till such time the details are fully updated, the said information will not be construed as an advertisement. To find out more about a project / development, please telephone our sales centres or visit our sales office during opening hours and speak to one of our sales staff.
In no event will the Company be liable for claim made by the users including seeking any cancellation for any of the inaccuracies in the information provided in this Website, though all efforts have to be made to ensure accuracy. The Company will in no circumstance will be liable for any expense, loss or damage including, without limitation, indirect or consequential loss or damage, or any expense, loss or damage whatsoever arising from use, or loss of use, of data, arising out of or in connection with the use of this website.</p>
      <center><button class="accept button">Accept</button></center>
    </div>

</div>

    <!-- Scripts -->
      <?= $this->Html->script('jquery.dropotron.min.js') ?>
      <?= $this->Html->script('skel.min.js') ?>
      <?= $this->Html->script('util.js') ?>
      <?= $this->Html->script('main.js') ?>
      <script>
      var reg = /.+\:\/\/.+\/(\w+)/;
      var a = $(location).attr('href');
      var str = reg.exec(a);
      if(str!=null)
      {
            var sel = 'a[href$="'+str[1]+'"]'
            $(sel).parent().addClass('current');
        }
      </script>
      <script>
      $.getScript('https://cdn.rawgit.com/js-cookie/js-cookie/v2.1.2/src/js.cookie.js', function() {
      if(Cookies.get('notice') === undefined) {
        var modal = document.getElementById('myModal');
        var btn = document.getElementById("myBtn");
        var accept = document.getElementsByClassName("accept")[0];
        accept.onclick = function() {
            modal.style.display = "none";
            $('.toggle').show();
        }
        $(document).ready(function(){
            modal.style.display = "block";
            $('.toggle').hide();
        });
      }
      else{
        $('#myModal').remove();
      }
      $('.accept').click(function() {
      Cookies.set('notice', 'shown');
      });});
      </script>
  </body>
</html>
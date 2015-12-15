  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Misspelled Desktop Icons Collection</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <meta property="og:title" content="Misspelled Desktop Icons Collection" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="The earliest known image compilation of hand-drawn icons can be found in a 4chan thread dating back to November 30th, 2007. The OP began the thread with a rather poorly drawn Google site logo and the misspelled caption Gouleg. Status, confirmed, year 2008, origin 4chan, tags 4chan, wurds, ms, paint, ms paint, misspelled, desktop, icons, about, mS Paint Desktop Icons (also known as Misspelled Desktop Icons) refers to a series of hand-drawn computer icons with intentional spelling errors created by using basic image editors like MS Paint. The thread came to be also known by alternative names like Draw Desktop Icon in 30 seconds. The practical usage of such icons outside of 4chan threads remains little documented, but their aesthetics and nostalgic value seem to be the main appeals."
    />
    <meta property="og:image" content="elp-n-suppor.png" />

    <!-- Bootstrap core CSS + personnalisation + Bootstrap3 dialog CSS -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  
      <?php
          //handle exceeded limit
          if ( $_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST) &&
           empty($_FILES) && $_SERVER['CONTENT_LENGTH'] > 0 )
          {
            $displayMaxSize = ini_get('post_max_size');

            switch ( substr($displayMaxSize,-1) )
            {
            case 'G':
              $displayMaxSize = $displayMaxSize * 1024 * 1024;
            case 'M':
              $displayMaxSize = $displayMaxSize * 1024;
            case 'K':
               $displayMaxSize = $displayMaxSize;
            }
            echo "<script>BootstrapDialog.show({title: 'Oops..', message: 'SERVER UPLOAD LIMIT EXCEEDED<br>".round((($_SERVER['CONTENT_LENGTH']) / 1024), 2)." Ko exceeds the maximum size of ".$displayMaxSize." Ko'});</script>";
            die();
          }
          // contribution sent
          if(isset($_POST['formemail'])) {
              $files = array();
              // loop through all the files
              foreach($_FILES as $name=>$file) {
                  // define variables
                  $file_name = $file['name'];
                  $temp_name = $file['tmp_name'];
                  $path_parts = pathinfo($file_name);
                  // move the file to server
                  $server_file = "$path_parts[basename]";
                  if ($_POST['formiconname']!=""){
                      //$extension = end(explode(".", $server_file));
                      $server_file = $_POST['formiconname'].".".$path_parts['extension'];
                  }
                  while(is_file('contribution/' . $server_file)) {
                      $server_file = preg_replace_callback(
                          '/(?:(?: \(([\d]+)\))?(\.[^.]+))?$/',
                          function ($match) {
                              $index  = isset($match[1]) ? intval($match[1]) + 1 : 1;
                              $ext    = isset($match[2]) ? $match[2] : '';
                              return ' ('.$index.')' . $ext;
                          },
                          $server_file, 1
                      );
                  }
                  if (preg_match("/\.(jpg|jpeg|png|gif|svg)(?:[\?\#].*)?$/i",$server_file)){
                    move_uploaded_file($temp_name, 'contribution/'.$server_file);
                    $badfile = false;
                  }else{
                    $badfile = true;
                  }

                  // add file to arrays
                  array_push($files,$server_file);
              }
            }
          ?>

  <body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="#" id="contributionlink">Contributions <span class="badge">42</span></a>
            </li>
            <li>
              <a href="#" id="collectionlink" class="nolink">In this collection <span class="badge">42</span></a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container spacer">
      <!-- Intro -->
      <div class="row">
        <h1>Misspelled Desktop Icons Collection</h1>
        <br>
        <!-- visible -->
        <div class="collection">
          <blockquote>
            <p>The earliest known image compilation of hand-drawn icons can be found in a 4chan thread dating back to November 30th, 2007. The OP began the thread with a rather poorly drawn Google site logo and the misspelled caption Gouleg. Status, confirmed,
              year 2008, origin 4chan, tags 4chan, wurds, ms, paint, ms paint, misspelled, desktop, icons, about, mS Paint Desktop Icons (also known as Misspelled Desktop Icons) refers to a series of hand-drawn computer icons with intentional spelling errors
              created by using basic image editors like MS Paint. The thread came to be also known by alternative names like Draw Desktop Icon in 30 seconds. The practical usage of such icons outside of 4chan threads remains little documented, but their
              aesthetics and nostalgic value seem to be the main appeals.</p>
            <small><a href="http://knowyourmeme.com/memes/ms-paint-desktop-icons" target="_blank">knowyourmeme</a></small>
          </blockquote>
          <div class="col-lg-12">
            <a class="btn btn-default" href="http://www.github.com/jckleinbourg/misspelleddesktopicons" target="_blank">Download whole archive on GitHub</a>
            &nbsp;or&nbsp;
            <a class="btn btn-default" data-toggle="modal" href="#modalForm">Send a contribution</a>
          </div>
        </div>
        <!-- hidden -->
        <div class="contribution">
            <h2>Contributions uploaded</h2><h4 class="red">(awaiting moderation)</h4>
        </div>
      </div>

      <!-- Main content -->
      <div class="row spacer collection">
        <?php
				$counter = 0;
				$rowcounter = 0;
				$dir = opendir("collection");
				$list = array();
				while ($filename = readdir($dir)){
				   if (preg_match("#.(png)$#i",$filename)){
					 array_push($list,$filename);
				   }
				}
				foreach($list as $key => $filename_png){
					$filename_extionsionless = substr($filename_png,0,strlen($filename_png)-4);
					$filename_ico = $filename_extionsionless.".ico";
					$filename_svg = $filename_extionsionless.".svg";
					$title = str_replace( '-', ' ', $filename_extionsionless);
					$counter++;
					$rowcounter++;
					?>
          <div class="col-xs-1 text-center">
            <div class="icon">
              <div class="flyout">
                <div class="btn-group-vertical">
                  <?php
									echo "<a class='btn btn-default btn-xs' href='collection/".$filename_ico."' download>.ico</a>";
									echo "<a class='btn btn-default btn-xs' href='collection/".$filename_png."' download>.png</a>";
									echo "<a class='btn btn-default btn-xs' href='collection/".$filename_svg."' download>.svg</a>";
									?>
                </div>
              </div>
              <?php echo "<img src='collection/".$filename_png."' class='img-responsive'>" ?>
            </div>
            <h5>
              <?php echo $title ?>
                </title>
            </h5>
          </div>
          <?php
						if ($rowcounter == 12){
							$rowcounter = 0;
							?>
      </div>
      <div class="row collection">
        <?php
						}
					}
					closedir ($dir);
				 	?>
      </div>
      <!-- /row -->

      <!-- Contribution -->
      <div class="row spacer contribution">
        <?php
				$contcounter = 0;
				$rowcounter = 0;
				$dir = opendir("contribution");
				$list = array();
				while ($filename = readdir($dir)){
				   if (preg_match("/\.(jpg|jpeg|png|gif|svg)(?:[\?\#].*)?$/i",$filename)){
					 array_push($list,$filename);
				   }
				}
				foreach($list as $key => $filename){
					$filename_extionsionless = substr($filename,0,strlen($filename)-4);
					$contcounter++;
					$rowcounter++;
					?>
          <div class="col-xs-2 text-center">
            <?php echo "<img src='contribution/".$filename."' class='img-responsive'>" ?>
            <h5>
              <?php echo $filename_extionsionless ?>
                </title>
            </h5>
          </div>
          <?php
						if ($rowcounter == 6){
							$rowcounter = 0;
							?>
      </div>
      <div class="row contribution">
        <?php
						}
					}
					closedir ($dir);
				 	?>
      </div>
      <!-- /row -->

      <!-- Some footer -->
      <footer>
        <div class="row spacer">
          <div class="col-lg-12">
            <p>Website by <a href="http://jck.smalk.co" target="_blank">jck.smalk.co</a>.</p>
          </div>
        </div>
      </footer>

    </div>
    <!-- /container -->

    <!-- The modals -->
    <div class="modal" id="modalForm">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Contribute</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" method="POST" action="index.php" autocomplete="on" enctype="multipart/form-data" accept-charset="utf-8">
              <div class="col-sm-10 col-sm-offset-1">
                <div class="form-group">
                  <label>Your name</label>
                  <input type="text" class="form-control" name="formname"/>
                </div>
                <div class="form-group required">
                  <label class="ctrl">Your email</label>
                  <input type="email" class="form-control" name="formemail" placeholder="Email" required/>
                  <span class="help-block">Email will only be used to notify you when your contribution will be online.</span>
                </div>
                <div class="form-group fileupload">
                  <label>Image file</label>
                  <br>
                  <span class="btn btn-default btn-file">Browse
                    <input name="filebutton" id="file" type="file" accept="image/jpeg,image/gif,image/x-png" allow="image/jpeg,image/gif,image/x-png" onchange='$("#upload-file-info").html($(this).val());' /> &nbsp;
                    <span class='label label-primary' id="upload-file-info"></span>
                  </span>
                  <span class="help-block">Max. size: 2Mo | jpg, png, gif or svg</span>
                </div>
                <div class="form-group">
                  <label>Misspelled icon name</label>
                  <input type="text" class="form-control" name="formiconname" placeholder="Misspelled name of the icon" />
                </div>
                <div class="form-group">
                  <label for="textArea">Message</label>
                  <textarea class="form-control" rows="4" name="formmessage"></textarea>
                  <span class="help-block">This field is optional, you can provide links or any other additional information about your contributrion.</span>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Send</button>
                </div>
              </div>
              <div class="modal-footer" />
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- jQuery & Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!-- Bootstrap3 dialog JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js" crossorigin="anonymous"></script>
    <script>
      document.addEventListener("dragstart", preventDrag);
      function preventDrag(event) {
        event.preventDefault();
      }

      $('#collectionlink .badge').html("<?php echo $counter ?>");

      $('#contributionlink .badge').html("<?php echo $contcounter ?>");
      if(<?php echo $contcounter ?> > 0){
        $('#contributionlink').css("display","block");
        $('#collectionlink').removeClass("nolink");
        $('#collectionlink').parent().addClass("active");
      }
      $('#contributionlink').click(function() {
          $('.collection').hide();
          $('.contribution').show();
          $('#contributionlink').parent().addClass("active");
          $('#collectionlink').parent().removeClass("active");
      });
      $('#collectionlink').click(function() {
          $('.collection').show();
          $('.contribution').hide();
          $('#contributionlink').parent().removeClass("active");
          $('#collectionlink').parent().addClass("active");
      });

      $(".nolink").css("pointer-events", "none");

      $(".icon").hover(function() {
        $(this).find('.img-responsive').css("opacity", "0.35");
        $(this).find('.flyout').css({
          'z-index': '1'
        });
        $(this).find('.flyout').show();
        $(this).find('.flyout').css({
          'top': (($(this).find('.img-responsive').height()) - ($(this).find('.btn-group-vertical').height())) / 2
        });
        $(this).find('.flyout').css({
          'padding-left': (($(this).find('.img-responsive').width()) - ($(this).find('.btn-group-vertical').width())) / 2
        });
      }, function() {
        $(this).find('.flyout').hide();
        $(this).find('.img-responsive').css("opacity", "1");
      });

      document.forms[0].addEventListener('submit', function(evt) {
      var file = document.getElementById('file').files[0];
      if(file && file.size > 2097152){// 2 MB (this size is in bytes)
              BootstrapDialog.show({title: 'Oops..', message: 'UPLOAD LIMIT EXCEEDED<br>'+Math.round(file.size/1048576)+' Mo exceeds the maximum size of 2 Mo'});
              evt.preventDefault();
          }
      }, false);
    </script>
  </body>

  </html>

    <?php
        if($badfile){
              echo "<script>BootstrapDialog.show({title: 'Oops..',message: 'Your attachment is not an image.'});</script>";
              die();
        }
        // contribution sent
        if(isset($_POST['formemail'])) {
            // email fields: to, from, subject, and so on
            $name = $_POST['formname'];
            $to = "jckleinbourg@gmail.com";
            $from = $_POST['formemail'];
            $iconname = $_POST['formiconname'];
            $subject = "Contribution à Misspelled Desktop Icons";
            $msg = $_POST['formmessage'];
            $error_message = "";
            $headers = 'From: jck@smalk.co'."\r\n".
                'Reply-To: '.$from."\r\n" .
                'X-Mailer: PHP/' . phpversion();
            // Message before mail
            $mail_message = "Contribution à Misspelled Desktop Icons\n\n";
            function clean_string($string) {
                $bad = array("content-type","bcc:","to:","cc:","href");
                return str_replace($bad,"",$string);
            }
            $mail_message .= "Nom: ".clean_string($name)."\n";
            $mail_message .= "Adresse e-mail: ".clean_string($from)."\n";
            $mail_message .= "Icon name: ".clean_string($iconname)."\n";
            $mail_message .= "Message: ".clean_string($msg)."\n";
            // boundary
            $semi_rand = md5(time());
            $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
            // headers boundary
            $headers .= "\nMIME-Version: 1.0\n";
            $headers .= "Content-Type: multipart/mixed;\n";
            $headers .= " boundary=\"{$mime_boundary}\"";
            // headers plain
            $message ="\n\n--{$mime_boundary}\n";
            $message .="Content-Type: text/plain; charset=\"iso-8859-1\"\n";
            $message .="Content-Transfer-Enconding: 7bit\n\n" . $mail_message . "\n\n";
            $message .= "--{$mime_boundary}\n";
            // loop
            foreach($files as $file) {
              if ($file){
                $aFile = fopen('contribution/'.$file,"rb");
                $data = fread($aFile,filesize('contribution/'.$file));
                fclose($aFile);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: {\"application/octet-stream\"};\n";
                $message .= " name=\"$file\"\n";
                $message .= "Content-Disposition: attachment;\n";
                $message .= " filename=\"$file\"\n";
                $message .= "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                $message .= "--{$mime_boundary}\n";
              }
            }
            // write message in txt format
            function slugify($text){
              $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
              $text = trim($text, '-');
              $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
              $text = strtolower($text);
              $text = preg_replace('~[^-\w]+~', '', $text);
              if (empty($text)){
                return 'n-a';
              }
              return $text;
            }
            $fp = fopen("contribution/".slugify($server_file."_".date('l jS \of F Y h:i:s A')).".txt","wb");
            fwrite($fp,$mail_message);
            fclose($fp);
            // send
            $ok = @mail($to, $subject, $message, $headers);
            /*
            if ($ok) {
                echo "<script>BootstrapDialog.show({title: 'Thank you!',message: 'Your contribution has been sent successfully.'});</script>";
            } else {
                echo "<script>BootstrapDialog.show({title: 'Oops..', message: \"MAIL SERVER ERROR<br>Your message has not been sent. If the issue persists, please contact the <a href='mailto:jckleinbourg@gmail.com'>webmaster</a>\"});</script>";
            }
            */
            echo "<script>BootstrapDialog.show({title: 'Thank you!',message: 'Your contribution has been sent successfully.'});</script>";
            die();
        }
      ?>

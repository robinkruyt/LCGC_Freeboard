<html>
<head>
  <style>
    html, body { margin: 0; padding: 0 ; }
    #content {
      margin: 2em auto; width: 800px; padding: 1em;
      font: 15px Arial, sans-serif; font-weight: lighter;
      border: 1px solid #ccc; background: #f0f0f0;
    }
    code { font-weight: bold; color: #292; }
  </style>
</head>
<body>
<div id="content">
  
  <div class="message">
  <h1>Mongoose for PHP Bundle</h1>
  <p>
  This is Mongoose for PHP Bundle, a pre-packaged distribution of
  <a href="http://cesanta.com/mongoose.shtml">Mongoose Web Server</a>
  together with PHP interpreter. This distribution is a development environment
  that takes single click to set up. It is also ideal for making presentations
  of PHP projects.
  To start working on your project or website, just copy your
  project/website files to <code>web_root</code>
  folder. Or start editing files from scratch.
  </p><p>
  If you have any comments or suggestions regarding Mongoose web server
  or this developer bundle, don't hesitate to
  <a href="http://cesanta.com/contact.shtml">drop us a message</a>. We
  take your feedback seriously.
  </p>

  <p>
  Happy hacking,<br>
  Cesanta Software team.</p>
  </div>
  
  <h1>
    <?php print("Hello from PHP!"); ?>
  </h1>

  <form method="POST">
    <input type="text" name="field1" value="some data" />
    <input type="submit" value="Click Me!" /> 
  </form>

  POST data dump:
  <pre><?php var_dump($_POST); ?></pre>

</div>
</body>
</html>

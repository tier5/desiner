<html>
  <head>
    <title>Meme Generator</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style></style>
    
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="{{url('/')}}/jquery-meme-generator-master/demo/colorpicker/spectrum.js"></script>
    <script type="text/javascript" src="{{url('/')}}/jquery-meme-generator-master/dist/jquery.memegenerator.min.js"></script>
<!--    <script type="text/javascript" src="../i18n/jquery.memegenerator.pl.js"></script> -->
    
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/jquery-meme-generator-master/dist/jquery.memegenerator.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/jquery-meme-generator-master/demo/colorpicker/spectrum.css">
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    
    <style>
    h2 {
      display: block;
      text-align: center;
    }
    
    .example {
      margin: 0 0 10% 0;
    }
    
    .bootstrap {
      width: 600px;
      margin-right: auto;
      margin-left: auto;
    }
    
    .save button {
      display: block;
      width: 100%;
      margin-bottom: 15px;
      font-size: 24px;
    }
    
    #preview {
      min-height: 200px;
      background-color: #EFEFEF;
    }
    #preview img {
      max-width: 100%;
    }
    </style>
  </head>
  
  <body>
  
    
    
    <div class="col-md-4" id="slider"></div>
    
    <div class="example save">
      
      <div class="example horizontal">
        <h2>Horizontal layout and CSS preview</h2>
        <img src="{{url('/')}}/jquery-meme-generator-master/demo/images/4.jpg">
      </div>
      
      
      <div id="toolbar"></div>
      
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <button class="btn btn-success" id="save">Save</button>
            <button class="btn btn-danger" id="download">Download</button>
          </div>
        </div>
      </div>
    </div>
  
    <script>

      $( function() {
        $( "#slider" ).slider();
      });

    $(".example.default img").memeGenerator({});
    
    $(".example.bootstrap img").memeGenerator({
      useBootstrap: true,
      
    });
    
    $(".example.horizontal img").memeGenerator({
      useBootstrap: true,
      layout: "horizontal",
      previewMode: "css",
      defaultTextStyle: {
        font: "Blippo, fantasy",
        lineHeight: 2
      },
      // fontFamily : [
      // "some font"
      // ],
      fontStyle:[
      "italic",
      "some style2"
      ],
      captions: [
        "Text on top",
        "Bottom Text",
        "Middle Text"
      ]
    });
    
    
    // Example with saving
    $("#example-save").memeGenerator({
      useBootstrap: true,
      defaultTextStyle: {
        lineHeight: 2
      },
    });
    
    $("#save").click(function(e){
      e.preventDefault();
      
      var imageDataUrl = $("#example-save").memeGenerator("save");
      
      $.ajax({
        url: "http://127.0.0.1:8000/save-img",
        type: "POST",
        data: {image: imageDataUrl},
        dataType: "json",
        success: function(response){
          console.log(response);
          $("#preview").html(
            $("<img>").attr("src", response.filename)
          );
        }
      });
    });
    
    $("#download").click(function(e){
      e.preventDefault();
      
      $("#example-save").memeGenerator("download");
    });
    
    //
    </script>
  </body>
</html>
<!-- MODALS.START -->

<!-- Show Image Modal -->
<div class="modal fade" id="preview">
 <div class="modal-dialog modal-lg">
  <div class="modal-content d-flex">

   <!-- Modal Header -->
   <div class="modal-header">
    <span class="col-sm-5"></span>
    <h1 class="col-sm-6">Preview</h1>
    <button class="close" data-dismiss="modal">&times;</button>
   </div>

   <!-- Modal body -->
   <div id="preview_body" class="modal-body row justify-content-center"></div>

   <!-- Modal footer -->
   <div class="modal-footer">
    <button id="delete_image" class="btn btn-danger">Delete Image</button>
   </div>

  </div>
 </div>
</div>


<!-- Show Download Options Modal -->
<div class="modal fade" id="download">
 <div class="modal-dialog modal-lg">
  <div class="modal-content d-flex">

   <!-- Modal Header -->
   <div class="modal-header">
    <span class="col-sm-5"></span>
    <h1 class="col-sm-6">Download</h1>
    <button class="close" data-dismiss="modal">&times;</button>
   </div>

   <!-- Modal body -->
   <div id="download_body" class="modal-body row justify-content-center"></div>

   <!-- Modal footer -->
   <div class="modal-footer">
    <button id="download_image" class="btn btn-success">Download Image</button>
   </div>

  </div>
 </div>
</div>

<!-- MODALS.END -->

<hr id="hr" class="border-0" style="height: 2px; color: #eaa81b; background-color: #eaa81b;" />

<div id="read_create_delete" class="container-fluid row">
 <div class="col-sm-4 bg-dark column">
   <?php // Display User's Files Here ?>
   @if(!empty($BaseView))
    @foreach($BaseView as $bv)
     @foreach($bv as $id => $img)
      <div class="row mt-1 ml-1">
       <div class="imgs btn text-white bg-secondary preview_init" data-fid="{{$id}}" data-file="{{$img}}" data-toggle="modal" data-target="#preview">
       {{basename(substr_replace($img, "", strpos($img, (string)$_SESSION['id']), strlen((string)$_SESSION['id'])))}}
       </div>
      </div>
     @endforeach
    @endforeach

    @else
     <div class="no_files row justify-content-center"><img src="Assets/Icons/no_files.png"/></div>
   @endif
 </div>
 <div class="col-sm-1 bg-secondary column"></div>

 <div class="col-sm-3 bg-dark column">
  <form action="" method="POST" enctype="multipart/form-data" class="img_up row justify-content-center">
   <label for="img_up"><img src="Assets/Icons/img_up.png" style="cursor: cell;"/></label>
   <input id="img_up" type="file" name="img_up" accept="image/jpeg, image/jpg, image/png, image/gif" style="display: none;" onchange="img_up"/>
   <?php // Display Validation Errors here ?>
   <div class="shit text-white" style="width: 100%; text-align: center;">@if(isset($View)) {{ $View[0] }} @endif</div>

   <br />
   <input id="post_img_up" name="post_img_up" type="submit" class="btn btn-warning text-dark" style="display: none;"/>
  </form>
 </div>
 <div class="col-sm-1 bg-secondary column"></div>

 <div class="col-sm-3 bg-dark column">
  <div class="img_down row justify-content-center">
   <img src="Assets/Icons/img_down.png" style="cursor: grab;" data-toggle="modal" data-target="#download" onclick="download()"/>
  </div>
 </div>
</div>

<style>
#read_create_delete {}
form {}
</style>

<script>
// Windows width & height
var $window_width = $(window).width();
var $window_height = $(window).height();


// hr's tag width & height
var $hr_width = $("#hr").outerWidth(true);
var $hr_height = $("#hr").outerHeight(true);

// Header's width & height
var $header_width = $("#header").outerWidth();
var $header_height = $("#header").outerHeight();

// #read_create_delete's height
$rcd_height = $window_height - ($hr_height + $header_height)
$('#read_create_delete').css({ "height": $rcd_height });

// .form's height ˛& Icon Positioning
var fh = $rcd_height / 3;
$(".no_files").css({ "margin-top": fh });
$(".img_down").css({ "margin-top": fh });
$(".img_up").css({ "margin-top": fh });

// Remove PHP feedback
function remove_feedback() { $('.shit').html(""); }

// Upload File
function img_up() {
  var $iu = $("#img_up");
  var $piu = $("#post_img_up");

  if($iu[0].files.length !== 0 ) {
    $(".shit").html($iu[0].files[0].name);
    $piu.css({ "display": "block" });
  }
}

/* Launch jQ */
$("document").ready(function() {
  $("#img_up").change(img_up);
  setTimeout(remove_feedback, 2000);
});


/* Modals Script */
// Set Preview Image
var preview_body = document.getElementById('preview_body');
$(".preview_init").click(function() {
  var fid = this.getAttribute('data-fid');
  var file = this.getAttribute('data-file');

  preview_body.innerHTML = "<img src="+ this.getAttribute('data-file')+ " data-fid="+ fid+ " data-file="+ file+ "/>";
  $("#delete_image").click(function() {
    delete_image(fid, file);
  });
});

// Delete Image Option
function delete_image(fid, file) {
  var $form = $("<form>", { action: "", method: "POST" });
  $form.append("<input type='text' name='fid' value='"+ fid+ "'/>");
  $form.append("<input type='text' name='file' value='"+ file+ "'/>");
  $form.appendTo("body").submit();
}

// Set Download Window
function download() {
  var $imgs = $('.imgs');
  var $download_body = $("#download_body");
  var $download_image_btn = $("#download_image");

  var download_body_upgrade = document.createElement("div");
  download_body_upgrade.setAttribute("class", "column");

  for(var i = 0; i < $imgs.length; i++) {
    var download_component_container = document.createElement("div");
    download_component_container.setAttribute("class", "row");

    var btn = document.createElement("button");

    btn.innerHTML = $imgs.eq(i).html();
    btn.setAttribute("data-fid", $imgs.eq(i).attr("data-fid"));
    btn.setAttribute("data-file", $imgs.eq(i).attr("data-file"));
    btn.setAttribute("class", "btn bg-secondary text-white mt-1");

    download_component_container.appendChild(btn);
    download_body_upgrade.appendChild(download_component_container);
  }
  $download_body.append(download_body_upgrade);
}
/* End Modals Script */
</script>

<!-- Image Deletion Feedback -->
@if(isset($alert))
 <script>
 var $alert = "{{$alert}}";
 </script>
@endif

<script>
if(typeof $alert !== 'undefined') { setTimeout(myAlert, 1000) }
function myAlert() { alert($alert); }
</script>

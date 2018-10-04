<hr id="hr" class="border-0" style="height: 2px; color: #eaa81b; background-color: #eaa81b;" />

<div id="read_create_delete" class="container-fluid row">
 <div class="col-sm-4 bg-dark column"></div>
 <div class="col-sm-1 bg-danger column"></div>

 <div class="col-sm-3 bg-dark column">
  <form action="" method="POST" enctype="multipart/form-data" class="form row justify-content-center">
   <label for="img_up"><img src="Assets/Icons/img_up.png" style="cursor: cell;"/></label>
   <input id="img_up" type="file" name="img_up" accept="image/jpeg, image/jpg, image/png, image/gif" style="display: none;" onchange="img_up"/>
   <?php // Display Validation Errors here ?>
   <div class="shit text-white" style="width: 100%; text-align: center;">@if(isset($View)) {{ $View[0] }} @endif</div>

   <br />
   <input id="post_img_up" name="post_img_up" type="submit" class="btn btn-warning text-dark" style="display: none;"/>
  </form>
 </div>
 <div class="col-sm-1 bg-danger column"></div>

 <div class="col-sm-3 bg-dark column"></div>
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

// .form's height
var fh = $rcd_height / 3;
$(".form").css({ "margin-top": fh })



// Upload File
$("document").ready(function(){ $("#img_up").change(img_up); });
function img_up() {
  var $aa = $("#img_up");
  var $piu = $("#post_img_up");

  if($aa[0].files.length !== 0 ) {
    $(".shit").html($aa[0].files[0].name);
    $piu.css({ "display": "block" });
  }
 }
</script>
